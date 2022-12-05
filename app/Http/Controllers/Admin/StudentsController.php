<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Cours;
use App\Traits\Image;
use Faker\Core\Number;
use App\Models\Sponsor;
use App\Models\CoursFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\StudentsRegistration;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StdNews\FillNewStudent;
use Illuminate\Support\Facades\Storage;
use App\Repository\Cours\CoursInterface;
use App\Exports\StdNews\FillStudentError;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\UserRegistrationRequest;
use App\Repository\Students\StudentsInterface;
use App\Repository\Cours_fee\CoursFeeInterface;
use App\Http\Requests\ImportStudentsFromExcelRequest;

class StudentsController extends Controller
{

    use Image;

    protected $cours;
    protected $cours_fee_repo;
    protected $students;

    /**
     * CoursController constructor.
     * @param $cours
     */
    public function __construct(
        CoursInterface $cours,
        CoursFeeInterface $cours_fee_interface,
        StudentsInterface $students

    ) {
        $this->cours = $cours;
        $this->cours_fee_repo = $cours_fee_interface;
        $this->students = $students;
    }



    public function students()
    {
        $std =  User::wherehas('students_only')->paginate(pagination_count());
        // return $std;
        return view('admin.students.index', compact('std'));
    }

    /**
     * get all students and sort by the registartion date
     * and groub by the user
     */
    public function get_std_to_payment()
    {
        try {
            $std_registartion =  StudentsRegistration::where('remaining', '>', 0)
                ->orderBy('created_at', 'DESC')
                ->with('student:id,name', 'cours')
                ->get();
            return view('admin.payment.index', compact('std_registartion'));
            // return $std_registartion;
        } catch (\Throwable $th) {
            throw $th;
            // return $th;
        }
    }




    /***
     * get all cours or one students fater click on paymeent button
     * and showing into modal
     */
    public function get_cours_std($id)
    {
        try {
            $std = StudentsRegistration::where('user_id', $id)->with('cours')->get();
            $redirect_route = route('admin.payment.user_paid_for_cours', [$std[0]['cours_id'], $std[0]['user_id']]);
            return response()->json([$std, $redirect_route]);
        } catch (\Throwable $th) {
            throw $th;
        }

        // return response()->json(Config::get('modetheme.mode'));
    }


    public function add_students()
    {
        $cours = Cours::where('status', '1')->orWhere('status', '2')
            ->with('grade', 'level', 'teacher_name')->get();
        $sponsore = Sponsor::all();
        return view('admin.students.students-profile.create', compact('cours', 'sponsore'));
    }
    public function   export_file_to_import()
    {
        try {
            $file = 'public\File_to_export\Fillstdnew.xlsx';
            // return Response::download($file, 'filename.pdf');
            // return response()->download(public_path('File_to_export/Fillstdnew.xlsx'));
            return Excel::download(new FillNewStudent(), 'FillStdNew.xlsx');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function save_by_form(UserRegistrationRequest $request)
    {
        try {
            DB::beginTransaction();
            if ($request->has('photo'))
                $image = $this->saveImage($request->photo, 'public/images/admin');
            else $image = "";

            $user = User::create([
                'name' => $request['firstname'] . ' ' . $request['midname'] . ' ' . $request['lastname'],
                'firstname' => $request['firstname'],
                'midname' => $request['midname'],
                'lastname' => $request['lastname'],
                'phonenumber' => $request['phonenumber'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'birthday' => $request['birthday'],
                'birthday_place' => $request['born_place'],
                'photo' => $image,
                'email_verified_at' => Carbon::now(),
            ]);

            DB::commit();
            if ($user) {
                $message = __('site.import studens to register success');
                $status = 'success';
                $route = route('admin.students.add');
            } else {
                $message = __('site.import studens to register success fail');
                $status = 'error';
                $route = "#";
            }
            return response()->json([
                'message' => $message,
                'status' => $status,
                'route' => $route
            ]);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();
        }
    }
    public function import_std_excel(ImportStudentsFromExcelRequest $request)
    {
        try {

  DB::beginTransaction();
            $cours_id = $request->cours_id;
            $cours_info = $this->cours->is_defined($cours_id);

            $rows = Excel::toCollection(collect([]), $request->file('std_import'));
            // return $rows[0]->slice(2);
            //  $rows;
            $header_user_data = $rows[0][0];

            /**prepare students to import split the students have nullable value  of any fields
             * the array named $user_data_error  it have the nullable value
             * $user_data it all flieds it not null but it not validate
             */

            $prepare_students_to_import =   $this->students->prepare_students_to_import($rows[0]->slice(2));

            $all_students = $prepare_students_to_import['all_students'];

            /**
             * 
             * @return mixed
             * this methode validate data and split users have any error and not have any erros
             * and return array users data error and another one users data valide 
             */
            $data_after_validation =   $this->students->vaidate_students_to_import($all_students);
            $user_data =  $data_after_validation['user_data_valide'];
            $user_data_error =  $data_after_validation['user_data_not_valide'];


            $cours_fee = $this->cours_fee_repo->cours_fee_with_type($cours_info);
            $total_cours_fee = $cours_fee->sum('value');
            //    $feerequired = $this->cours_fee_repo->get_fee_required_cours($request->feerequired);
              $feerequired = CoursFee::where('cours_id', $cours_id)->get('id')->toArray(); //;->collapse();
          
          if(  count($cours_fee) ==0){
            $message = __('site.fee of this cours note defined');
            $status = 'error';
            $route = "#";
            return response()->json([
                'message' => $message,
                'status' => $status,
                'route' => $route,
                'user_erro_file_name' => '',
                'user_data_error' =>'',
                'header_user_data' => ''
            ]);
          }
              $fee_required = array_to_string(array_column($feerequired, 'id'), ";");
          /**
           * 
           * return error if fee of cours not exist make it  because in db the result is 0
           * 
           */
          
          
            //    array_to_string(array_column($feerequired, 'id'), ",");
            $std_register = [];


            foreach ($user_data as $key => $value) {
                $user_id = User::firstOrCreate(
                    [
                        'email'             => $value['email'],
                        'lastname'          => $value['lastname'],
                        'midname'           => $value['midname'],
                        'firstname'         => $value['firstname']
                    ],
                    [
                        'segel'             => $value['segel'],
                        'segel_place'       => $value['segel_place'], //badel segel place id
                        'birthday_place'    => $value['birthday_place'], //badel segel place id
                        'birthday'          => $value['birthday'],
                        'phonenumber'       => $value['phonenumber'],
                        'email'             => $value['email'],
                        'lastname'          => $value['lastname'],
                        'midname'           => $value['midname'],
                        'firstname'         => $value['firstname'],
                        'name'              => $value['name'],
                        'password'          => Hash::make('1234'),
                        'email_verified_at' => Carbon::now()
                    ]
                );
                $std_register[] = [
                    'user_id' => $user_id->id,
                    'cours_id' => $request->cours_id,
                    'notes' => $request->fee_note,
                    'sponsor_id' => $request->sponsore_id,
                    'feesRequired' => $fee_required,
                    'cours_fee_total' => $total_cours_fee,
                    'remaining' => $total_cours_fee,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }

            $std_registartion_import =   StudentsRegistration::insert($std_register);
            DB::commit();
            if ($std_registartion_import) {
                count($user_data_error) != 0 ? $status = 'success_have_error' : $status = 'success';
                $message = __('site.import studens to register success');
                $route = "#";
            } else {

                $message = __('site.import studens to register success fail');
                $status = 'error';
                $route = "#";
            }

            $file_name='';
            // $user_erro_path = '';
            if (count($user_data_error) > 0) {
                $file_name = 'user_error_' . Carbon::now()->format('m-d-y') . '_cours_nb_' . $cours_id . '.xlsx';
                $user_error =  $this->students->traitement_user_error_to_export($user_data_error);
                Excel::store(new FillStudentError($user_error),  $file_name);
                // $user_erro_path=URL::asset($execl_error);
                // $user_erro_path = storage_path($file_name);
              
            }

            return response()->json([
                'message' => $message,
                'status' => $status,
                'route' => $route,
                'user_erro_file_name' => $file_name,
                'user_data_error' => $user_data_error,
                'header_user_data' => $header_user_data
            ]);
        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();
        }
    }

   


    public function export_file_have_error(Request $request){
   
        try {
     
          return Storage::download($request->error_std_file_name);
       
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
