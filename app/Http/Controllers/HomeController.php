<?php

namespace App\Http\Controllers;

use App\Model\Animation;
use App\User;
use App\Model\UserImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{

    protected $error = false;
    protected $user;


    public function __construct(Request $request)
    {

        $this->user   = new User();
        $user_ip      = $request->ip();
        $banned_users = $this->user->isBanned($user_ip);

        if (count($banned_users) > 0){
            abort(403);
        }

    }

    public function index(){

        $data = array();

        $data['title']  = 'Главная';
        $data['isHome'] = true;

        return view('pages.home', $data);
    }

    public function second(){

        $data = array();

        $data['title']  = 'Главная';
        $data['isHome'] = true;
        $data['isSecond'] = true;

        return view('pages.home', $data);
    }

    public function termsOfAction(){

        $data = array();

        $data['title'] = 'Условия акции';
        $data['terms'] = true;

        return view('pages.terms_of_action', $data);
    }

    public function userAgreement(){

        $data = array();

        $data['title'] = 'Соглашение с пользователем';
        $data['agreement'] = true;

        return view('pages.user_agreement', $data);
    }

    public function winners(){

        $data             = array();
        $data['title']    = 'Победители';
        $data['winners']  = true;
        $data['winners']  = $this->user->winners();

        return view('pages.winners', $data);
    }

    public function prizes(){

        $data = array();

        $data['title'] = 'Призы';
        $data['prizes'] = true;

        return view('pages.prizes', $data);
    }

    public function publication($id_image){

        $data = array();
        $data['title']  = 'Публикация в социальных сетях';
        $data['isHome'] = true;

        $image = UserImages::where('id', $id_image)->first();

        if (is_null($image)){
            abort(404);
        }

        $data['image']    = $image->name;
        $data['id_image'] = $id_image;

        return view('pages.publication', $data);
    }

    public function sequencesDesktop(){
        return view('sequences.second');
    }

    public function sequencesMobile(){
        return view('sequences.mobile');
    }
}
