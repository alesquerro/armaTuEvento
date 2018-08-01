<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
      //dd(session()->get('carrito'));
      if(session()->has('carrito')){
        $products = session()->get('carrito');
      }
      return view('Front/carrito', ['carrito' => $products]);

    }
}
