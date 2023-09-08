<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Cours\CoursInterface;
use App\Repository\Slider\SliderInterface;
use App\Repository\Categorie\CategorieInterface;
use Modules\Cms\Entities\FrontPage;

class IndexController extends Controller
{
   protected $cours;
   protected $categoriesrepository;
   protected $slider;

   public function __construct(SliderInterface $sliderinterface, CoursInterface $cours, CategorieInterface $categorieInterface)
   {
      $this->cours = $cours;
      $this->categoriesrepository = $categorieInterface;
      $this->slider = $sliderinterface;
   }


   /**
    * Show the application dashboard.
    * @return \Illuminate\Contracts\Support\Renderable
    */
   public function index()
   {

      try {
         $cours = $this->cours->open_and_postopen_cours(10/*nb of class selected to show in front*/);

          $categories_cours = $this->categoriesrepository->all_categorie(10 /*nb of cours selected to show in front*/);
         $slider = $this->slider->AllActive();
        $certificate  =Certificate::get();
         if ($slider->count() == 0)
            $slider = null;
         return view('frontend.index', compact('cours', 'categories_cours', 'slider','certificate'));
      } catch (\Throwable $th) {
         throw  $th;
      }
     
   }

   public function show_page_in_front($slug)
   {
      try {
         //code...
         $page = FrontPage::where('slug', $slug)->get();
         if ($page->count() == 0) {

            return abort(404);
         }
         // return '465';
         $t = $page[0]['details'];
         return view('frontend.pages', compact('t'));
      } catch (\Throwable $th) {

         return abort(404);
         throw $th;
      }
   }
}
