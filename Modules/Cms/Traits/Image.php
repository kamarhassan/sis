<?php

namespace Modules\Cms\Traits;

use Illuminate\Support\Facades\URL;

trait Image
{
    function  photos_dir($photoUrl)
    {

        if ($photoUrl != "")
            return  URL::asset($photoUrl);
        else   return ''; //URL::asset('assets\images\avatar\avatar-1.png');

    }

    function uploadImage($photo, $folder)
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


    function saveImage($photo, $folder)
    {

        //save photo in folder
//        $file_extension = $photo->getClientOriginalExtension();
        $file_name = $folder . '/' . time() . '.' . preg_replace("/\s+/", "", $photo->getClientOriginalName());
        $path = $folder;
        $photo->move($path, $file_name);

        return $file_name;
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
    function removeFolder($folderPath) {
      // Add a trailing slash to the folder path if it's missing
      $folderPath = rtrim($folderPath, '/') . '/';
  
      // Get a list of all files and subdirectories inside the folder
      $files = glob($folderPath . '*');
  
      // Loop through each file and directory
      foreach ($files as $file) {
          if (is_file($file)) {
              // If it's a file, delete it
              unlink($file);
          } elseif (is_dir($file)) {
              // If it's a directory, recursively remove it
              $this->removeFolder($file);
          }
      }
  
      // After deleting all files and subdirectories, remove the folder itself
      rmdir($folderPath);
  }
  
  
  
}
