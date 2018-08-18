<?php

namespace App\Http\Controllers\Front;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EventType;


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

        return view('Front.listado', [
            'productos' => $productos,
            'favoritos' => $favoritos,
            // 'servicios' => $servicios,
            // 'tipoEventos' => $tipoEventos,
        ]);
    }

    //FIXME falta seguir esto!!!!!
    public function listParameters($tipo, $tipo_evento,$fecha,$tipo_producto,$texto){
      //$condition = ' where ';
      $query = Product::query();
      //dd($query);
      if($tipo == 'salon' || $tipo == 'servicio'){
          $query->where('type',$tipo);
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

        if($tipo_producto != 'todo'){
          dd('aca1');
          $query->where('product_type_id',$tipo_producto);
        }
      }
      if($texto){
          if($texto != 'todo'){
            dd('aca2');
            $query->where('name','like',$texto);
            $query->where('description','like',$texto);
          }
      }
      $productos = $query->get();
      dd($productos);
      $favoritos = [];
      if(auth()->check()){
        foreach (auth()->user()->products as $product) {
          $favoritos[] = $product->id;
        }
      }
      return view('Front.listado', [
          'productos' => $productos,
          'favoritos' => $favoritos,
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
