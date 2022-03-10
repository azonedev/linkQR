<?php

namespace App\Services;

class CheckExpireDate{

    public static function isExpired($expire_date)
    {
        $today = date('Y-m-d');
        if($today>$expire_date){
            return true;
        }else{
            return false;
        }
    }

}
