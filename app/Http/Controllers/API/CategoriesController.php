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
        $categories = Categorie::Where('status', 1)->paginate(4);

        $categories->each(function ($categorie) {
            $certificate = Certificate::whereIn('id', $categorie->certificate_id)->get(['id', 'name']);
            $categorie->certificate_id = $certificate;
            // $categorie->push  (['url_test'=>URL('categorie/'.$categorie['id'])]) ;
            $categorie->categorie_url = URL('categorie/'.$categorie['id']) ;
            // $collection->push(['id'=>4, 'name'=>'vimal']);
            return $categorie;
        });
        if (!$categories) {
            $status = 'error';
        } else {
            $status = 'success';
        }
        //  return view('frontend.index',compact('categories'));
        return response()->json(['status' => $status, 'categories' => $categories->toArray()]);
    }


    public function show_categorie_details($categorie_id)
    {
       
       
       try {
        $categories = Categorie::find($categorie_id);
        $status = 'error';
        $categories_='';
        if( $categories){

            $certificate = Certificate::whereIn('id', $categories->certificate_id)->get(['id', 'name']);
            $categories->certificate_id = $certificate;
            $categories->global_image = $this->photos_dir($categories->global_image);
            $status = 'success';
           $categories_ =  $categories->toArray();
        }
      
        return response()->json(['status' => $status, 'categories' =>$categories_ ]);   
       } catch (\Throwable $th) {
        throw $th;
       }
       
       
        // $categories->each(function ($categorie) {
        //  return $categorie;
        //  });
    }
}
