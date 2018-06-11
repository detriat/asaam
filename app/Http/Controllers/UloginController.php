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

    public function getUserData($token)
    {
        // Get information about user.
        $data = file_get_contents('http://ulogin.ru/token.php?token=' . $token .
            '&host=' . $_SERVER['HTTP_HOST']);
        $user = json_decode($data, true);

        $json = [];

        if (isset($user['email']) && !empty($user['email'])) {
            // Find user in DB.
            $userData = User::where('email', $user['email'])->first();

            // Check exist user.
            if (!is_null($userData)) {

                $json['error'] = 'Такой пользователь уже учаустует в розыграше.';

                return response()->json($json);

            }
        }else{
            $json['error'] = 'Мы не получили Ваш Email от этой социальной сети. Пожалуйста, попробуйте использовать другую!';

            return response()->json($json);
        }

        return response()->json($user);
    }

    public function register(Request $request){
        $user = $request->all();
        
        $json = [];

        $post_id = null;

        if ($user['network'] == 'vkontakte'){
            $link = 'https://promo.assamtea.kz/publication/'.$user['id_image'];

            $post_id = $this->vkWall($user['uid'], $link);
            
            if (is_null($post_id)){
                $json['error'] = 'Упс, мы не смогли разместить пост на вашей стене. Сделайте её публичной и повторите попытку';
                
                return response()->json($json);
            }
            
        }

        // Create new user in DB.
        $newUser = User::create([
            'first_name'      => $user['first_name'],
            'last_name'       => $user['last_name'],
            'city'            => (isset($user['original_city'])) ? $user['original_city']  : $user['country'],
            'email'           => $user['email'],
            'photo'           => $user['photo'],
            'id_image'        => (int)$user['id_image'],
            'network'         => $user['network'],
            'network_profile' => $user['identity'],
            'password'        => Hash::make(str_random(8)),
            'status'          => true,
            'ip'              => $request->ip(),
            'uid'             => $user['uid'],
            'post_id'         => $post_id
        ]);

        $json['network'] = $user['network'];
        $json['profile'] = $user['profile'];
        return response()->json($json);
    }

    public function vkWall($user_id, $link){

        header('Content-Type: text/html; charset=windows-1251');
        header('Access-Control-Allow-Origin: *');

        $app_ID = '6601801';
        /*$app_ID = '6500195';*/
        /*$token = '07933ed49a6d8c76f9236913c0ad8dd72d58fd71475bd0dcc46afb0080d74f6804d4264ae656644ef7a22';*/
        $token = '636715a942e5948a6d85d6281d076ca356d2784d81c4b7b584d220316f5796b77a8b117665f633df994a6';

        $message = 'Я сделал сэлфи со слоном что бы выиграть крутые призы. Попробуй и ты! #чайАССАМ #селфизапризы';

        $string_query = 'https://api.vk.com/method/wall.post?owner_id='.$user_id.'&attachments='.$link.'&message='.urlencode($message).'&access_token='.$token.'&v=5.78';

        $query = file_get_contents($string_query);
        $query = json_decode($query);

        return (isset($query->response)) ? $query->response->post_id : null;
    }
}