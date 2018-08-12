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

        $tipoEventos = EventType::all();
        // dd($tipoEventos);

        return view('Front.index', [
            'salones' => $salones,
            'servicios' => $servicios,
            'tipoEventos' => $tipoEventos,
        ]);


    }

    public function show($id)
    {
        $producto = Product::find($id);
        $pagina_anterior = url()->previous();
        if(! $pagina_anterior){
            $pagina_anterior = '/';
        }
        return view('Front.producto', ['producto' => $producto,
                                       'pagina_anterior' => $pagina_anterior,
                                       'favorito' => false,
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

        // $tipoEventos = EventType::all();
        // dd($tipoEventos);

        return view('Front.listado', [
            'productos' => $productos,
            // 'servicios' => $servicios,
            // 'tipoEventos' => $tipoEventos,
        ]);
    }
}
