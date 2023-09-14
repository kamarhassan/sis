<?php

namespace App\Repository\Categorie;

use App\Models\Categorie;
use App\Models\Grade;
use App\Models\Level;

class CategorieRepository implements CategorieInterface
{
   public function all_categorie_id_name()
   {
      $categories = Categorie::where('status', 1)->select('id', 'name');

   }

   public function all_categorie_id_name_by_ids(array $id)
   {
      return Categorie::where('status', 1)->whereIn('id', $id)->first();
   }

   public function all_categorie($limit = null)
   {

      $selected = [
         'id', 'name',
         'shorte_description',
         'global_image',
         'duration',
         'total_hours',
         'level_id',
         'grade_id'

      ];

      $categories = Categorie::orderBy("id", "DESC")->Where('status', 1)->get($selected);

      if ($limit != null)
         $categories->take($limit);


      $categories->each(function ($categorie) {
         $categorie->grade = Grade::find($categorie->grade_id)['grade'];
         $categorie->level = Level::find($categorie->level_id)['level'];
         $categorie->route = route('show.categorie.details_by_id', $categorie['id']);
         $categorie->global_image = asset($categorie['global_image']);
         return $categorie;
      });
      return $categories;
   }
}
