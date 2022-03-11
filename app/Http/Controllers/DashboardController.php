<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // all links that have under the user
        $links = Link::where('user_id',Session('user_id'))->select('id','long_url')->get();

        // get all links id that have under the user
        $links_id = Link::where('user_id',Session('user_id'))->pluck('id');

        // speacific link id by requested link  id or all links id this link_id will use to filter data
        $link_id = is_null($request->link_id)?$links_id:[$request->link_id];

        return view('dashboard',compact('links'));
    }
}
