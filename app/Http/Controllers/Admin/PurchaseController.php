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

      $reservation = Purchase::find($id);
      $action = request()->input('tipo');
      $url = '/Admin/reservas';
      if($reservation && $action == 'aceptar'){
        $reservation->state = 'aceptada';
        $reservation->save();
        return redirect($url);
      }
      if($reservation && $action == 'rechazar'){
        $reservation->state = 'rechazada';
        $reservation->save();
      }
      return redirect($url);
    }
}
