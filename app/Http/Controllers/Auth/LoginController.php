<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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

    public function login(){

        return view('auth.login');
    }


    public function socialite($provider){
        if ($provider !== 'instagram'){
            return Socialite::driver( $provider )->fields([
                'first_name', 'last_name', 'email', 'location', 'publish_actions'
            ])->scopes([
                'user_location'
            ])->redirect();
        }else{
            return Socialite::driver( $provider )->redirect();
        }
    }

    public function socialiteCallback(Request $request, $provider){

        if ($provider !== 'instagram'){
            $user = Socialite::driver($provider)->fields([
                'first_name', 'last_name', 'email','location', 'publish_actions'
            ])->user();
        }else{
            $user = Socialite::driver($provider)->user();
        }
        //dd($user);

        if (isset($user['email']) && !empty($user['email'])) {
            // Find user in DB.
            $userData = User::where('email', $user['email'])->first();

            // Check exist user.
            if (!is_null($userData)) {

                return Redirect::back()->withErrors(['Такой пользователь уже учаустует в розыграше.']);

            } else {
                // Make registration new user.

                $profile_url = '';

                if ($provider === 'facebook'){
                    $profile_url = 'https://www.facebook.com/' . $user['id'];
                }else if ($provider === 'vkontakte'){
                    $profile_url = 'https://vk.com/id' . $user['id'];
                }

                // Create new user in DB.
                $newUser = User::create([
                    'first_name'      => $user['first_name'],
                    'last_name'       => $user['last_name'],
                    'city'            => (isset($user['location'])) ? $user['location']['name']  : '',
                    'email'           => $user['email'],
                    'photo'           => $user->getAvatar(),
                    'id_image'        => 17, // Исправить
                    'network'         => $provider,
                    'network_profile' => $profile_url,
                    'password'        => Hash::make(str_random(8)),
                    'status'          => true,
                    'ip'              => $request->ip()
                ]);

                // Make login user.
                //Auth::loginUsingId($newUser->id, true);

                return redirect()->back()->with('network', $provider);
            }
        }

        return Redirect::back()->withErrors(['Мы не получили Ваш Email от этой социальной сети. Пожалуйста, попробуйте использовать другую!']);
    }

}
