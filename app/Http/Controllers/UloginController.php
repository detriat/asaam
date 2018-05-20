<?php
/**
 * Ulogin.ru auto registration or login.
 */
namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UloginController extends Controller
{
    // Login user through social network.
    public function login(Request $request, $id_image)
    {
        // Get information about user.
        $data = file_get_contents('http://ulogin.ru/token.php?token=' . $request->get('token') .
            '&host=' . $_SERVER['HTTP_HOST']);
        $user = json_decode($data, true);
        // Check exist email.

        if (isset($user['email']) && !empty($user['email'])) {
            // Find user in DB.
            $userData = User::where('email', $user['email'])->first();

            // Check exist user.
            if (!is_null($userData)) {

                return Redirect::back()->withErrors(['Такой пользователь уже учаустует в розыграше.']);

            } else {
                // Make registration new user.

                // Create new user in DB.
                $newUser = User::create([
                    'first_name'      => $user['first_name'],
                    'last_name'       => $user['last_name'],
                    'city'            => (isset($user['original_city'])) ? $user['original_city']  : $user['country'],
                    'email'           => $user['email'],
                    'photo'           => $user['photo'],
                    'id_image'        => (int)$id_image,
                    'network'         => $user['network'],
                    'network_profile' => $user['identity'],
                    'password'        => Hash::make(str_random(8)),
                    'status'          => true,
                    'ip'              => $request->ip()
                ]);

                // Make login user.
                Auth::loginUsingId($newUser->id, true);

                return redirect()->back()->with('network', $user['network']);
            }
        }

        return Redirect::back()->withErrors(['Мы не получили Ваш Email от этой социальной сети. Пожалуйста, попробуйте использовать другую!']);
    }
}