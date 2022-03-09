<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class AuthController extends Controller
{
    public function login()
    {
        if(Session('user_id')){

            Toastr::warning('You are already logged in');
            return redirect('/');
        }
        return view('login');
    }

    public function logout(Request $request)
    {
        $request->session()->flush(); //flush method delete all sessions

        Toastr::success('Logout successfully');
        return redirect('/');
    }
}
