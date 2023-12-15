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
      $new_content = Str::of($data['content'])->replace('css/custom.css', URL::asset('Modules/WebsitePageBuilder/assets/css_templates/custom.css'));
      $new_content = Str::of($new_content)->replace('css/bootstrap.min.css', URL::asset('Modules/WebsitePageBuilder/assets/css_templates/bootstrap.min.css'));

      //     dd( $new_content);
      $page->details = $new_content;

      $base_path_of_style = 'Modules/WebsitePageBuilder/assets/css_templates/';
      $storage_destination_base_url = 'WebsitePageBuilder/' . $page->slug . '/';

      if (File::exists(($base_path_of_style . 'custom.css')) && File::exists($base_path_of_style . '/bootstrap.min.css')) {

         // //   Storage::put( $storage_destination_base_url .  $page->id . '.html', $data['content'], 'public');
         if (!is_dir(dirname(public_path( $storage_destination_base_url . $page->id . '.html')))) {
            mkdir(dirname(public_path( $storage_destination_base_url . $page->id . '.html')), 0755, true);
         }

         File::put(public_path( $storage_destination_base_url . $page->id . '.html'), $data['content']);


         // $t1 = File::files($base_path_of_style);

         //   Storage::put($storage_destination_base_url . 'css/custom.css', file_get_contents($base_path_of_style . 'custom.css'));
         // if (!is_dir(dirname('/public/' . $storage_destination_base_url . 'css/custom.css'))) {
         //    mkdir(dirname('/public/' . $storage_destination_base_url . 'css/custom.css'), 0755, true);
         // }
         // file_put_contents('/public/' . $storage_destination_base_url . 'css/custom.css', file_get_contents($base_path_of_style . 'custom.css'));


         if (!is_dir(dirname(public_path( $storage_destination_base_url . 'css/custom.css')))) {
            mkdir(dirname(public_path( $storage_destination_base_url . 'css/custom.css')), 0755, true);
         }

         File::put(public_path( $storage_destination_base_url . 'css/custom.css'), file_get_contents($base_path_of_style . 'custom.css'));







         //   Storage::put( $storage_destination_base_url . 'css/bootstrap.min.css', file_get_contents($base_path_of_style . 'bootstrap.min.css'));
         // if (!is_dir(dirname('/public/' . $storage_destination_base_url . 'css/bootstrap.min.css'))) {
         //    mkdir(dirname('/public/' . $storage_destination_base_url . 'css/bootstrap.min.css'), 0755, true);
         // }
         // file_put_contents('/public/' . $storage_destination_base_url . 'css/bootstrap.min.css', file_get_contents($base_path_of_style . 'bootstrap.min.css'));
     

         if (!is_dir(dirname(public_path( $storage_destination_base_url . 'css/bootstrap.min.css')))) {
            mkdir(dirname(public_path( $storage_destination_base_url . 'css/bootstrap.min.css')), 0755, true);
         }

         File::put(public_path( $storage_destination_base_url . 'css/bootstrap.min.css'),file_get_contents($base_path_of_style . 'bootstrap.min.css'));


     
     
      } else {
         // $t = File::copy($base_path_of_style . '/custom.css', 'WebsitePageBuilder/' . $page->slug . '/css/custom.css');
         // dd($t);
      }


      // dd(Storage::url($storage_destination_base_url .  $page->id . '.html'));
      // $file = Str::of(Storage::url($storage_destination_base_url .  $page->id . '.html'))->replace("storage", "storage/app");

      $page->url_storage = Str::of('public/'.$storage_destination_base_url . $page->id . '.html');//->replace("storage", "storage/app"); // Storage::url($page->slug.'.html');
      //      $page->url_storage = 'public/'.$storage_destination_base_url . $page->id . '.html';//->replace("storage", "storage/app"); // Storage::url($page->slug.'.html');

      $page->save();
   }
}
