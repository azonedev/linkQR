<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class GithubAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function loginGithub()
    {
        $user = Socialite::driver('github')->stateless()->user();

        $data['name'] = $user->name;
        $data['mail'] = $user->email;
        $data['social_auth_id'] = $user->token;

        $isUser = User::where('mail',$data['mail'])->first();

        if($isUser){
            $this->sessionLogin($isUser);
            return redirect('/');
        }else{
            User::insert($data);
            $user = User::where('mail',$data['mail'])->first();
            $this->sessionLogin($user);
            return redirect('/');
        }
    }

    protected function sessionLogin($data)
    {
        Session::put('user_token',$data->social_auth_id);
        Session::put('user_mail',$data->mail);
        Session::put('user_name',$data->name);
    }
}
