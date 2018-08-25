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
      return view('Admin/Purchase/reservas',['reservas'=> $reservations, 'title'=>'Reservas pendientes', 'type'=>'pendientes']);
    }

    public function confirmed_reservation_list(){
      $reservations = Purchase::whereIn('state',['confirmada','aceptada'])->get();
      return view('Admin/Purchase/reservas',['reservas'=> $reservations, 'title'=>'Reservas aceptadas', 'type'=>'aceptadas']);
    }

    public function rejected_reservation_list(){
      $reservations = Purchase::whereIn('state',['rechazada','anulada por usuario'])->get();
      return view('Admin/Purchase/reservas',['reservas'=> $reservations, 'title'=>'Reservas anuladas','type'=>'anuladas']);
    }

    public function reservation_admin($id){

      $reservation = Purchase::find($id);
      $action = request()->input('tipo');
      $url = '/Admin/reservas';
      $all_products_ok = true;
      $msg = '';
      if($reservation && $action == 'aceptar'){
        $msg = 'Reserva ID: '.$reservation->id.' aceptada';
        foreach ($reservation->product_purchases as $product_purchase) {

          $product = $product_purchase->product;
          if($product){
            $rd = DateProduct::where(['product_id'=> $product->id],['date'=>$reservation->event_date])->get();
            if(! $rd->isEmpty()){
              $all_products_ok = false;
              $msg = "No se puede aceptar la reserva ID: ".$reservation->id." porque el producto".$product->name." está reservado en esa fecha";
            }
          }
          else{
            $msg = 'Alguno de los productos de la compra ID: '.$reservation->id.' seleccionados ya no está disponible';
            $all_products_ok = false;
          }

        }
         if( $all_products_ok){
          $reservation->state = 'aceptada';
          $reservation->save();

          foreach ($reservation->product_purchases as $product_purchase) {
            $product = $product_purchase->product;
            DateProduct::create([
              'product_id'=> $product->id,
              'date' => $reservation->event_date,
          ]);
          return redirect($url)->with('message',$msg);
          }
        }
      }
      if($reservation && $action == 'rechazar'){
        $msg = "Reserva ID: ".$reservation->id." rechazada";
        $reservation->state = 'rechazada';
        $reservation->save();
      }
      return redirect($url)->with('message',$msg);
    }
}
