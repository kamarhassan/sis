<?php

namespace App\Traits;

trait Image
{
    function  photos_dir($photoUrl)
    {
        
        if ($photoUrl != "")
            return  URL::asset($photoUrl);
        else   return URL::asset('assets\images\avatar\avatar-1.png');
    
    
        // assets\images\avatar\avatar-1.png
    }

    function saveImage($photo,$folder){
       
        //save photo in folder
        $file_extension = $photo -> getClientOriginalExtension();
        $file_name = $folder.'/'.time().'.'.$file_extension;
        $path = $folder;
        $photo -> move($path,$file_name);

        return $file_name;
    }

}
