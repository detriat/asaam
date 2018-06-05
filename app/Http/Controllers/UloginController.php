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
    public function login(Request $request, $token, $id_image)
    {
        // Get information about user.
        $data = file_get_contents('http://ulogin.ru/token.php?token=' . $token .
            '&host=' . $_SERVER['HTTP_HOST']);
        $user = json_decode($data, true);
        // Check exist email.

        $json = [];
        
        if (isset($user['email']) && !empty($user['email'])) {
            // Find user in DB.
            $userData = User::where('email', $user['email'])->first();

            // Check exist user.
            if (!is_null($userData)) {

                //return Redirect::back()->withErrors(['Такой пользователь уже учаустует в розыграше.']);
                $json['error'] = 'Такой пользователь уже учаустует в розыграше.';

                return response()->json($json);

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
                    'ip'              => $request->ip(),
                    'uid'             => $user['uid'],
                    'post_id'         => ($user['network']) ? $this->vkWall($user['uid'], $request->url()) : null
                ]);

                // Make login user.
                Auth::loginUsingId($newUser->id, true);

                //return redirect()->back()->with('network', $user['network']);
                $json['network'] = $user['network'];
                return response()->json($json);
            }
        }

        //return Redirect::back()->withErrors(['Мы не получили Ваш Email от этой социальной сети. Пожалуйста, попробуйте использовать другую!']);
        $json['error'] = 'Мы не получили Ваш Email от этой социальной сети. Пожалуйста, попробуйте использовать другую!';
        return response()->json($json);
    }

    public function vkWall($user_id, $link){

        header('Content-Type: text/html; charset=windows-1251');
        header('Access-Control-Allow-Origin: *');

        $app_ID = '6500195';
        $token = '07933ed49a6d8c76f9236913c0ad8dd72d58fd71475bd0dcc46afb0080d74f6804d4264ae656644ef7a22';

        $message = 'Я сделал сэлфи со слоном что бы выиграть крутые призы. Попробуй и ты! <br/>#чайАССАМ #селфизапризы';

        $string_query = 'https://api.vk.com/method/wall.post?owner_id='.$user_id.'&attachments='.$link.'&message='.urldecode($message).'&access_token='.$token.'&v=5.78';

        $query = file_get_contents($string_query);


        return $query['post_id'];
    }
}