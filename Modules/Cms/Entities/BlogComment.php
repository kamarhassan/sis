<?php

namespace Modules\Cms\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
   protected $guarded = [];

   
   
   
   public function replies()
   {
      return $this->hasMany(BlogComment::class, 'comment_id')->orderByDesc('id');
   }

   public function user()
   {
      return $this->belongsTo(User::class)->withDefault();
   }



   public static function blogcomment($parent_id = null, $blog_id)
   {


         // $blogcomment = BlogComment::where('blog_id', $blog_id)->where('comment_id', $parent_id)->get();
    
         $blogcomments = BlogComment::where('blog_id', $blog_id)->where('comment_id', $parent_id)->get();
      $blogcomment = [];
      foreach ($blogcomments as $comment) {
         $blogcommentData = [
            'id' => $comment->id,
            'user'    => User::find($comment->user_id),
            'name'       => $comment->name,
            'email'      => $comment->email,
            'comment'    => $comment->comment,
            'comment_id' => $comment->comment_id,
            'blog_id'    => $comment->blog_id,
            'parent_id' =>$comment->parent_id,
            'status'     => $comment->status,
            'create_at' =>$comment->created_at,
            'children' => BlogComment::blogcomment($comment->id,$blog_id)
         ];
         $blogcomment[] = $blogcommentData;
      }

      return $blogcomment;
   }
}
