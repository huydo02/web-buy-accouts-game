<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    // protected function redirectTo(){
    //     if (auth()->user()->role == 1) {
    //         return route('admin');
    //     }elseif (auth()->user()->role == 2){
    //         return route('home');   
    //     }
    // }
    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request,[
            'name' => 'required',
            'password' => 'required',
        ]);

        if(auth()->attempt(array('name'=>$input['name'] ,'password' =>$input['password']))){
            if(auth()->user()->role == 1){
                return redirect()->route('admin');
            }elseif(auth()->user()->role == 2){
                return redirect()->route('home');
            }

        }
        
        return redirect()->route('login')->with('error','your account or password are wrong!');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
