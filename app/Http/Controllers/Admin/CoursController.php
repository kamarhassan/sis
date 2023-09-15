<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InsertCoursRequest;
use App\Models\Admin;
use App\Models\Cours;
use App\Models\Currency;
use App\Models\Grade;
use App\Models\Level;
use App\Models\Statusofcour;
use App\Models\StudentsRegistration;
use App\Repository\Admin\AdminInterface;
use App\Repository\Categorie\CategorieInterface;
use App\Repository\Cours\CoursInterface;
use App\Repository\Cours_fee\CoursFeeInterface;
use App\Repository\Fee_Type\Fee_TypeInterface;
use App\Repository\InstitueInformation\InstitueInformationInterface;
use App\Repository\User\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

// use App\Repository\InstitueInformation\InstitueInformationInterface;

class CoursController extends Controller
{

   protected $cours;
   protected $feetype;
   protected $coursfee;
   protected $teacher;
   protected $institueinformations;
   protected $categories;
   protected $userrepository;


   /**
    * CoursController constructor.
    * @param InstitueInformationInterface $institueinformationsinterface
    * @param CoursInterface $cours
    * @param Fee_TypeInterface $feetype
    * @param CoursFeeInterface $coursfee
    * @param AdminInterface $teacher
    * @param CategorieInterface $categorieinterface
    * @param UserInterface $userinterface
    */
   public function __construct(
      InstitueInformationInterface $institueinformationsinterface,
      CoursInterface $cours,
      Fee_TypeInterface $feetype,
      CoursFeeInterface $coursfee,
      AdminInterface $teacher,
      CategorieInterface $categorieinterface,
      UserInterface $userinterface
   ) {
      $this->userrepository = $userinterface;
      $this->cours = $cours;
      $this->feetype = $feetype;
      $this->coursfee = $coursfee;
      $this->teacher = $teacher;
      $this->institueinformations = $institueinformationsinterface;
      $this->categories = $categorieinterface;
   }


   public
   function index()
   {
      $cours = $this->cours->all_cours();
      return view('admin.cours.index', compact('cours'));
   }

   public
   function create()
   {



      $fee_type = $this->feetype->get_all();
      $fee_type_id = $this->feetype->fee_type_id();
      $teacher = Admin::permission('teacher')->get();
      $grade = Grade::select()->get();
      $level = Level::select()->get();
      $status_od_cours = Statusofcour::select()->get();
      $cours_currency = Currency::active()->get();
      $categories = $this->categories->all_categorie(); //;
      // $categories =allcategories['id', 'name']
      $institue_informations = $this->institueinformations->InstitueInformation();
      $std_register_count = 0;
      // $id_fee_type = $fee_type->id;
      return view('admin.cours.create', compact(
         'grade',
         'level',
         'status_od_cours',
         'teacher',
         'fee_type',
         'cours_currency',
         'fee_type_id',
         'categories',
         'institue_informations',
         'std_register_count'
      ));
   }

   public
   function store(InsertCoursRequest $request)
   {

      try {


         if (current_school_year()['year'] != last_school_year()['year']) {
            $status = 'error';
            $message = __('site.not are not in current school year please choose the correct year and try again later');
            $route = route('admin.cours.add');

            return response()->json(['message' => $message, 'status' => $status, 'route' => $route]);
         }
         DB::beginTransaction();
         $teacher_id = Admin::GetIdByName($request->teacher_name);
         // $teacher_id  = $this->teacher->GetTeacherIDbyName($request->teacher_name);

         $id_cours = $this->cours->store_cours($request, $teacher_id);

         if ($request->has('fee')) {
            $cours_fee = $this->coursfee->create($request->fee, $id_cours, $request->cours_currency);
         }

         DB::commit();
         if (!$id_cours) {
            $status = 'error';
            $message = __('site.please add data in the field');
            $route = route('admin.cours.add');
         } else {
            $status = 'success';
            $message = __('site.Post created successfully!');
            $route = route('admin.cours.all');
         }
         return response()->json(['message' => $message, 'status' => $status, 'route' => $route]);
      } catch (Throwable $th) {
         throw $th;
         DB::rollback();
         $status = 'error';
         $message = __('site.you have error');
         $route = route('admin.cours.add');
         return response()->json(['message' => $message, 'status' => $status, 'route' => $route]);
      }
   }


   public
   function edit($id)
   {
      $cours = $this->cours->is_defined($id);
      // return  $cours;
      try {
         if (!$cours) {
            toastr()->error(__('site.cours note defined'));
            return redirect()->route('admin.cours.all');
         } else {
            if ($cours->categories_id != null || $cours->categories_id != 0)
               $cours->categories_id = $this->categories->all_categorie_id_name_by_ids($cours->categories_id);
            if ($cours->institue_information_id != null)
               $cours->institue_information_id = $this->institueinformations->InstitueInformation_by_ids($cours->institue_information_id);

            $coursfee_max = $this->coursfee->is_fee_defined($id)->max('fee_types_id');
            $level_cours = $cours->level;
            $grade_cours = $cours->grade;
            //          cours = Admin::role('teacher')->get(['id', 'name']);
            $teacher = Admin::permission('teacher')->get(['id', 'name']);
            $status_od_cours = Statusofcour::select()->get();
            $grade = Grade::select()->get();
            $level = Level::select()->get();
            $cours_currency = Currency::active()->get();
            $coursfee = $this->coursfee->is_fee_defined($id);
            $fee_type = $this->feetype->get_all();
            $fee_type_id = $this->feetype->fee_type_id();
            $categories = $this->categories->all_categorie();
            $institue_informations = $this->institueinformations->InstitueInformation();

            $std_register_count = $this->cours->count_students_in_cours($cours['id']);
            return view('admin.cours.edit', compact(
               'cours',
               'level',
               'grade',
               'teacher',
               'coursfee',
               'level_cours',
               'grade_cours',
               'status_od_cours',
               'cours_currency',
               'fee_type',
               'coursfee_max',
               'fee_type_id',
               'institue_informations',
               'categories',
               'std_register_count'
            ));
         }
      } catch (Throwable $th) {
         throw $th;
         toastr()->error(__('site.you have error'));
         return redirect()->back();
      }


      // if($this->cours->edit_cours($id))
   }


   public
   function update(InsertCoursRequest $request, $id)
   {

      try {
         // return $request;
         //code...
         // $teacher_id  = $this->teacher->GetTeacherIDbyName($request->teacher_name);
         $teacher_id = Admin::GetIdByName($request->teacher_name);
         $is_updated = $this->cours->update_cours($request, $teacher_id, $id);
         // return $request->has('fee');
         if ($request->has('fee')) {
            $cours_fee = $this->coursfee->update_fee_cours($request->fee, $id, $request->cours_currency);
         } else {
            if ($this->cours->count_students_in_cours($id) == 0) {
               $cours_fee = $this->coursfee->update_fee_cours(0, $id, $request->cours_currency);
            }
            toastr()->error(__('site.you can\'t edit this cours because it have students'));
            // return redirect()->route('admin.cours.all');
         }

         // toastr()->success(__('site.Post edit successfully!'));
         // return redirect()->route('admin.cours.all');

         if (!$is_updated) {
            $status = 'error';
            $message = __('site.you have error');
            $route = route('admin.cours.add');
         } else {
            $status = 'success';
            $message = __('site.Post edit successfully!');
            $route = route('admin.cours.all');
         }

         return response()->json(['message' => $message, 'status' => $status, 'route' => $route]);
      } catch (Throwable $th) {
         throw $th;
         $status = 'error';
         $message = __('site.you have error');
         $route = route('admin.cours.add');
         return response()->json(['message' => $message, 'status' => $status, 'route' => $route]);
      }

      // return $request;
   }

   public function delete(Request $request)
   {

      $cours = $this->cours->is_defined($request->id);
      $count_std = $this->cours->count_students_in_cours($request->id);
      $message = '';
      $status = '';
      $route = "#";
      try {
         DB::beginTransaction();
         if ($cours == false || $count_std > 0) {
            $message = __('site.you can\'t delete this cours it have students or not defined');
            $status = 'error';
            $route = "#";

            return response()->json(['message' => $message, 'status' => $status, 'route' => $route]);
         }
         $is_cours_fee_deleted = $this->coursfee->delete_fee_cours($request->id);
         //    return response()->json($is_cours_fee_deleted);

         if ($is_cours_fee_deleted) {
            $is_cours_deleted = $cours->delete();
            if ($is_cours_deleted) {
               $message = __('site.cours delete successfully');
               $status = 'success';
               $route = "#";
            } else {
               $message = __('site.cours not deleted');
               $status = 'success';
               $route = "#";
            }
         }
         DB::commit();
         return response()->json(['message' => $message, 'status' => $status, 'route' => $route]);
      } catch (Throwable $th) {
         DB::rollBack();
         // throw $th;
         $message = __('site.you have error');
         $status = 'error';
         $route = "#";
         return response()->json(['message' => $message, 'status' => $status, 'route' => $route]);
      }


      // return $request;
      // if()
   }


   public function info($id)
   {
      $cours = Cours::find($id);

      $cours_category = $cours->category;
      $cours_category->level;
      $cours_category->grade;
      $cours->teacher_name;
      $cours->students;

      $cours->students->each(function ($std) {
         $registration_in_cours = StudentsRegistration::where(['cours_id' => $std['pivot']['cours_id'], 'user_id' => $std->id])->first();
         $std->regisrtaion = $registration_in_cours['created_at']->format('d/m/Y');
         $registration_in_cours['sponsorship_id'] > 0 ?
            $std->sponsorship_id = $registration_in_cours['sponsorship_id'] : $std->sponsorship_id = null;
         return $std;
      });

      $cours->cours_currency;
      $cours->fee_with_type;
      $cours->fee;
      $total_cost = $cours->fee_with_type->sum(function ($fee) {
         return $fee['value'];
      });

      return view('admin.cours.info', compact('cours', 'total_cost'));
   }


   /****
    * end of Class
    */
}
