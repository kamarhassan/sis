<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(){
        $categories = Categorie::paginate(pagination_count()) ;

        $categories->each(function ($categorie) {
         $certificate = Certificate::whereIn('id', $categorie->certificate_id)->get(['id', 'name']);
         $categorie->certificate_id = $certificate;
         return $categorie;
     });
     if(!$categories){
        $status='error';
     }else{
        $status='success';
     }
     return view('frontend.index',compact('categories'));
    }
     public function show_categorie_details_by_id($cour){
        return view('frontend.categories.category-detail');
     }
}
