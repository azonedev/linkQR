<?php

namespace App\Services;

use App\Models\Visitor;
use Illuminate\Support\Facades\DB;

class VisitorsReport{
    protected static function getLabelValuesByData($data,$month=null)
    {
        $labels = []; 
        $values = [];
        foreach($data as $data){
        
            $new_labels = $month!=null?($month[$data->labels]):($data->labels);

           array_push($labels,$new_labels);
           array_push($values,$data->count);
        }

        return ['labels'=>$labels,'values'=>$values];
    }


    public static function byLocation($link_id)
    {
        
        $data = Visitor::select([
            DB::raw('country as labels'),
            DB::raw("(COUNT(*)) as count"),
        ])
        ->whereIn('link_id',$link_id)
        ->groupBy('labels')
        ->get();

        return json_encode(VisitorsReport::getLabelValuesByData($data));
    }

    public static function byOS($link_id)
    {
        $data = Visitor::select([
            DB::raw('os as labels'),
            DB::raw("(COUNT(*)) as count"),
        ])
        ->whereIn('link_id',$link_id)
        ->groupBy('labels')
        ->get();

        return json_encode(VisitorsReport::getLabelValuesByData($data));
    }

}