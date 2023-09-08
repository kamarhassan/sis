<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Years;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Cours;
use App\Models\Service;
use App\Models\StudentsRegistration;
use Modules\Cms\Entities\HeaderMenu;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{

   protected $all_std_regsister;
   protected $cours;
   protected $categories;
   protected $services;
   protected $user_services;
   protected $startDate;
   protected $endDate;
   protected $request;
   public function __construct(Request $request)
   {
       
    
      $this->all_std_regsister = DB::table('studentsregistrations')->whereBetween('created_at', [current_school_year()['start'], current_school_year()['end']])
         ->select('id', 'user_id', 'cours_id', 'created_at')->get();

      $this->cours = DB::table('courss')->where('year',current_school_year()['year'])->select('id', 'categorie_id', 'year', 'teacher_id', 'created_at')->get();
      $this->categories = DB::table('categories')->get();
      $this->services = DB::table('services')->select('id', 'service', 'created_at')->get();

      $this->user_services = DB::table('user_services')->whereBetween('created_at', [current_school_year()['start'], current_school_year()['end']])
         ->select('id', 'service_id', 'user_id', 'created_at')->get();
   }

   public function index()
   {
      $count_std_registration_by_month = $this->charts_by_month_for_defined_year($this->all_std_regsister);
      $count_services_paid_by_month = $this->charts_by_month_for_defined_year($this->user_services);

      $students_count = $this->all_std_regsister->groupBy(['user_id'])->count(); //
      $cours_count = $this->cours->count();
      $categries_count = $this->categories->count();
      $services_count = $this->services->count();

      return view('admin.dashboard.dashborad', compact('students_count', 'cours_count', 'categries_count', 'services_count', 'count_std_registration_by_month', 'count_services_paid_by_month'));
   }

   public function change_mode()
   {
      try {

         if (Session::has('mode')) {

            if (Session::get('mode') == "dark-skin") {

               $mode = "light-skin";
               $value = 1;
            } else {
               $mode = "dark-skin";
               $value = 2;
            }
            // Session::flash('mode');
            Session::put('mode', $mode);

            // dd(Session::get('mode'));
         }

         // Session::put('mode',Config::get('modetheme.mode'));
         // $mode_theme = Session::get('mode', $mode);


         //    dd(Session::get('mode'));
         // $modetheme = fopen(config_path() . '\modetheme.php', "w");
         // fwrite($modetheme, "<?php return ['mode' => '$mode' ];");
         // dd($modetheme);
         return response()->json(['mode' => $mode, 'value' => $value]);
      } catch (\Throwable $th) {
         //throw $th;
      }

      // return response()->json(Config::get('modetheme.mode'));
   }


   public function artisan()
   {
      try {


         Artisan::call('migrate');

         $t = Artisan::call('cache:clear');
         $t = Artisan::call('optimize:clear');
         dd(Carbon::now());
      } catch (\Throwable $th) {
         throw $th;
      }
   }

   public function clearcache()
   {
      try {
         //         Artisan::call('storage:link');
         //         $t = Artisan::call('up');

         $t = Artisan::call('cache:clear');
         $t = Artisan::call('optimize:clear');
         dd('done \t' . Carbon::now());
         //         $t = Artisan::call('optimize:clear');
         //         return redirect()->back();
      } catch (\Throwable $th) {
         throw $th;
      }
   }


   public function changeyear(Request $request)
   {
      //      dd($request);
      //      return $request;


      $year = Years::find($request->year);
      if ($year != null) {
         Session::put('year_id', $year->id);
         Session::put('schoolyear', $year['year']);
         Session::put('start schoolyear', $year['start']);
         Session::put('end schoolyear', $year['end']);
         $status = 'success';
         $message = __('site.year has been changed');
      } else {
         $status = 'error';
         $message = __('site.year is not defined ');
      }
      return response()->json([
         'status' => $status,
         'message' => $message,

      ]);
   }


   private function charts_by_month_for_defined_year($collection_data) //current_school_year()
   {
      $data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];


      for ($month = 1; $month <= 12; $month++) {
         $count_by_month = $collection_data->filter(function ($item) use ($month) {
            $created_at = is_string($item->created_at) ? Carbon::parse($item->created_at) : $item->created_at;
            return $created_at->month == $month;
         });
         $data[$month - 1] = $count_by_month->count();
      }

      return $data;
   }
}
