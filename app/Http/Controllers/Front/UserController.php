<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Product;
use App\Purchase;

class UserController extends Controller
{
    public function show_purchases(Request $request){

      $user = auth()->user()->id;

      $purchases = Purchase::where([['user_id',1],
                       ['state','en espera']
                     ])->get();

      return view('Front.mis_compras',['reservas' => $purchases]);
    }

    public function add_favourites($prod_id){
      $user = auth()->user();
      $prod = Product::find($prod_id);
      $user->products()->save($prod);
      return redirect('listado');
    }

    public function remove_favourites($prod_id){

      $user = auth()->user();
      $user->products()->detach($prod_id);
      return redirect('listado');
    }

}
