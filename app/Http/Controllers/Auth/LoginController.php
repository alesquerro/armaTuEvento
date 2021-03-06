<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use App\Input;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request) {
      Auth::logout();
      return redirect('/login');
    }
    public function login()
    {
        if (Auth::attempt(['email' => request()->input('email'), 'password' => request()->input('password')])) {
            // Authentication passed...
            if(request()->method() == 'POST'){
              // FIXME Ver si se puede reenviar post que mandaron
              $url = "/listado/tipo=todo/tipo-evento=todo/fecha=todo/tipo-producto=todo/texto=todo";
              return redirect($url);
            }

            return redirect()->back();
        }
        
        return redirect('/login')->with('message','Datos ingresados incorrectos');
    }
}
