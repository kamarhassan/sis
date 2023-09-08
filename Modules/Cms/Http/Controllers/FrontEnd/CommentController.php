<?php

namespace Modules\Cms\Http\Controllers\FrontEnd;

use PSpell\Config;
use Illuminate\Http\Request;

use Modules\Cms\Entities\Blog;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Modules\Cms\Entities\BlogComment;
use Illuminate\Contracts\Support\Renderable;
use Modules\Cms\Http\Requests\Blog\InsertEditCommentRequest;

class CommentController extends Controller
{

   public function post_comment(InsertEditCommentRequest $request)
   {

      try {
         $comment_id = null;
         // if()
         // return $request;
         $user = Auth::user();



         $is_saved =   BlogComment::updateOrCreate([
            'id' => $request->id,
         ], [

            'user_id' => $user->id,
            // 'name' =>  $request->comment_title,
            'email' => $user->email,
            'comment' => $request->comment,
            'comment_id' => $comment_id,
            'blog_id' => $request->blog_id,
            'status' => config('cms.comment_auto_approve'),

         ]);

         if ($is_saved) {
            $status = 'success';
            $message = __('site.Post created successfully!');
            $route = route('cms.blogs.index');
         } else {
            $status = 'error';
            $message = __('site.you have error');
            $route = '#';
         }
         return response()->json(['status' =>   $status, 'message' =>   $message, 'route' =>  $route]);
      } catch (\Throwable $th) {
         throw $th;
      }

      return $request;
   }
   public function replay_comment(InsertEditCommentRequest $request)
   {

      try {



         $user = Auth::user();


         $is_saved =   BlogComment::Create(

            [
               'user_id' => $user->id,
               // 'name' =>  $request->comment_title,
               'email' => $user->email,
               'comment' => $request->comment_replay,
               'comment_id' =>  $request->comment_id,
               'blog_id' => $request->blog_id,
               'parent_id' => $request->parent_id,
               'status' => config('cms.comment_auto_approve'),

            ]
         );

         if ($is_saved) {
            $status = 'success';
            $message = __('site.Post created successfully!');
            // $Blog_slug =Blog::find($request->blog_id)->slug;
            $route = route('cms.web.blog.post.detail', Blog::find($request->blog_id)->slug);
         } else {
            $status = 'error';
            $message = __('site.you have error');
            $route = '#';
         }
         return response()->json(['status' =>   $status, 'message' =>   $message, 'route' =>  $route]);
      } catch (\Throwable $th) {
         throw $th;
      }

      return $request;
   }


   public function delete_comment(Request $request)
   {
      try {
         $dd = [];
         DB::beginTransaction();
         $comment =  BlogComment::find($request->id);
         if (!$comment) {
            $status = 'error';
            $message = __('site.you have error');
            $route = '#';
            return response()->json(['status' =>   $status, 'message' =>   $message]);
         }

         $is_deleted = $comment->delete();

         if ($is_deleted) {
            $message = __('site.deleted');
            $status = 'success';
         } else {
            $status = 'error';
            $message = __('site.you have error');
         }

         DB::commit();

         return response()->json(['status' =>   $status, 'message' =>   $message]);
      } catch (\Throwable $th) {
         throw $th;
         DB::rollback();
      }
   }

   public function edit_comment(Request $request)
   {

      try {
         //code...
         $blogcomment =   BlogComment::find($request->id);
         $blogcomment->comment = $request->comment;
         $is_saved  = $blogcomment->save();
         if ($is_saved) {
            $status = 'success';
            $message = __('site.Post created successfully!');
            $route = route('cms.web.blog.post.detail', Blog::find( $blogcomment->blog_id)->slug);
         } else {
            $status = 'error';
            $message = __('site.you have error');
            $route = '#';
         }
         return response()->json(['status' =>   $status, 'message' =>   $message, 'route' =>  $route]);
      } catch (\Throwable $th) {
         throw $th;
      }
   }
}
