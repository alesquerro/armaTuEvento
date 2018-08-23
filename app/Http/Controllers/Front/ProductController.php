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
      dd('aca');
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
      $data = $request->all();
      //dd($data);
      $tipo = 'todo';
      $fecha = 'todo';
      $tipo_evento = 'todo';
      $tipo_producto = 'todo';
      $texto = 'todo';
      if(array_key_exists('tipo',$data)){
        $tipo_prod = $data['tipo'];
        if($tipo_prod && count($tipo_prod) == 1 ){
          if($tipo_prod[0] == 'salon'){
            $tipo = $tipo_prod[0];
          }
          if($tipo_prod[0] == 'servicio'){
            $tipo = $tipo_prod[0];
          }
        }
      }
      if(array_key_exists('tipoEvento',$data)){
        if($data['tipoEvento']){
          $tipo_evento = $data['tipoEvento'];
        }
      }
      if(array_key_exists('texto',$data)){
        if($data['texto']){
          $texto = $data['texto'];
        }
      }
      $url = "/listado/tipo=$tipo/tipo-evento=$tipo_evento/fecha=$fecha/tipo-producto=$tipo_producto/texto=$texto";

      return redirect($url);

    }

    //FIXME falta seguir esto!!!!!
    public function listParameters($tipo, $tipo_evento,$fecha,$tipo_producto,$texto){
      //dd('aca');
      $filtros_aplicados = [];
      $query = Product::query();
      $tipo_list =  explode('=',$tipo);
      if(count($tipo_list) == 2 && $tipo_list[1] && ($tipo_list[1] == 'salon' || $tipo_list[1] == 'servicio')){
          $query->where('type',$tipo_list[1]);
          $tipo = $tipo_list[1];
          $filtros_aplicados['tipo'] = [$tipo_list[1]];
      }
      else{
        $tipo = 'todo';
      }
      if($tipo_evento != 'todo'){
        $te_list =  explode('=',$tipo_evento);
        if( count($te_list) == 2 && $te_list[1]){
          $tes = explode('_',$te_list[1]);
          $first = true;
          $te_ids = [];
          foreach ($tes as $te) {
            if(is_numeric($te)){
              $te_ids[] = $te;
            }
          }
           if($te_ids){
            $query->whereHas('event_types',function($type) use($te_ids) {
              $type->whereIn('event_types.id',$te_ids);
            });
            $filtros_aplicados['tipo_eventos'] = $te_ids;
          }
        }
      }
      if($tipo_producto){
        $tp_list =  explode('=',$tipo_producto);
        if(count( $tp_list ) == 2 && $tp_list[1] && $tp_list[1] != 'todo'){
          $query->where('product_type_id',$tp_list[1]);
          $filtros_aplicados['tipo_producto'] = [$tp_list[1]];
          $tps = explode('_',$tp_list[1]);
          $first = true;
          $tp_ids = [];
          foreach ($tps as $tp) {
            if(is_numeric($tp)){
              $tp_ids[] = $tp;
            }
          }
           if($tp_ids){
            $query->whereIn('product_type_id',$tp_ids);
            $filtros_aplicados['tipo_producto'] = $tp_ids;
          }
        }

      }
      if($texto){
          //FIXME ver esto!!!!
          $txt_list =  explode('=',$texto);
          if(count($txt_list) == 2 && $txt_list[1] != 'todo' && $txt_list[1] != ''){
            $query->where('name','like',"%{$txt_list[1]}%");
            $query->orWhere('description','like',"%{$txt_list[1]}%");
            $fitros_aplicados['texto'] = [$texto];
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
      $tipo_productos = $tipo_salon->merge($tipo_servicio);
      return view('Front.listado', [
          'productos' => $productos,
          'favoritos' => $favoritos,
          'tipo_eventos' => $tipo_eventos,
          'tipo_salon' => $tipo_salon,
          'tipo_productos' => $tipo_productos,
          'tipo_servicio' => $tipo_servicio,
          'tipo' => $tipo,
          'filtros_aplicados' => $filtros_aplicados,
        ]);
    }

    public function add_filter(){
      $pagina_anterior = url()->previous();
      $pa_list = explode('/',$pagina_anterior);
      $path_data = [];
      $data = request()->all();
      foreach ($pa_list as $value) {
        $var = explode('=',$value);
        if(in_array($var[0],['tipo','tipo-evento','fecha','tipo-producto','texto'])){
          $path_data[$var[0]] = explode('_',$var[1]);
        }
      }

      if(array_key_exists('tipo_evento', $data)){
        if ($path_data['tipo-evento'][0] == 'todo') {
          $path_data['tipo-evento'] = [];
        }
        if(! in_array($data['tipo_evento'],$path_data['tipo-evento'])){
          $path_data['tipo-evento'][] = $data['tipo_evento'];
        }
      }
      if(array_key_exists('tipo_producto', $data)){
        //dd($path_data['tipo-producto']);
        if ($path_data['tipo-producto'][0] == 'todo') {
          $path_data['tipo-producto'] = [];
        }
        if(! in_array($data['tipo_producto'],$path_data['tipo-producto'])){
          $path_data['tipo-producto'][] = $data['tipo_producto'];
        }
      }

      if(array_key_exists('tipo', $data)){
        //dd($path_data);
        if($data['tipo'] == 'salon' && $path_data['tipo'][0] != 'servicio'){
            $path_data['tipo'] = ['salon'];
        }
        elseif($data['tipo'] == 'servicio' && $path_data['tipo'][0] != 'salon'){
            $path_data['tipo'] = ['servicio'];
        }
        else{
            $path_data['tipo'] = ['todo'];
        }
      }

      $url = '/listado';
      foreach ($path_data as $key => $value) {
        $url .= '/';
        $url .= $key.'=';
        $url .= implode('_',$value);
      }
      return redirect($url);
    }

    public function remove_filter(){
      $pagina_anterior = url()->previous();
      $pa_list = explode('/',$pagina_anterior);
      $path_data = [];
      $data = request()->all();
      foreach ($pa_list as $value) {
        $var = explode('=',$value);
        if(in_array($var[0],['tipo','tipo-evento','fecha','tipo-producto','texto'])){
          $path_data[$var[0]] = explode('_',$var[1]);
        }
      }
      foreach ($data as $key => $value) {
        if (array_key_exists($key,$path_data)) {
          if(in_array($value,$path_data[$key])){
            //dd($path_data[$key], $value);
            foreach ($path_data[$key] as $k => $val){
              if($value == $val){
                unset($path_data[$key][$k]);
                if(empty($path_data[$key])){
                  $path_data[$key][] = 'todo';
                }
              }
            }
          }
        }
      }
      $url = '/listado';
      foreach ($path_data as $key => $value) {
        $url .= '/';
        $url .= $key.'=';
        $url .= implode('_',$value);
      }
      return redirect($url);

    }

    public function clean_filters(){
      $url = "/listado/tipo=todo/tipo-evento=todo/fecha=todo/tipo-producto=todo/texto=todo";
      return redirect($url);
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
