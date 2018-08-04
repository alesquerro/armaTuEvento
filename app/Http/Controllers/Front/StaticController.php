<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaticController extends Controller
{
    public function showFAQs()
    {
      return view('Front.FAQs');
    }

    public function showContacto()
    {
      return view('Front.contacto');
    }
     public function showIndex()
    {
      return view('Front.index');
    }
}
