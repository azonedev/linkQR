<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class LinkGenerateController extends Controller
{
    public function generate(Request $request)
    {
        $data = $request->only('long_url','expire_date');

        $data['short_key'] = $this->generateShortURLKey();
        $data['user_id'] = Session('user_id')?Session('user_id'):null;

        $respData = Link::create($data);

        return response()->json($respData);
    }

    protected function generateShortURLKey()
    {
        $key = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6);
        $checkData = Link::where('short_key',$key)->first();

        if($checkData!=null){
            $this->generateShortURLKey();
        }

        return $key;
    }
}
