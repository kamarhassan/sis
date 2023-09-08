<?php

namespace Modules\Cms\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class InsertEditBlogRequest extends FormRequest
{



    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
         'title'=>'required|max:255|unique:blogs,title,except,id',
         'description'=>'required',
         'slug'=>'required|unique:blogs,slug,except,id',
//         'category'=>'required|exists:blog_categories,id',
         
         'global_image'=>'required|mimes:png,jpg',
        
        ];
    }
    public  function messages()
    {
        return [
            '*.required' => __('site.its_require'),
            '*.unique' => __('site.must be a unique'),
            '*.exists' => __('site.its_exists'),

        ];
    }
   
}
