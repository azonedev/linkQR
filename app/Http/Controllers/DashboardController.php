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
        $group_by = is_null($request->group_by)?'month':$request->group_by;

        // all links that have under the user
        $links = Link::where('user_id',Session('user_id'))->select('id','long_url')->get();

        // get all links id that have under the user
        $links_id = Link::where('user_id',Session('user_id'))->pluck('id');

        // speacific link id by requested link  id or all links id this link_id will use to filter data
        $link_id = is_null($request->link_id)?$links_id:[$request->link_id];

        // total clicks of all or speacific link
        $total_clicks = Visitor::whereIn('link_id',$link_id)->count();

        $visitorsChartData = VisitorsReport::byGroup($link_id,$group_by);
        $locationChartData = VisitorsReport::byLocation($link_id);
        $osChartData = VisitorsReport::byOS($link_id);
       
        $visitors_table = Visitor::select('country','device','browser','traffic_source','os')->whereIn('link_id',$link_id)->orderBy('id','desc')->paginate(15);

        // this data use to export visitors data as csv
        $export_visitors_table_data = json_encode(Visitor::select('country','device','browser','traffic_source','os')->whereIn('link_id',$link_id)->orderBy('id','desc')->get());

        return view('dashboard',compact('links','total_clicks','visitorsChartData','locationChartData','osChartData','visitors_table','export_visitors_table_data'));
    }
}
