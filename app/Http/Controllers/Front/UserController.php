<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Product;
use App\Purchase;
use App\Answer;
use App\DateProduct;


class UserController extends Controller
{
    public function show_purchases(Request $request){
      $user = auth()->user()->id;
      $purchases = Purchase::where('user_id',auth()->user()->id)
                            ->whereIn('state',['en espera', 'aceptada'])
                            ->orderBy('purchase_date','DESC')->get();

      return view('Front.mis_compras',['reservas' => $purchases, 'title'=> 'Reservas pendientes']);
    }

    public function show_confirmed_purchases(Request $request){
      $user = auth()->user()->id;
      $purchases = Purchase::where('user_id',auth()->user()->id)
                            ->whereIn('state',['confirmada'])
                            ->orderBy('purchase_date','DESC')->get();

      return view('Front.mis_compras',['reservas' => $purchases, 'title'=> 'Reservas confirmadas']);
    }

    public function show_rejected_purchases(Request $request){

      $user = auth()->user()->id;

      $purchases = Purchase::where('user_id',auth()->user()->id)
                            ->whereIn('state',['anulada por usuario', 'rechazada'])
                            ->orderBy('purchase_date','DESC')->get();

      return view('Front.mis_compras',['reservas' => $purchases, 'title'=> 'Reservas anuladas']);
    }

    public function add_favourites($prod_id){

      $user = auth()->user();

      $prod = Product::find($prod_id);
      $user->products()->save($prod);
      $pagina_anterior = url()->previous();

      if(! $pagina_anterior){
          $pagina_anterior = '/listado';
      }

      $pagina_anterior .= '#prod'.$prod_id;
      return redirect($pagina_anterior);
    }

    public function remove_favourites($prod_id){
      $user = auth()->user();
      $user->products()->detach($prod_id);
      $pagina_anterior = url()->previous();
      if(! $pagina_anterior){
          $pagina_anterior = '/listado';
      }
      $pagina_anterior .= '#prod'.$prod_id;
      return redirect($pagina_anterior);
    }

    public function showOptions()
    {
        $options1 = Answer::limit(4)->get();
        $options2 = Answer::offset(4)->limit(4)->get();
        return view('Front.perfil', ['options1' => $options1, 'options2' => $options2]);
    }

    public function user_reservation($id){

      $reservation = Purchase::find($id);
      $tipo = request()->input('tipo');
      $msg = '';
      if( $tipo == 'aceptar'){
        $reservation->state = 'confirmada';
        $reservation->save();
        $msg = 'Reserva confirmada';
      }
      if( $tipo == 'rechazar'){
        $reservation;
        $reservation->state = 'anulada por usuario';
        foreach ($reservation->product_purchases as $reservation_product) {
          $product = $reservation_product->product;

          $rd = DateProduct::where(['product_id'=>$product->id],['date'=>$reservation->event_date])->get();
          if(! $rd->isEmpty()){
            $rd[0]->delete();
          }
        }

        $reservation->save();
        $msg = 'Reserva eliminada';
      }
      return redirect('/mis_compras')->with('message',$msg);
    }

}
