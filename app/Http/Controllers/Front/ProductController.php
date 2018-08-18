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
      $tipo_list =  explode('=',$tipo);
      //dd($tipo_list);
      if(count($tipo_list) == 2 && $tipo_list[1] == 'salon' || $tipo_list[1] == 'servicio'){
          //dd($tipo_list[1]);
          $query->where('type',$tipo_list[1]);
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
        //dd($tp_list);
        if(count( $tp_list ) == 2 && $tp_list[1] != 'todo'){
          $query->where('product_type_id',$tp_list[1]);
        }
      }
      if($texto){
          $txt_list =  explode('=',$texto);
          //dd($txt_list);
          if(count($txt_list) == 2 && $txt_list[1] != 'todo'){
            $query->where('name','like',"%{$txt_list[1]}%");
            $query->orWhere('description','like',"%{$txt_list[1]}%");
          }

            //dd($query);
      }
      //dd($query);
      $productos = $query->get();
      //dd($productos);
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
