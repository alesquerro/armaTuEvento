<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaticController extends Controller
{
    public function dashboard(){
      return view('Admin/dashboard');
    }
}
