<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Purchase;
use App\DatePurchase;

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
        $rd = DatePurchase::where(['purchase_id'=>$reservation->id],['date'=>$reservation->event_date])->get();
        // if(! $rd){
          $reservation->state = 'aceptada';
          $reservation->save();
          DatePurchase::create([
              'purchase_id'=> $id,
              'date' => $reservation->event_date,
          ]);
          return redirect($url);
        // }
      }
      if($reservation && $action == 'rechazar'){
        $reservation->state = 'rechazada';
        $reservation->save();
      }
      return redirect($url);
    }
}
