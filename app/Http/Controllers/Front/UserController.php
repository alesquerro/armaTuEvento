<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Product;
use App\Purchase;

class UserController extends Controller
{
    public function show_purchases(Request $request){
      $user = $request->session()->get('user');
      //FIXME falta buscar usuario de sesion cuando este el login
      $purchases = Purchase::where([['user_id',1],
                       ['state','en espera']
                     ])->get();

      return view('Front.mis_compras',['reservas' => $purchases]);
    }
}
