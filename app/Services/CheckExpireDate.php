<?php

namespace App\Services;

use function PHPUnit\Framework\returnSelf;

class CheckExpireDate{

    public static function isExpired($expire_date)
    {
        $today = date('Y-m-d');
        
        if($expire_date==null) return false;

        if($today>$expire_date){
            return true;
        }else{
            return false;
        }
    }

}
