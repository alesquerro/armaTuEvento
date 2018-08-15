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
