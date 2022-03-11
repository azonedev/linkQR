<?php

namespace App\Http\Controllers;

use App\Services\CheckExpireDate;
use App\Models\Link;
use Brian2694\Toastr\Facades\Toastr;

class UrlRedirectController extends Controller
{
    public function __construct()
    {
        $url_data = Link::where('short_key',request()->route('short_key'))->first();

        // Middleware for limiting request to protect spam
        $this->middleware("throttle:$url_data->loadlimit,$url_data->within,$url_data->blockfor");
    }

    public function redirectURL($short_key)
    {
        // if short_key less than 6 then redirect home
        if(strlen($short_key)!=6) {
            Toastr::warning('Invalid URL');
            return redirect('/');
        }
        
        $url_data = Link::where('short_key',$short_key)->first();

        $is_expired = CheckExpireDate::isExpired($url_data->expire_date);

        // check the link found on db or is the link expired
        if(is_null($url_data) || $is_expired===true){
            Toastr::warning("Request url isn't found");
            return redirect('/');
        }

        return redirect()->away($url_data->long_url);
    }
}
