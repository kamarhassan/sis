<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;

class CategoriesInsertRequest extends FormRequest
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
//      dd(strcasecmp($this->short_desc,"<div>&nbsp;</div>"));
      return [

         'categorie' => 'required|max:150',
         // 'certificate'=>'', 
         //            'certificate' => 'required|array',
         //            'certificate.*' => 'exists:certificates,id',
         'grade' => 'required|exists:grades,id',
         'level' => 'required|exists:levels,id',

         'nb_total_hours' => $this->nb_total_hours(),
         'duration' => $this->duration(),
         'status' => $this->status(),

         'global_image' => $this->global_image(),
         'attache' => $this->attache(),
         'url_video_imbed' => $this->url_video_imbed(),

         'short_desc' => $this->short_desc(),
         'desc' => $this->desc(),
         'details' => $this->details(),
//         'requireKnwoledge' => $this->requireKnwoledge(),
//         'prerequests' => $this->prerequests(),
         'target_students' => $this->target_students(),
         'callery' => $this->callery(),
         'callery.*' => $this->callery_(),


      ];
   }



   public  function messages()
   {
      return [
         '*.required' => __('site.its_require'),
         '*.numeric' => __('site.must be a number'),
         '*.exits' => __('site.its_exists'),
         ''
               ];
   }
   
   
   
   
   
   
   
   
   private function global_image()
   {
      //|dimensions:width=150px,height=150px';
      if ($this->global_image != "")
         return 'required|image|mimes:png,jpg';
      return '';
   }

   private function attache()
   {
      if ($this->attache != "")
         return 'required|mimes:pdf';
      return '';
   }

   private function url_video_imbed()
   {

      if ($this->url_video_imbed != "")
         return 'required|url';
      return '';
   }

   private function nb_total_hours()
   {
      return 'required|numeric';
      if ($this->nb_total_hours != "")
         return 'required|numeric';
      return '';
   }

   private function duration()
   {
      return 'required|numeric';
      if ($this->nb_total_hours != "")
         return 'required|numeric';
      return '';
   }

   private function status()
   {

      if ($this->status != "")
         return 'required|in:0,1';
      return '';
   }

   private function short_desc()
   {

      if ($this->short_desc != "")
         return 'required';
      else
         if (count(explode(' ', $this->short_desc)) > 40)
            return 'required|max:40';
         

      return 'required';


   }

   private function callery()
   {
      
      if ($this->callery != "")
         return 'required|array ';
      return '';
   }

   private function callery_()
   {
      return 'mimes:png,jpg';
      if ($this->callery != "")
         return 'required|array ';
      return '';
   }


   private function desc()
   {
      return 'required';
   }

   private function details()
   {
      return 'required';
   }

   private function requireKnwoledge()
   {
      return 'required';
   }

   private function prerequests()
   {
      return 'required';
   }

   private function target_students()
   {
      return 'required';
   }
}
