<?php

namespace App\Traits;

trait Image
{
    function  photos_dir($photoUrl)
    {
        //photoUrl = folder/name_img
        if ($photoUrl != "")
            return  URL::asset($photoUrl);
        else   return URL::asset('assets\images\avatar\avatar-1.png');
    
    
        // assets\images\avatar\avatar-1.png
    }
}
