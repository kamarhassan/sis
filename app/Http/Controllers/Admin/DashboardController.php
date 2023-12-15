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
use App\Repository\Cours\CoursInterface;
use Modules\Cms\Entities\HeaderMenu;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use App\Repository\Cours\CoursRepository;

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

   public function __construct(Request $request, CoursInterface $cours)
   {

      $this->all_std_regsister = DB::table('studentsregistrations')->whereBetween('created_at', [current_school_year()['start'], current_school_year()['end']])
         ->select('id', 'user_id', 'cours_id', 'created_at')->get();
      $this->cours = $cours->all_cours();
      $this->categories = DB::table('categories')->get();
      $this->services = DB::table('services')->select('id', 'service', 'created_at')->get();
      $this->user_services = DB::table('user_services')->whereBetween('created_at', [current_school_year()['start'], current_school_year()['end']])
         ->select('id', 'service_id', 'user_id', 'created_at')->get();
   }


   public function index()
   {


      $prapared_data_for_registration_students = $this->prepaire_collection($this->all_std_regsister);
      $prapared_data_for_services = $this->prepaire_collection($this->user_services);

      $count_std_registration_by_month = $this->charts_by_month_for_defined_year($prapared_data_for_registration_students);
      $count_services_paid_by_month = $this->charts_by_month_for_defined_year($prapared_data_for_services);


      //   return $count_students_by_cours_and_cours_name = $this->charts_by_students_registartion_by_cours($prapared_data_for_registration_students);


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


   public function artisan($index)
   {
      try {


         switch ($index) {
            case 'db-seed':
               $command_run_status = Artisan::call('db:seed');
               dd(['command run status' => $command_run_status, 'command' => $index, 'Now' => Carbon::now()]);
               break;
            case 'clc':
               $command_run_status = Artisan::call('cache:clear');
               $command_run_status = Artisan::call('optimize:clear');
               dd(['command run status' => $command_run_status, 'command' => $index, 'Now' => Carbon::now()]);
               break;
            
            case 'migrate':
               $command_run_status = Artisan::call('migarte');
               dd(['command run status' => $command_run_status, 'command' => $index, 'Now' => Carbon::now()]);
               break;
            case 'storage-link':
               $command_run_status = Artisan::call('storage:link', []);
               dd(['command run status' => $command_run_status, 'command' => $index, 'Now' => Carbon::now()]);
               break;

            default:

               break;
         }
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
      $count_std_registration_by_mount = [];
      /**
       * colection data is an object prepared and grouped by month
       */
      foreach ($collection_data as $value) {
         // dd($value->count());
         // var_dump($value);
         // echo $value->count();
         $count_std_registration_by_mount[] = $value->count();
      }
      return $count_std_registration_by_mount;
   }

   private function charts_by_students_registartion_by_cours($collection_data) //current_school_year()
   {

      // return $collection_data;
      $data = $max = $min = $cours = [];

      for ($i = 1; $i <= 12; $i++) {
         $temp = [];
         foreach ($collection_data[$i]->groupBy(['cours_id']) as $all_cours_by_id) {
            //    return  $cours_id = $all_cours_by_id->first()->cours_id;
            //   $count = $all_cours_by_id->count();
            //   return  $this->cours->where('id',$all_cours_by_id->first()->cours_id)->first();
            $temp[] = ['cours_id' => $all_cours_by_id->first()->cours_id, 'data' => $all_cours_by_id->count()];
         }

         // var_dump(1);
         $max_min = $this->max_min_($temp);

         $max[$i] = $max_min['max'];
         $min[$i] = $max_min['min'];

         // $data[$i] = $temp;
         $temp = null;
      }
      // return $data;
      return ['max ' => $max, 'min' => $min];
   }


   private function prepaire_collection($collection_data)
   {
      for ($month = 1; $month <= 12; $month++) {
         $count_by_month = $collection_data->filter(function ($item) use ($month) {
            $created_at = is_string($item->created_at) ? Carbon::parse($item->created_at) : $item->created_at;
            return $created_at->month == $month;
         });
         $data[$month] = $count_by_month->values();
      }

      return $data;
   }


   private function max_min_($dataArray)
   {
      if (count($dataArray) > 0) {


         $maxData = $dataArray[0]['data'];
         $minData = $dataArray[0]['data'];
         $maxDataObj = $dataArray[0];
         $minDataObj = $dataArray[0];

         foreach ($dataArray as $item) {
            $cours = $this->cours->where('id', $item['cours_id'])->first();

            $currentData = $item["data"];
            if ($currentData > $maxData) {
               $maxData = $currentData;
               $maxDataObj = [
                  "name" => $cours['grade'] . ' - ' . $cours['level'],
                  "data" => [$item['data']]
               ]; // Update the object with maximum data
            }
            if ($currentData < $minData) {
               $minData = $currentData;
               $minDataObj = [
                  "name" => $cours['grade'] . ' - ' . $cours['level'],
                  "data" => [$item['data']]
               ]; // Update the object with minimum data
            }
         }
      } else {
         $maxDataObj = null;
         $minDataObj = null;
      }

      return ['max' => $maxDataObj, 'min' => $minDataObj];
   }
}
