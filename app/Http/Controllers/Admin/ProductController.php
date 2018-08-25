<?php

namespace App\Http\Controllers\Admin;
//falta hacer el js para que dependiendo de si es salon o servicio se muestren unas u otras opciones
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\EventType;
use App\ProductType;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection\SoftDeletes;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('Admin.Product.index', [
            'products' => $products,
            // 'servicios' => $servicios,
            // 'tipoEventos' => $tipoEventos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $product_types = ProductType::all();
        $tipo_salones = ProductType::where('product_type','salon')->get();
        $tipo_servicios = ProductType::where('product_type','servicio')->get();
        return view('Admin.Product.create', [
            'product_types' => $product_types,
            'tipo_salones' => $tipo_salones,
            'tipo_servicios' =>$tipo_servicios
        ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $filename = '';
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = $file->hashName() . '.' . $file->extension();
            $folder = 'subidos/productos';
            $filename = $file->storeAs($folder, $filename);
        }

        $newProduct = Product::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'capacity' => $request['capacity'],
            'cover' => $filename,
            'phone' => $request['phone'],
            'mail' => $request['mail'],
            'price' => $request['price'],
            'type' => $request['type'],
            'price_type' => $request['price_type'],
            'minimum_reservation' => $request['minimum_reservation'],
            'active' => 1,
            'company_id' => $request['company_id'],
        ]);
// dd($newProduct);
        $newProduct->product_types()->sync($request['product_types']);
        return redirect('/Admin/dashboard');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Product::find($id);
        $favoritos = $this->get_favourites();
        $pagina_anterior = url()->previous();
        if(! $pagina_anterior){
            $pagina_anterior = '/';
        }
        return view('Admin.Product.producto', [
            'producto' => $producto,
            'pagina_anterior' => $pagina_anterior,
            'favoritos' => $favoritos,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //archivo!!
        $id = request()->input('producto');
        $product = Product::find($id);
        //$product_types = ProductType::all();
        $tipo_salones = ProductType::where('product_type','salon')->get();
        $tipo_servicios = ProductType::where('product_type','servicio')->get();
        $own_products = $product->product_types;
        $own_products_id = [];
        $salonServicio = $product->type;
        $product_types = $tipo_servicios;
        //dd($tipo_servicios);
        if($product->type == 'salon'){
          $product_types = $tipo_salones;
        }

        foreach ($own_products as $value) {
            $own_products_id[] = $value->id;
        }

        return view('Admin.Product.edit', [
            'product' => $product,
            'product_types' => $product_types,
            'own_product_types' => $own_products_id,
            'salonServicio' => $salonServicio,
            'tipo_salones' => $tipo_salones,
            'tipo_servicios' =>$tipo_servicios
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $id = request()->input('id');
        $data = Validator::make(request()->all(),[
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:200',
            'mail' => 'required|email|string|max:100',
             'capacity' => 'required|max:3000',
             'minimum_reservation' => 'required|max:99999',
             'price' => 'required|min:0|max:99999',
             'type' => 'required',
             'active' => 'integer',
        ]);
        //dd($data->messages());
        $product = Product::find($id);
        $filename = $product->cover;
        // dd($product);
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = $request['name'] . '.' . $file->extension();
            $folder = 'subidos/productos';
            $filename = $file->storeAs($folder, $filename);
        }
        $product->fill($request->all());
        $product->cover = $filename;
        $product->product_types()->sync($request['product_types']);
        $product->save();
        // Flash::message('El producto ha sido modificado!');
        return redirect('/Admin/listar_productos');
    }

    // public function delete()
    // {


    //     $products = Product::all();
    //     // $servicios = Product::where('type', '=', 'servicio')->get();

    //     // $tipoEventos = EventType::all();
    //     // dd($tipoEventos);

    //     return view('Admin.Product.delete', [
    //         'products' => $products,
    //         // 'servicios' => $servicios,
    //         // 'tipoEventos' => $tipoEventos,
    //     ]);
    // }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        //falta es un soft delete y active = 0
        $product = Product::find($id);
        // dd($product);
        $product->active = 0;
        // $product->update('active', '0');
        $product->save();
        $product->delete();

        // return redirect('Admin.Product.index');
        return redirect('/Admin/listar_productos');

  //       ->with([
  //           'flash_message' => 'Producto eliminado',
  //           'flash_message_important' => false
  // ]);
    }


    private function get_favourites(){
      $favoritos = [];
      if(auth()->check()){
        foreach (auth()->user()->products as $product) {
          $favoritos[] = $product->id;
        }
      }
      return $favoritos;
    }

    //  public function product_types()
    // {
    //     return $this->belongsToMany('ProductType');
    // }

     protected function validator($request)
    {
      //dd($request);
        return $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:200',
            'mail' => 'required|email|string|max:100',
             'capacity' => 'required|min:1|max:3000',
             'minimum_reservation' => 'required|min:0|max:99999',
             'price' => 'required|min:0|max:99999',
             'type' => 'required',
             'active' => 'integer',

        ]);
    }
    public function handleRequest(Request $request)
    {
      //dd($request);
      $request->validate([
          'name' => 'required|string|max:100',
          'description' => 'required|string|max:200',
          'mail' => 'required|email|string|max:100',
           'capacity' => 'required|min:1|max:3000',
           'minimum_reservation' => 'required|min:0|max:99999',
           'price' => 'required|min:0|max:99999',
           'type' => 'required',
           'active' => 'integer',

      ]);
        // dd('aca');

        if ($request->submit == 'edit') {
            // dd($request);
            return $this->update($request);
        } elseif ($request->submit == 'delete') {
            return $this->destroy($request);
        }
    }
    // public function handleEdit(Request $request)
    // {
    //     return $request->all();
    // }

    // public function handleDelete(Request $request)
    // {
    //     $draft = $request->get('delete',false);
    //     if($draft) {
    //         return $this->handleDraft($request);
    //     }
    //     return $request->all();
    // }


}
