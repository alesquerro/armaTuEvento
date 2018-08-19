<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Product;
use App\Purchase;
use App\Answer;


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
      $pagina_anterior = url()->previous();

      if(! $pagina_anterior){
          $pagina_anterior = '/listado';
      }

      $pagina_anterior .= '#remove_favourites_'.$prod_id;
      return redirect($pagina_anterior);
    }

    public function remove_favourites($prod_id){
      $user = auth()->user();
      $user->products()->detach($prod_id);
      $pagina_anterior = url()->previous();
      if(! $pagina_anterior){
          $pagina_anterior = '/listado';
      }
      $pagina_anterior .= '#add_favourites_'.$prod_id;
      return redirect($pagina_anterior);
    }

    public function showOptions()
    {
        $options1 = Answer::limit(4)->get();
        $options2 = Answer::offset(4)->limit(4)->get();
        //dd($options1);
        return view('Front.perfil', ['options1' => $options1, 'options2' => $options2]);
    }
    
}
