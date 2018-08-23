<?php

namespace App\Http\Controllers\Admin;
//falta hacer el js para que dependiendo de si es salon o servicio se muestren unas u otras opciones
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\EventType;
use App\ProductType;
use Illuminate\Support\Facades\Validator;


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
        // $servicios = Product::where('type', '=', 'servicio')->get();

        // $tipoEventos = EventType::all();
        // dd($tipoEventos);

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

        // $id = request()->input('producto');
        // $product = Product::find($id);
        $product_types = ProductType::all();
        // $input = $request->all();

        
        return view('Admin.Product.create', [
        //     'product' => $product,
            'product_types' => $product_types
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
            $filename = $request['cover'] . '.' . $file->extension();
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
        $product_types = ProductType::all();


        return view('Admin.Product.edit', [
            'product' => $product,
            'product_types' => $product_types
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
        $data = $this->validator($request->all());
        $product = Product::find($id);
        $filename = '';
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = $request['name'] . '.' . $file->extension();
            $folder = 'subidos/productos';
            $filename = $file->storeAs($folder, $filename);
        }
        $product->fill($request->all());
        $product->cover = $filename;
        $product->save();
        // Flash::message('El producto ha sido modificado!');
        return redirect('/Admin/listar_productos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //falta es un soft delete y active = 0
        $producto = Product::find($id);

        $producto->delete();

        return redirect('backend/dashboard')->with([
            'flash_message' => 'Producto eliminado',
            'flash_message_important' => false
  ]);
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

     protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:200',
            'mail' => 'required|email|string|max:100',
            'price' => 'required|decimal',
            'cover' => 'image|required',
            'type' => 'required',
            'active' => 'integer',
            // 'respuesta2' => 'integer',
            // 'terms_conditions_date' => 'required',
        ]);
    }
}
