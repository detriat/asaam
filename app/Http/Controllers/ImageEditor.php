<?php

namespace App\Http\Controllers;

use App\Model\Animation;
use App\Model\UserImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageEditor extends Controller
{
    public function uploadBase64Image(Request $request){
        $json = array();
        $data = $request->all();

        if ( !isset($data['base64Image']) ){
            $json['error'] = 'Ошибка. Изображение не пришло';
        }

        if (!$json){

            $img = $data['base64Image'];
            $img = str_replace('data:image/jpeg;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $fileData = base64_decode($img);

            $upload_dir = public_path('images');

            if ( !is_dir($upload_dir) ){
                mkdir($upload_dir, 0777, true);
            }


            $img_name = uniqid() . '.jpg';
            $file_path = $upload_dir . '/' . $img_name;
            file_put_contents($file_path, $fileData);

            $new_image = UserImages::create([
                'name' => 'images/'.$img_name
            ]);

            $json['redirect'] = action('HomeController@publication', ['id' => $new_image->id ]);
        }

        return response()->json($json);
    }
    
    public function createBase64Image(Request $request){

        $json = [];
        $json['url'] = $request->input('url');
        $json['id'] = Animation::create([
            'url' => $request->input('url')
        ]);

        return response()->json($json);
    }

    public function getImages(){
        $animations = Animation::all()->take(25);

        return response()->json($animations);
    }
}
