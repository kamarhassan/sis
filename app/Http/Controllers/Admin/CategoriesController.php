<?php

namespace App\Http\Controllers\Admin;

use App\Models\Grade;
use App\Models\Level;
use App\Traits\Image;
use App\Models\Categorie;
use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\CategoriesDeleteRequest;
use App\Http\Requests\Categories\CategoriesInsertRequest;
use App\Http\Requests\Categories\CategoriesDeleteImageRequest;


class CategoriesController extends Controller
{
   use Image;

   // protected $certificate;

   // public function __construct(
   //     CertificateInterface $certificate
   // ) {
   //     $this->certificate = $certificate;
   // }
   public function index()
   {

      $categories = Categorie::paginate(pagination_count());

      $categories->each(function ($categorie) {
         if ($categorie->tag != null) {
            $categorie->grade;
            $categorie->level;
            //              dd(gettype($categorie->tag));
            /*
             * need remove the index from array
             */
            $tag = Grade::whereIn('id', array_values($categorie->tag))->get(['id', 'grade']);
            $categorie->tag = $tag;
         }
         return $categorie;
      });
//       return $categories;

      return view('admin.setup.categories.index', compact('categories'));
   }

   public function create()
   {
      $certificates = Certificate::all();
      $grade = Grade::select()->get();
      $level = Level::select()->get();
      return view('admin.setup.categories.create', compact('certificates', 'grade', 'level'));
   }


   public function store_categories(CategoriesInsertRequest $request)
   {
      try {
         //return $request;
         $attache = $global_image = '';
         $callery = [];
         $status = 1;
         if ($request->has('attache')) {
            $attache = $this->saveImage($request->attache, 'public/files/categories/attache');
         }
         if ($request->has('global_image')) {
            $global_image = $this->saveImage($request->global_image, 'public/files/categories/global_image');
         }
         if ($request->has('callery')) {
            $callery = $this->saveMultiImage($request->callery, 'public/files/categories/callery');
         }
         // return gettype( $this->saveMultiImage($request->callery, 'public/files/categories/' . $request->categorie . '/callery'));
         $categorie = Categorie::create([
            'certificate_id' => $request->certificate,
            'name' => $request->categorie,
            'grade_id' => $request->grade,
            'level_id' => $request->level,
            'grade_id' => $request->grade,
            'description' => $request->desc,
            'details' => $request->details,
            'prerequests' => $request->prerequests,
            'shorte_description' => $request->short_desc,
            'requireKnwoledge' => $request->requireKnwoledge,
            'attache' => $attache,
            'global_image' => $global_image,
            'callery' => $callery,
            'url_vid_imbeded' => $request->url_video_imbed,
            'status' => $status,
            'tag' => $request->tag,
            'target_students' => $request->target_students,
            'duration' => $request->duration,
            'total_hours' => $request->nb_total_hours
         ]);
         if ($categorie) {
            $status = 'success';
            $message = __('site.Post created successfully!');
            $route = route('admin.categories.all');
            //            $route = '#';
         }
         return response()->json(['status' => $status, 'message' => $message, 'route' => $route]);
      } catch (\Throwable $th) {
         //         throw $th;
         $status = 'error';
         $message = __('site.wrong try again');
         return response()->json(['status' => $status, 'message' => $message, 'route' => '#']);
      }
   }

   private function initialize_variable(&$returnedvalue, $request)
   {
      if ($request != '') {
         $returnedvalue = $request;
      } else {
         $returnedvalue = '';
      }
   }


   public function delete_categories(CategoriesDeleteRequest $request)
   {
      try {
         $categorie_deleted = Categorie::find($request->id);
         if ($categorie_deleted->available_cours->count() > 0) {
            $message = __('site.failed to delete beacuse it is used');
            $status = 'error';
            return response()->json(['status' => $status, 'message' => $message]);
         }

         if ($categorie_deleted) {

            $categorie_deleted->delete();
            $attache = $categorie_deleted['attache'];
            $global_image = $categorie_deleted['global_image'];
            $callery = $categorie_deleted['callery'];

            $this->removeImagefromfolder($attache);
            $this->removeImagefromfolder($global_image);
            foreach ($callery as $img) {
               $this->removeImagefromfolder($img);
            }


            $status = 'success';
            $message = __('site.deleted_msg_swal_fire');
         } else {
            $status = 'error';
            $message = __('site.wrong try again');
         }
         return response()->json(['status' => $status, 'message' => $message]);
      } catch (\Throwable $th) {
         throw $th;
      }
   }


   public function edit_categories($categories_id)
   {
      $categorie = Categorie::find($categories_id);
      $certificates = Certificate::get();
      $grade = Grade::get();
      $level = level::get();
      if (!$categorie || !$certificates) {
         toastr()->error(__('site.please add data in the field'));
         return redirect()->route('admin.categories.all');
      }
      return view('admin.setup.categories.edit', compact('categorie', 'certificates', 'grade', 'level'));
   }

   public function delete_image_categories(CategoriesDeleteImageRequest $request)
   {
      try {
         $category = Categorie::find($request->id);
         $old_file = $category['global_image'];
         $delete_img = $category->update(['global_image' => null]);
         $this->removeImagefromfolder($old_file);
         //    return  $category ;

         /**remove global image of   categories  by id */

         if (!$delete_img) {
            $message = __('site.wrong try again');
            $status = 'error';
            $route = "#";
         } else {
            $message = __('site.delete this sponsore success');
            $status = 'success';
            $route = "#";
         }

         return response()->json([
            'message' => $message,
            'status' => $status,
            'route' => $route
         ]);


         //code...
      } catch (\Throwable $th) {
         //throw $th;
         $message = __('site.wrong try again');
         $status = 'error';
         $route = "#";
         return response()->json([
            'message' => $message,
            'status' => $status,
            'route' => $route
         ]);
      }
   }

   public function delete_image_categories_from_callery(CategoriesDeleteImageRequest $request)
   {
      try {
         $delete_img = Categorie::find($request->id);
         $delete_img_selected = $delete_img->update(['callery' => array_diff($delete_img->callery, [$request->img])]);
         $this->removeImagefromfolder($request->img);
         if (!$delete_img_selected) {
            $message = __('site.wrong try again');
            $status = 'error';
            $route = "#";
         } else {
            $message = __('site.delete this sponsore success');
            $status = 'success';
            $route = "#";
         }
         return response()->json([
            'message' => $message,
            'status' => $status,
            'route' => $route
         ]);
      } catch (\Throwable $th) {
         throw $th;
         $message = __('site.wrong try again');
         $status = 'error';
         $route = "#";
         return response()->json([
            'message' => $message,
            'status' => $status,
            'route' => $route
         ]);
      }
   }


   public function save_edit_category(Request $request)
   {
      try {
         // return $request;
         $categorie = Categorie::find($request->id);

         $status = 1;
         $attache =
            //         $callery = $categorie['callery'];
            //         if ($request->has('status')) {
            //            $status = 1;
            //         }

            $request->has('attache') ?
               $attache = $this->saveImage($request->attache, 'public/files/categories/attache') : $attache = $categorie['attache'];


         $request->has('global_image') ?
            $global_image = $this->saveImage($request->global_image, 'public/files/categories/global_image') : $global_image = $categorie['global_image'];;

         if ($request->has('callery')) {
            $temp_callery = $this->saveMultiImage($request->callery, 'public/files/categories/callery');
            if ($categorie->callery != null)
               $callery = array_merge($categorie->callery, $temp_callery);
            else {
               $callery = $temp_callery;
            }
         } else {
            $callery = $categorie['callery'];
         }

         $categorie = $categorie->update([
            'certificate_id' => $request->certificate,
            'name' => $request->categorie,
            'grade_id' => $request->grade,
            'level_id' => $request->level,
            'grade_id' => $request->grade,
            'description' => $request->desc,
            'details' => $request->details,
            'prerequests' => $request->prerequests,
            'shorte_description' => $request->short_desc,
            'requireKnwoledge' => $request->requireKnwoledge,
            'attache' => $attache,
            'global_image' => $global_image,
            'callery' => $callery,
            'url_vid_imbeded' => $request->url_video_imbed,
            'status' => $status,
            'tag' => $request->tag,
            'target_students' => $request->target_students,
            'duration' => $request->duration,
            'total_hours' => $request->nb_total_hours
         ]);
         if ($categorie) {
            $status = 'success';
            $message = __('site.success update categories');
            $route = route('admin.categories.all');
         }
         return response()->json(['status' => $status, 'message' => $message, 'route' => $route]);
      } catch (\Throwable $th) {
         throw $th;
         // $status = 'error';
         // $message = __('site.wrong try again');
         // return response()->json(['status' => $status, 'message' => $message,'route'=>'#']);
      }
   }
}
