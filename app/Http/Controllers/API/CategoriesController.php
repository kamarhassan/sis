<?php

namespace App\Http\Controllers\API;

use App\Models\Categorie;
use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Image;

class CategoriesController extends Controller
{
   use Image;

   public function index()
   {
      $categories = Categorie::Where('status', 1)->skip(0)->take(10)->get(
         [
            'id', 'name',
            'shorte_description',
            'global_image'
         ]
      );
      if (!$categories) {
         $status = 'error';
      } else {
         $status = 'success';
      }
      return response()->json(['status' => $status, 'categories' => $categories]);
   }
   public function all()
   {
      $categories = Categorie::Where('status', 1)->get(
         [
            'id', 'name',
            'shorte_description',
            'global_image',
            'duration'
         ]
      );


      $categories->each(function ($categorie) {
         $categorie->route = route('show.categorie.details_by_id', $categorie['id']);
         $categorie->global_image = asset( $categorie['global_image']);
         return $categorie;
      });


      if (!$categories) {
         $status = 'error';
      } else {
         $status = 'success';
      }

      return response()->json(['status' => $status, 'cours' => $categories->all(),'cours_details'=>__('site.cours details')]);
   }


   public function show_categorie_details($categorie_id)
   {


      try {
         $categories = Categorie::find($categorie_id);
         $status = 'error';
         $categories_ = '';
         if ($categories) {

            $certificate = Certificate::whereIn('id', $categories->certificate_id)->get(['id', 'name']);
            $categories->certificate_id = $certificate;
            $categories->global_image = $this->photos_dir($categories->global_image);
            $status = 'success';
            $categories_ =  $categories->toArray();
         }

         return response()->json(['status' => $status, 'categories' => $categories_]);
      } catch (\Throwable $th) {
         throw $th;
      }


      // $categories->each(function ($categorie) {
      //  return $categorie;
      //  });
   }

   private function datasetcategoriesslider($categories)
   {

      $array_data = [];
      foreach ($categories as $categorie) {
         $route = route('show.categorie.details_by_id', $categorie['id']);
         $temp = '<div class="item"><img src="' . $categorie['global_image'] . '" width="150px" alt="Owl Image">';
         $temp .= '<a href="' . $route . '"><h1 class="text-warning">' . $categorie['name'] . '</h1></a>';
         $temp .= '<p>' . $categorie['shorte_description'] . '</p></div>';
         $array_data[] = $temp;
      }
      return $array_data;
   }
}
