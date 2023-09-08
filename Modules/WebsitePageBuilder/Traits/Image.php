<?php

namespace App\Traits;

use Illuminate\Support\Facades\URL;

trait Image
{
    function  photos_dir($photoUrl)
    {

        if ($photoUrl != "")
            return  URL::asset($photoUrl);
        else   return ''; //URL::asset('assets\images\avatar\avatar-1.png');

    }

    function saveImage($photo, $folder)
    {

        //save photo in folder
        $file_extension = $photo->getClientOriginalExtension();
        $file_name = $folder . '/' . time() . '.' . $file_extension;
        $path = $folder;
        $photo->move($path, $file_name);

        return $file_name;
    }

    function removeImagefromfolder($photo_dir)
    {
        if ($photo_dir != '') {

            unlink($photo_dir);
        }
    }

    function saveMultiImage($imagefile, $folder)
    {
        $image_array = [];
        foreach ($imagefile as $photo) {

            // $file_extension = $photo->getClientOriginalExtension();
     
            $file_name =     $folder . '/' . preg_replace("/\s+/", "", $photo->getClientOriginalName()) ;
            $path = $folder;
            $photo->move($path, $file_name);
            $image_array[] = $file_name;
            // return $file_name;
        }
        return  $image_array;
    }
}
