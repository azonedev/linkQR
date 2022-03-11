<?php

namespace App\Services;

use App\Models\Visitor;
use Stevebauman\Location\Facades\Location;

class VisitorInfo{
    public static function insert($linkId)
    {
       
       $position = VisitorInfo::getPositionInfo();
       $device_os = VisitorInfo::getDevicOS();
       $browser  = VisitorInfo::browser();
       $traffic_source = VisitorInfo::trafficSource();

        return Visitor::create([
            'ip_address'    => $position->ip,
            'country'       => $position->countryName,
            'state'         => $position->regionName,
            'city'          => $position->cityName,
            'latitude'      => $position->latitude,
            'longitude'     => $position->longitude,
            'device'        => $device_os['device'],
            'os'        => $device_os['os'],
            'browser'        => $browser,
            'traffic_source'        => $traffic_source,
            'link_id'=>$linkId
        ]);
    }

    // get all ip related info from visitor
    protected static function getPositionInfo(){
         
        // getIPj form $_SERVER 
         $user_ip = $_SERVER['REMOTE_ADDR'];

         // set a default ip for localhost
         if ($user_ip == "127.0.0.1") $user_ip = '104.209.198.15';

         if ($position = Location::get($user_ip)) {
             return $position;
         }
    }

    // get visitor's device & os
    protected static function getDevicOS()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        // Device & OS info 
        if (strpos($user_agent, 'Win') !== FALSE) {
            $os = "Windows";
            $device = "Computer";
        } else if (strpos($user_agent, 'Mac') !== FALSE) {
            $os = "Mac";
            $device = "Computer";
        } else if (strpos($user_agent, 'iPhone') !== FALSE) {
            $os = "iPhone";
            $device = "Mobile";
        } else if (strpos($user_agent, 'Android') !== FALSE) {
            $os = "Andorid";
            $device = "Mobile";
        } else if(strpos($user_agent, 'Linux') !== FALSE) {
            $os = "Linux";
            $device = "Computer";
        }else{
            $os = "Unknown";
            $device = "Unknown";
        }

        return ['device'=>$device,'os'=>$os];
    }

    // get visitor's browser info
    protected static function browser()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        // Browser info
        if (strpos($user_agent, 'Edg/') !== FALSE) {
            return 'Microsoft-Edge';
        } else if (strpos($user_agent, 'Chrome/') !== FALSE ) {
            return 'Google-Chrome';
        } else if (strpos($user_agent, 'Firefox/') !== FALSE ) {
            return 'Mozilla-Firefox';
        } else if (strpos($user_agent, 'Safari/') !== FALSE) {
            return 'Safari';
        } else {
            return 'Unknown';
        }
    }

    // get http-reffer : where the user comes /traffic source
    protected static function trafficSource()
    {
        if(isset($_SERVER['HTTP_REFERER'])){
            if (strpos($_SERVER['HTTP_REFERER'], 'fbclid') !== FALSE) {
                return 'facebook.com';
            }else if(strpos($_SERVER['HTTP_REFERER'], 'google.com') !== FALSE){
                return 'google.com';
            }else{
                return 'unknown';
            }
        }else{
            return 'internal';
        }
    }
    


}