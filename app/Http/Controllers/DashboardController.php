<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Visitor;
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

        // total clicks of all or speacific link
        $total_clicks = Visitor::whereIn('link_id',$link_id)->count();



        // return $active_links;

        return view('dashboard',compact('links','total_clicks'));
    }
}
