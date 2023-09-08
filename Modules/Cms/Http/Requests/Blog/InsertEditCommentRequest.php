<?php

namespace Modules\Cms\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class InsertEditCommentRequest extends FormRequest
{
   /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
   public function rules()
   {
      // dd($this->comment_replay());
      return [
         // 'comment_title'=>'required|max:255',
         'comment' => $this->comment(),
         'blog_id' => 'required|exists:blogs,id',
         'comment_replay' => $this->comment_replay(),
      ];
   }

   /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */
   public function authorize()
   {
      return true;
   }


   private function comment()
   {

      if ($this->request->has('comment')) {
         return 'required';
      } else {
         return "";
      }
   }
   private function comment_replay()
   {

      if ($this->request->has('comment_replay')) {
         return 'required';
      } else {
         return "";
      }
   }
}
