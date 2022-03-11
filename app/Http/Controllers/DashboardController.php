<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Visitor;
use App\Services\VisitorsReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $locationChartData = VisitorsReport::byLocation($link_id);
        $osChartData = VisitorsReport::byOS($link_id);
       
        $visitors_table = Visitor::select('country','device','browser','traffic_source','os')->whereIn('link_id',$link_id)->orderBy('id','desc')->paginate(15);

        return view('dashboard',compact('links','total_clicks','locationChartData','osChartData','visitors_table'));
    }
}
