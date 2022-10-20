<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Cours;
use Illuminate\Http\Request;
use App\Models\AttendanceInfo;
use App\Models\AttendanceDetail;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repository\Admin\AdminInterface;
use App\Repository\Cours\CoursInterface;
use App\Repository\Students\StudentsInterface;
use App\Http\Requests\StudentAttendanceRequest;
use App\Repository\Attendance\AttendanceInterface;
use App\Http\Requests\CreateOrUpdateAttendanceRequest;

class StudentsAttendanceController extends Controller
{
    protected $coursrepos;
    protected $adminrepos;
    protected $studentsrepos;
    protected $attendancerepos;
    public function __construct(
        CoursInterface $coursinterface,
        AdminInterface $admininterfcae,
        StudentsInterface $stdinterface,
        AttendanceInterface $attendanceinterface

    ) {
        $this->coursrepos = $coursinterface;
        $this->adminrepos = $admininterfcae;
        $this->studentsrepos = $stdinterface;
        $this->attendancerepos = $attendanceinterface;
    }

    public function index()
    {

        $admin_logged = Admin::find(Auth::id());
        // $this->adminrepos->all_teacher_id();
        if (!$admin_logged->hasRole('super admin'))
            $cours = $this->coursrepos->cours_of_teacher($admin_logged->id);
        else {

            $teacher_id = $this->adminrepos->all_teacher_id();
            $cours = $this->coursrepos->cours_of_teacher_super_admin_loged($teacher_id);
        }
        // return $cours[0]['grade'];
        return view('admin.students-attendance.index', compact('cours'));
    }




    public function  attendance_general_info($cours_id)
    {
        $teacher_id = Admin::find(Auth::id());
        $cours = Cours::find($cours_id);
        if ($cours->teacher['id'] !=  $teacher_id['id']) {
            toastr()->error(__('site.this cours is not for you'));
            return redirect()->route('admin.take.attendance.students');
        }
        // $std =$this->studentsrepos->students_for_cours_defined($cours_id);
        $teacher_id = $teacher_id['id'];
        return view('admin.students-attendance.students-for-cours', compact('cours', 'teacher_id'));
    }
    public function  take_students_for_cours(StudentAttendanceRequest $request)
    {

        $attendance_info =   $this->attendancerepos->get_attendance_info(
            $request->attendance_date,
            $request->cours_id,
            $request->techear_id,
        );

        if ($attendance_info == false) {
            // attendace not taken  should  take std only without attendance info 
            $std = $this->studentsrepos->students_for_cours_defined($request->cours_id);
            $dataset =  $this->attendancerepos->dataset_take_new_attendance($std);
            $notification = [
                'message' => __('site.'),
                'status' => 'success',
            ];
            $mode = "insert_or_update";
        } else {
            // attendace   taken   take std   with  attendance info 
            //  old attendace info
            //  old  attendance details 
            // determined by attendance info if status is open to take attendance
            $notification = [
                'message' => __('site.'),
                'status' => 'success',
            ];
            $attendance_info[0]['status'] == "1" ? $mode = "insert_or_update" : $mode = "view";
            $std = $this->attendancerepos->old_attendance_details($attendance_info[0]['id']);
            $dataset = $this->attendancerepos->dataset_new_or_update_attendance($std);
        }
        return response()->json([
            'notification' => $notification,
            'dataset' => $dataset,
            'attendance_info' => $attendance_info,   //  old attendace info
            'mode' => $mode,
        ]);
    }

    public function create_or_update_attendance(CreateOrUpdateAttendanceRequest $request)
    {
        //  return $request;
        try {
            DB::beginTransaction();
            $attendance_info = AttendanceInfo::updateOrCreate([
                'cours_id'    => $request->cours_id,
                'teacher_id'    => $request->techear_id,
                // 'total_hours'    => $request->total_hours_details,
                'date'    => $request->attendance_date_new_or_update,
            ], [
                'cours_id'    => $request->cours_id,
                'teacher_id'    => $request->techear_id,
                'total_hours'    => $request->total_hours_details,
                'date'    => $request->attendance_date_new_or_update,
                // 'status' => 1,
            ]);

            foreach ($request->attendance as $key => $std_atten) {

                $attendance_details = AttendanceDetail::updateOrCreate([
                    'attendance_info_id'    => $attendance_info->id,
                    'user_id'    => $key,
                    // 'total_hours'    => $request->total_hours_details,
                ], [
                    'attendance_info_id' => $attendance_info->id,
                    'user_id'    => $key,
                    'total_hours'    => $std_atten,
                ]);
                if ($attendance_details)
                    $status = 1;
                else   $status = 0;
            }
            DB::commit();
            if ($attendance_info && $status == 1) {

                $message = __('site.successefully take attendance');
                $status = 'success';
            }
            return response()->json([
                'message' => $message,
                'status' => $status,

            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }


    public function report_attendance($cours_id)
    {

        $array_of_selection = ['users.name as name', 'users.id as id', 
        'attendance_details.total_hours as total_hours','attendance_infos.date'
    ];

        $t=  DB::table('attendance_infos')
            ->where('attendance_infos.cours_id', $cours_id)
            ->JOIN('attendance_details', 'attendance_infos.id', '=', 'attendance_details.attendance_info_id')
            ->JOIN('users', 'users.id', '=', 'attendance_details.user_id')
            ->select($array_of_selection)
            ->get();


        // $t =
            AttendanceInfo::with('attendance_details')
            ->where('cours_id', $cours_id)
            ->get();
        // return $t;
        return $t->groupBy('date');
        // return $cours_id;
    }
}
