<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Purchase;
use App\ProductPurchase;

class CartController extends Controller
{
    public function add($id)
    {
      if(! session()->has('carrito') || ! in_array($id, session()->get('carrito'))){
        session()->push('carrito',$id);
      }
      return redirect('carrito');
    }

    public function show()
    {
      $products = [];
      $errores = [];
      $total = 0.0;
      if(session()->has('carrito')){
        $product_ids = session()->get('carrito');
        if($product_ids){
          $ids = implode(',',$product_ids);
          $products = Product::whereIn('id',$product_ids)->get();
        }
      }
      foreach ($products as $product) {
        $total += $product->price;
      }
      return view('Front/carrito', ['carrito' => $products,
                                    'errores' => $errores,
                                    'total' => $total,
                                  ]);

    }

    public function clear(Request $request){
      $request->session()->forget('carrito');
      return redirect('carrito');
    }

    public function pop($product_id, Request $request){
      $products = $request->session()->get('carrito');
      $request->session()->put('carrito', array_diff($products, [$product_id]));

      return redirect('carrito');
    }

    //FIXME falta controlar logueo cuando este listo!!
    public function save(Request $request){

      $errores = $request->validate([
        'fecha_evento'=> 'required',
      ],[
        'fecha_evento.required' => 'La fecha del evento es obligatoria',
      ]);
      $product_ids = $request->session()->get('carrito');
      $products = Product::whereIn('id',$product_ids)->get();
      $purchase = Purchase::create([
        'name' => 'Compra '.date('Y-m-d'),
        'purchase_date'=> date('Y-m-d'),
        'total_amount'=> 0.0,
        'remainder'=> 0.0,
        'booking'=> 0.0,
        'state' => 'en espera',
        'event_date'=>request()->input('fecha_evento'),
        'active' => 1,
        //FIXME falta agregar usuario logeado cuando este
        //'user_id'=> $request->session()->get('usuario'),
        'user_id' => 1,
        //FIXME falta direcciones!!!
        'address_id' => 1,
      ]);
      $total = 0.0;
      foreach ($products as $product) {
        $total += $product->price;
        $purchaseLine = ProductPurchase::create([
          'price'=> $product->price,
          'purchase_id'=> $purchase->id,
          'description'=> $product->name,
          'product_id'=> $product->id,
          'active' => 1
        ]);
        $purchaseLine->save();
      }
      $purchase->total_amount = $total;
      $purchase->remainder = $total;
      $purchase->save();
      $request->session()->forget('carrito');
      //TODO redirigir a pagina mis_compras
      return 'todo ok';
    }

}
