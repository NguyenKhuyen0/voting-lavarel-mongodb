<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest')->except('logout');
    }
        /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // $credentials = $request->only('email', 'password');
   
        // // if($credentials['email']="khuyentrannguyen@gmail.com"  || $credentials['password'] == "AGk2FJsQYYenK3L")
        // // {
        //     // return redirect('voting');
        // // }
        // if (Auth::attempt($credentials)) {
           
        //     return redirect()->intended('dashboard');
        // }
        // var_dump($request->input('email'));
        // die();
        // var_dump( env("user", 'admin'));
        // var_dump( env("password", '123334'));
        // die();
        if ($request->input('username') ===   env("user", 'admin') && $request->input('password') ===  env("password", '123334')) {
            // var_dump(11111111111);
            // die();
            $request->session()->put('authenticated', time());
            return redirect()->intended('voting');
        }
        else return redirect()->intended('login');
    
        // return view('auth.login', [
        //     'message' => 'Provided PIN is invalid. ',
        // ]);
    }
    public function logout(Request $request)
    {
        $request->session()->forget('authenticated');
        return redirect()->intended('login');
    }
    // public function showLoginForm(Request $request)
    // {
    //     $is_login = $request->session()->get('authenticated');
    //     if($is_login)
    //     {
    //         return redirect()->intended('voting');
    //     }
    //     return view('auth.login');
    // }
}

