<?php

namespace App\Http\Controllers\Front;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function index()
    {
        $productos = \App\Product::table('products')->limit(3)->get();
        //$servicios = \App\Product::
        return view('Front.index');
    }


    public function show($id)
    {
        $producto = Product::find($id);
         $pagina_anterior = url()->previous();
        if(! $pagina_anterior){
            $pagina_anterior = 'index';
        }
        return view('Front.producto', ['producto' => $producto,
                                       'pagina_anterior' => $pagina_anterior,
                                     ]);
    }


}
