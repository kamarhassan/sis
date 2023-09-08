<?php


namespace Modules\WebsitePageBuilder\Repositories;

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Modules\Cms\Entities\FrontPage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class PageBuilderRepository
{

   public function designUpdate(array $data, $id)
   {
      $page = FrontPage::where('id', $id)->first();
      $new_content= Str::of($data['content'])->replace('css/custom.css', URL::asset('Modules/WebsitePageBuilder/assets/css_templates/custom.css'));
     $new_content =Str::of( $new_content)->replace('css/bootstrap.min.css', URL::asset('Modules/WebsitePageBuilder/assets/css_templates/bootstrap.min.css'));
      
//     dd( $new_content);
      $page->details = $new_content;
      
      $base_path_of_style = 'Modules/WebsitePageBuilder/assets/css_templates/';
      $storage_destination_base_url = 'WebsitePageBuilder/' . $page->slug . '/';

      if (File::exists(($base_path_of_style . 'custom.css')) && File::exists($base_path_of_style . '/bootstrap.min.css')) {

         Storage::put('/' . $storage_destination_base_url .  $page->id . '.html', $data['content'], 'public');


         $t1 = File::files($base_path_of_style);
         // dd($t1);
         // dd(file_get_contents($base_path_of_style . 'custom.css'));

         Storage::put($storage_destination_base_url . 'css/custom.css', file_get_contents($base_path_of_style . 'custom.css'));
         //  File::moveDirectory($base_path_of_style . 'custom.css',    $storage_destination_base_url.'css/custom.css');
         Storage::put($storage_destination_base_url . 'css/bootstrap.min.css', file_get_contents($base_path_of_style . 'bootstrap.min.css'));
      } else {
         // $t = File::copy($base_path_of_style . '/custom.css', 'WebsitePageBuilder/' . $page->slug . '/css/custom.css');
         // dd($t);
      }


      // dd(Storage::url($storage_destination_base_url .  $page->id . '.html'));
      $file = Str::of(Storage::url($storage_destination_base_url .  $page->id . '.html'))->replace("storage", "storage/app");

      $page->url_storage = Str::of(Storage::url($storage_destination_base_url .  $page->id . '.html'))->replace("storage", "storage/app"); // Storage::url($page->slug.'.html');
      //   return $page->setTranslation('details', $data['content'], $data['body'])
      $page->save();
   }

  
}
