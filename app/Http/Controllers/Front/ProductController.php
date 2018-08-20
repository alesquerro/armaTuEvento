<?php

namespace App\Http\Controllers\Front;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EventType;
use App\ProductType;


class ProductController extends Controller
{

    public function index()
   {
        $salones = Product::where('type', '=', 'salon')->limit(3)->get();
        $servicios = Product::where('type', '=', 'servicio')->limit(3)->get();
        $favoritos = [];
        if(auth()->check()){
          foreach (auth()->user()->products as $product) {
            $favoritos[] = $product->id;
          }
        }

        $tipoEventos = EventType::all();
        // dd($tipoEventos);

        return view('Front.index', [
            'salones' => $salones,
            'servicios' => $servicios,
            'tipoEventos' => $tipoEventos,
            'favoritos' => $favoritos,
        ]);


    }

    public function show($id)
    {
        $producto = Product::find($id);
        $favoritos = $this->get_favourites();
        $pagina_anterior = url()->previous();
        if(! $pagina_anterior){
            $pagina_anterior = '/';
        }
        return view('Front.producto', ['producto' => $producto,
                                       'pagina_anterior' => $pagina_anterior,
                                       'favoritos' => $favoritos,
                                     ]);
    }

  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function list()
    {
        $productos = Product::get();
        $favoritos = [];
        if(auth()->check()){
          foreach (auth()->user()->products as $product) {
            $favoritos[] = $product->id;
          }
        }
        $tipo_eventos = EventType::all();
        $tipo_salon = ProductType::where('product_type','salon')->get();
        $tipo_servicio = ProductType::where('product_type','servicio')->get();
        return view('Front.listado', [
            'productos' => $productos,
            'favoritos' => $favoritos,
            'tipo_eventos' => $tipo_eventos,
            'tipo_salon' => $tipo_salon,
            'tipo_servicio' => $tipo_servicio,
            'tipo' => 'todo',
        ]);
    }
    public function list_post(Request $request){
      $tipo = 'todo';
      $fecha = 'todo';
      $tipo_evento = 'todo';
      $tipo_producto = 'todo';
      $texto = 'todo';
      $tipo_prod = $request->input('tipo');
      if($tipo_prod && count($tipo_prod) == 1 ){
        if($tipo_prod[0] == 'salon'){
          $tipo = $tipo_prod[0];
        }
        if($tipo_prod[0] == 'servicio'){
          $tipo = $tipo_prod[0];
        }
      }
      if($request->input('tipoEvento')){
        $tipo_evento = $request->input('tipoEvento');
      }
      if($request->input('texto')){
        $tipo_producto = input('texto');
      }
      $url = "/listado/tipo=$tipo/tipo-evento=$tipo_evento/fecha=$fecha/tipo-producto=$tipo_producto/texto=$texto";

      return redirect($url);

    }

    //FIXME falta seguir esto!!!!!
    public function listParameters($tipo, $tipo_evento,$fecha,$tipo_producto,$texto){
      $query = Product::query();
      $tipo_list =  explode('=',$tipo);
      if(count($tipo_list) == 2 && $tipo_list[1] && ($tipo_list[1] == 'salon' || $tipo_list[1] == 'servicio')){
          $query->where('type',$tipo_list[1]);
          $tipo = $tipo_list[1];
      }
      else{
        $tipo = 'todo';
      }
      // if($tipo_evento != 'todo'){
      //   //dd($tipo_evento);
      //   $te_list =  explode('=',$tipo_evento);
      //   //dd($te_list);
      //   $tes = explode('_',$te_list[1]);
      //   $first = true;
      //   foreach ($tes as $te) {
      //     if($first ){
      //       $query->where('event_type_id',$te);
      //       $first = false;
      //     }
      //     else{
      //       $query->orWhere('event_type_id',$te);
      //     }
      //   }
      // }
      if($tipo_producto){

        $tp_list =  explode('=',$tipo_producto);
        if(count( $tp_list ) == 2 && $tp_list[1] && $tp_list[1] != 'todo'){
          $query->where('product_type_id',$tp_list[1]);
        }
      }
      if($texto){
          //FIXME ver esto!!!!
          $txt_list =  explode('=',$texto);
          if(count($txt_list) == 2 && $txt_list[1] != 'todo' && $txt_list[1] != ''){
            $query->where('name','like',"%{$txt_list[1]}%");
            $query->orWhere('description','like',"%{$txt_list[1]}%");
          }

      }
      $productos = $query->get();
      $favoritos = [];
      if(auth()->check()){
        foreach (auth()->user()->products as $product) {
          $favoritos[] = $product->id;
        }
      }
      $tipo_eventos = EventType::all();
      $tipo_salon = ProductType::where('product_type','salon')->get();
      $tipo_servicio = ProductType::where('product_type','servicio')->get();
      return view('Front.listado', [
          'productos' => $productos,
          'favoritos' => $favoritos,
          'tipo_eventos' => $tipo_eventos,
          'tipo_salon' => $tipo_salon,
          'tipo_servicio' => $tipo_servicio,
          'tipo' => $tipo,
        ]);
    }

    private function get_favourites(){
      $favoritos = [];
      if(auth()->check()){
        foreach (auth()->user()->products as $product) {
          $favoritos[] = $product->id;
        }
      }
      return $favoritos;
    }
}
