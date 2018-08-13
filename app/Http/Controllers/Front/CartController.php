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
      return redirect('carrito');
    }

    public function show()
    {
      $products = [];
      $errores = [];
      $total = 0.0;
      if(session()->has('carrito')){
        $product_ids = session()->get('carrito');
        if($product_ids){
          $ids = implode(',',$product_ids);
          $products = Product::whereIn('id',$product_ids)->get();
        }
      }
      foreach ($products as $product) {
        $total += $product->price;
      }
      return view('Front/carrito', ['carrito' => $products,
                                    'errores' => $errores,
                                    'total' => $total,
                                  ]);

    }

    public function clear(Request $request){
      $request->session()->forget('carrito');
      return redirect('carrito');
    }

    public function pop($product_id, Request $request){
      $products = $request->session()->get('carrito');
      $request->session()->put('carrito', array_diff($products, [$product_id]));

      return redirect('carrito');
    }

}
