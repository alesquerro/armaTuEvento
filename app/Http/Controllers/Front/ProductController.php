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
        $servicios = \App\Product::
        return view('Front.index');
    }

    
    public function show(Product $product)
    {
        productos
        servicios
        limit3

        le paso las variables a la vista
        //return view('index', []);
    }
    

}
