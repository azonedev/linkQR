<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class UrlRedirectController extends Controller
{
    public function redirectURL($short_key)
    {
        // if short_key less than 6 then redirect home
        if(strlen($short_key)!=6) {
            Toastr::warning('Invalid URL');
            return redirect('/');
        }
        
        $url_data = Link::where('short_key',$short_key)->first();

        // check the link found on db or not
        if(is_null($url_data)){
            Toastr::warning("Request url isn't found");
            return redirect('/');
        }

        return redirect()->away($url_data->long_url);
    }
}
