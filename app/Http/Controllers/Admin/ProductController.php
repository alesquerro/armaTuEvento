<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\EventType;
use App\ProductType;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $products = Product::where('type', '=', 'salon')->get();
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
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
    public function update(Request $request, $id)
    {
        $data = $request->validator();

        $request->fill($data);
        $request->save();
        Flash::message('El producto ha sido modificado!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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

     public function product_types()
    {
        return $this->belongsToMany('ProductType');
    }

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
