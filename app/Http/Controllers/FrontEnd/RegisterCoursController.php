<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Cours\CoursInterface;
use App\Repository\Cours_fee\CoursFeeInterface;
use App\Http\Requests\OrderRegistartionFromUser;
use App\Repository\RegisterCours\RegisterCoursInterface;

class RegisterCoursController extends Controller
{
   protected $cours;
   protected $coursfee;
   protected $registerCoursInterface;
   public function __construct(
      CoursInterface $cours,
      CoursFeeInterface $coursfee,
      RegisterCoursInterface $registerCoursInterface
   ) {

      $this->coursfee = $coursfee;
      $this->cours = $cours;
      $this->registerCoursInterface = $registerCoursInterface;
   }

   // public function RegisterCours(Request $request)
   public function RegisterCours(OrderRegistartionFromUser $request)
   {
      
      try {
         $inserted=     $this->registerCoursInterface->register_in_cours($request);
         if ($inserted) {
            return   response()->json(['status' => 'success','message' => __('site.cours successfully registered'),'btn'=>'<a href="#" id="btn_register">'.__('site.you already reserved this cours').'</a>']);
        } else {

            return  response()->json(['status' => 'error','message' => __('site.cours failed registered')]);
         }
      } catch (\Throwable $th) {
//          throw $th;
         return  response()->json(['status' => 'error','message' => __('site.you have error')]);
      }
   }
   public function delete_cours_reserved(Request $request)
   {
      try {
          $delete =  $this->registerCoursInterface->delete_register_in_cours($request->id);
         if ($delete)
         {

            $notification = [
               'message' => __('site.payment has delete success'),
               'status' => 'success',
            ];
         } else {
            $notification = [
               'message' => __('site.payment faild '),
               'status' => 'error',
            ];
         }
         return response()->json($notification);
      } catch (\Throwable $th) {
         $notification = [
            'message' => __('site.you site.you have error'),
            'status' => 'error',
         ];
         return response()->json($notification);
         // throw $th;
      }
   }
}
