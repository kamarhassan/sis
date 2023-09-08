<?php

namespace Modules\Cms\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cms\Entities\FrontPage;
use Illuminate\Contracts\Support\Renderable;

class FrontPageController extends Controller
{
     public function show_page_in_front($slug)
   {
      try {
         //code...
         //  $slug;
         $page = FrontPage::where('slug', $slug)->get();
         
      //  dd($page);
       
       if ($page->count()==0){

            return abort(404);
         }
            // return '465';
         $t = $page[0]['details'];
         return view('frontend.pages', compact('t'));
      } catch (\Throwable $th) {

         throw $th;
         // return abort(404);
      }
   }
}
