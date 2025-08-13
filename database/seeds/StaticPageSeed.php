<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Cms\Entities\FrontPage;

class StaticPageSeed extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      FrontPage::create([
         'name' => 'Home',
         'title' => 'Home',
         'sub_title' => '',
         'details' => NULL,
         'slug' => '/',
         'status' => 1,
         'url_storage' => NULL,
         'is_static' => 1,

      ]);
      FrontPage::create([
         'name' => 'News',
         'title' => 'News',
         'sub_title' => '',
         'details' => NULL,
         'slug' => 'cms/news',
         'status' => 1,
         'url_storage' => '',
         'is_static' => 1,


      ]);
      // FrontPage::create([

      //    'name' => 'Our team',
      //    'title' => 'Our team',
      //    'sub_title' => '',
      //    'details' => NULL,
      //    'slug' => 'our-team',
      //    'status' => 1,
      //    'url_storage' => NULL,
      //    'is_static' => 1,

      ]);

  FrontPage::create([

         'name' => 'Contact Us',
         'title' => 'Contact Us',
         'sub_title' => '',
         'details' => NULL,
         'slug' => '/contact Us',
         'status' => 1,
         'url_storage' => NULL,
         'is_static' => 1,
]);
       
         FrontPage::create([
         'name' => 'About-us',
         'title' => 'About-us',
         'sub_title' => '',
         'details' => NULL,
         'slug' => '/about-us',
         'status' => 1,
         'url_storage' => '',
         'is_static' => 1,


      ]);
   }
}
