<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Providers\RouteServiceProvider;

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
   protected $redirectTo = RouteServiceProvider::DASHBOARD;


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
        $message = array(
            'email.required' => 'The email field is mandatory.',
            'email.email' => 'Please insert a valid email.',
            'password.required' => 'The email field is mandatory.',
            'password.min' => 'Password must be 6 characters long',
            'password.regex' => 'Password must contain atleast one uppercase, one lowercase,one digit and one special character.',
    );


        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:t_user',
            'password' => 'required|string|min:6|confirmed|regex:((?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$&*]))' ,
        ],$message);


    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

     
        return User::create([
            'user_id'=>md5(time().json_encode($data)),
            'full_name' => $data['name'],
            'username'=>$data['email'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'type' => 'admin',
        ]);
    }
}
