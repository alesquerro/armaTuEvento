<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class CartController extends Controller
{
    public function add($id)
    {
      //dd(session()->get('carrito'));
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
      $total = 0.0;
      if(session()->has('carrito')){
        $product_ids = session()->get('carrito');
        $ids = implode(',',$product_ids);
        $products = Product::whereIn('id',$product_ids)->get();
      }
      foreach ($products as $product) {
        $total += $product->price;
      }
      return view('Front/carrito', ['carrito' => $products,
                                    'errores' => $errores,
                                    'total' => $total,
                                  ]);

    }
}
