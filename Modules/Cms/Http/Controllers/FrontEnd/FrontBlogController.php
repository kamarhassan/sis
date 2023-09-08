<?php

namespace Modules\Cms\Http\Controllers\FrontEnd;


use Illuminate\Http\Request;
use Modules\Cms\Entities\Blog;
use Illuminate\Routing\Controller;
use Modules\Cms\Events\BlogViewer;
use Illuminate\Contracts\Support\Renderable;
use Modules\Cms\Entities\BlogComment;

class FrontBlogController extends Controller
{
   /**
    * Display a listing of the resource.
    * @return Renderable
    */
   public function index()
   {

      $blog_post = Blog::where('status', 1)->get(['id', 'title', 'description', 'thumbnail', 'viewed', 'category_id', 'slug', 'viewed']);

      return view('cms::frontend.blog.index', compact('blog_post'));
   }


   public function show($slug)
   {

       $blog = Blog::where('slug', $slug)->first();
      $comments= BlogComment::blogcomment(null,$blog->id);
     
      event(new BlogViewer($blog));

      return view('cms::frontend.blog.post-details-and-comment.post-details', compact('blog','comments'));
   }

   /**
    * Show the form for editing the specified resource.
    * @param int $id
    * @return Renderable
    */
   public function edit($id)
   {
      return view('cms::edit');
   }

   /**
    * Update the specified resource in storage.
    * @param Request $request
    * @param int $id
    * @return Renderable
    */
   public function update(Request $request, $id)
   {
      //
   }

   /**
    * Remove the specified resource from storage.
    * @param int $id
    * @return Renderable
    */
   public function destroy($id)
   {
      //
   }










  
}
