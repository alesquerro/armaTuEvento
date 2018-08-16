<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Purchase;

class PurchaseController extends Controller
{
    public function reservation_list(){
      $reservations = Purchase::where('state','en espera')->get();
      return view('Admin/Purchase/reservas',['reservas'=> $reservations]);
    }
    
    public function reservation_admin($id){
      dd($id);
      $reservation = Purchase::find($id);

      $action = request()->input('tipo');
      dd($action);
      $url = '/Admin/reservas';
      if($reservation && $action == 'accept'){
        $reservation->state = 'aceptada';
        $resevation->save();
        redirect($url);
      }
    }
}
