<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Purchase;
use App\DateProduct;

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
      $all_products_ok = true;
      //dd($reservation->);
      if($reservation && $action == 'aceptar'){
        foreach ($reservation->product_purchases as $product_purchase) {

          $product = $product_purchase->product;
          //dd($product);
          $rd = DateProduct::where(['product_id'=> $product->id],['date'=>$reservation->event_date])->get();
          //dd($rd->isEmpty());
          if(! $rd->isEmpty()){
            $all_products_ok = false;
          }
        }
        //dd($all_products_ok);
         if( $all_products_ok){
          $reservation->state = 'aceptada';
          $reservation->save();

          foreach ($reservation->product_purchases as $product_purchase) {
            $product = $product_purchase->product;
            // dd($product);
            DateProduct::create([
              'product_id'=> $product->id,
              'date' => $reservation->event_date,
          ]);
          return redirect($url);
          }
        }
      }
      if($reservation && $action == 'rechazar'){
        $reservation->state = 'rechazada';
        $reservation->save();
      }
      return redirect($url);
    }
}
