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
     public function showOptions()
    {
      $options1 = [ 1 => 'Mexicana',  2 => 'Pizza',  3 => 'Arabe', 4 =>  'Pastas'];
      $options2 = [ 1 => 'Rock',  2 => 'Reggae',  3 => 'Funk',  4 => 'Pop'];      
      return view('Auth.register', compact('options1', 'options2'));
    }


}
