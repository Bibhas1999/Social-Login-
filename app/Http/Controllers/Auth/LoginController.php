<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Laravel\Socialite\Facades\Socialite;
use App\User;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

     // Google login
     public function redirectToGoogle()
     {
         return Socialite::driver('google')->stateless()->redirect();
     }
 
     // Google callback
     public function handleGoogleCallback()
     {
         $user = Socialite::driver('google')->stateless()->user();
 
         $this->_registerOrLoginUser($user);
 
         // Return home after login
         return redirect()->route('home');
     }
 
     // Facebook login
     public function redirectToFacebook()
     {
         return Socialite::driver('facebook')->redirect();
     }
 
     // Facebook callback
     public function handleFacebookCallback()
     {
         $user = Socialite::driver('facebook')->user();
 
         $this->_registerOrLoginUser($user);
 
         // Return home after login
         return redirect()->route('home');
     }
 
     // Github login
     public function redirectToGithub()
     {
         return Socialite::driver('github')->redirect();
     }
 
     // Github callback
     public function handleGithubCallback()
     {
         $user = Socialite::driver('github')->user();
 
         $this->_registerOrLoginUser($user);
 
         // Return home after login
         return redirect()->route('home');
     }

     protected function _registerOrLoginUser($data)
     {
         $user = User::where('email', '=', $data->email)->first();
         if (!$user) {
             $user = new User();
             $user->name = $data->name;
             $user->email = $data->email;
             $user->provider_id = $data->id;
             $user->avatar = $data->avatar;
             $user->avatar = $data->avatar;
             $user->save();
         }
 
         Auth::login($user);
     }
}
