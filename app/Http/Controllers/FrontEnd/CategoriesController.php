<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Cours;
use App\Models\Grade;
use App\Traits\Image;
use App\Models\Categorie;
use App\Models\Certificate;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
   use image;

   public function index()
   {
      return view('frontend.index');
   }

   public function show_categorie_details_by_id($categorie_id)
   {

      try {
         $category = Categorie::find($categorie_id);
         if ($category) {
            $category->grade;
            $category->level;
            $available_cours = Cours::where('categorie_id', $categorie_id)->whereIn('status', [1, 2, 5])->get();
            if ($category->certificate_id != null)
               $category->certificate = Certificate::whereIn('id', $category->certificate_id)->get(['id', 'name']);
            if ($category->tag != null)
               $category->tag = Grade::whereIn('id', $category->tag)->get(['id', 'grade']);
            $category->global_image = $this->photos_dir($category->global_image);
            $category->toArray();
         }

         return view('frontend.categories.category-detail', compact('category', 'available_cours'));
         //         return response()->json(['status' => $status, 'categories' => $category_]);
      } catch (\Throwable $th) {
         throw $th;
      }
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
            $categories_ = $categories->toArray();
         }

         return response()->json(['status' => $status, 'categories' => $categories_]);
      } catch (\Throwable $th) {
         throw $th;
      }


      // $categories->each(function ($categorie) {
      //  return $categorie;
      //  });
   }


   public function show_related_category_of_tag($tag)
   {
      
        $grade = Grade::where('grade', $tag)->first();
      if (!$grade){
         return redirect()->back()->with('error', __('site.you have error'));
      }else {
          $related_category_by_tag= Categorie::where('tag',  'like', '%'.$grade->id.'%')->get();
         return view('frontend.categories.related-category',compact('related_category_by_tag'));
      }
        
   }
 

}
