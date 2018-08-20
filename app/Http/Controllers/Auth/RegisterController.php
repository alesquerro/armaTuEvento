<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Answer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'alias' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'avatar' => 'required',
            'respuesta1' => 'integer',
            'respuesta2' => 'integer',
            'terms_conditions_date' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //dd($data);
        $path = request()->file('avatar')->store('images');

        return User::create([

            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'avatar' => $path,
            'respuesta1' => $data['respuesta1'],
            'respuesta2' => $data['respuesta2'],
            'terms_conditions_date' => $data['terms_conditions_date'],
            'active' => 1,
            'admin' => 0,
        ]);


    }


    public function showOptions()
    {
        $options1 = Answer::limit(4)->get();
        $options2 = Answer::offset(4)->limit(4)->get();
        //dd($options1);
        return view('auth.registro', ['options1' => $options1, 'options2' => $options2]);
    }

    public function getRegister()
    {
        $this->validator(request()->all());
        $user = $this->create(request()->all());

        Auth::login($user);
        return redirect('/');

    }

    public function getRegisterEdit()
    {
        $this->validator(request()->all());
        $this->create(request()->all());
        return view('Front.index');

    }

    public function updateUser(User $user, Request $request)
    { 
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        $user->fill($data);
        $user->save();
        Flash::message('El usuario ha sido modificado!');
        return back();
    }

}
