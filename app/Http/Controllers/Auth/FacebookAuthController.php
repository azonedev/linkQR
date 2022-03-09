<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class FacebookAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function loginFacebook()
    {
        $user = Socialite::driver('facebook')->stateless()->user();

        $data['name'] = $user->name;
        $data['mail'] = $user->email;
        $data['social_auth_id'] = $user->id;

        $isUser = User::where('mail',$data['mail'])->first();

        try {
            if($isUser){
                $this->sessionLogin($isUser);
                
                Toastr::success('Logged in ');
                return redirect('/');
            }else{
                User::insert($data);
                $user = User::where('mail',$data['mail'])->first();
                $this->sessionLogin($user);
    
                Toastr::success('Logged in ');
                return redirect('/');
            }
        } catch (\Exception $ex) {
            Toastr::warning('Faild to login, try again');
            return redirect('auth/login');
        }
    }

    protected function sessionLogin($data)
    {
        Session::put('user_token',$data->social_auth_id);
        Session::put('user_mail',$data->mail);
        Session::put('user_name',$data->name);
    }
}
