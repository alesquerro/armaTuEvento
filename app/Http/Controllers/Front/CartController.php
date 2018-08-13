<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class CartController extends Controller
{
    public function add($id)
    {

      if(! session()->has('carrito') || ! in_array($id, session()->get('carrito'))){
        session()->push('carrito',$id);

      }
      //dd(session()->get('carrito'));
      return redirect('carrito');

    }

    public function show()
    {
      $products = [];
      $errores = [];
      //dd(session()->get('carrito'));
      if(session()->has('carrito')){
        $product_ids = session()->get('carrito');
        $products = Product::where('id',$product_ids)->get();

      }
      return view('Front/carrito', ['carrito' => $products,
                                    'errores' => $errores,
                                  ]);

    }
}
