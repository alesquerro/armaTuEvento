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
}
