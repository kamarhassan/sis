<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Cours;
use App\Models\AttendanceInfo;
use App\Traits\DateRangeTraits;
use App\Models\AttendanceDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Repository\Admin\AdminInterface;
use App\Repository\Cours\CoursInterface;
use App\Repository\Students\StudentsInterface;
use App\Http\Requests\StudentAttendanceRequest;
use App\Repository\Attendance\AttendanceInterface;
use App\Http\Requests\CreateOrUpdateAttendanceRequest;
use Carbon\Carbon;

class StudentsAttendanceController extends Controller
{
    use DateRangeTraits;
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
        if (!$admin_logged->hasRole('super admin')) {
            $cours = $this->coursrepos->cours_of_teacher($admin_logged->id);
            $is_teacher = true;
        }
        //   $route=route('admin.attendance.general.info');
        else {
            // $route=route('admin.enable.disable.take.attendance');
            $is_teacher = false;

            $teacher_id = $this->adminrepos->all_teacher_id();
            $cours = $this->coursrepos->cours_of_teacher_super_admin_loged($teacher_id);
        }
        // return $cours[0]['grade'];
        return view('admin.students-attendance.index', compact('cours', 'is_teacher'));
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
            $attendance_info[0]['status'] == "1" ? $mode = "insert_or_update" : $mode = "view";

            $std = $this->attendancerepos->old_attendance_details($attendance_info[0]['id']);
            //   return response()->json( $std);
            $dataset = $this->attendancerepos->dataset_new_or_update_attendance($std);


            $notification = [
                'message' => __('site.'),
                'status' => 'success',
            ];
        }

        if ($mode == "view") {
            $btn_submit_attendance = '<div id="btn_submit"></div>';
        } else {

            $route = route('admin.create.or.update.attendance');
            $btn_submit_attendance = ' <div id="btn_submit"><a  id="submit_btn" onclick="submit(\'' . $route . '\',\'update_or_new_attendance\')"';
            $btn_submit_attendance .=  'class="btn text-success fa fa-pencil hover  hover-primary">';
            $btn_submit_attendance .=  ' <span>' . __('site.save') . '</span></a></div>';
        }

        return response()->json([
            'notification' => $notification,
            'dataset' => $dataset,
            'attendance_info' => $attendance_info,   //  old attendace info
            'mode' => $mode,
            'bnt_submit_attendance' => $btn_submit_attendance,
        ]);
    }

    public function create_or_update_attendance(CreateOrUpdateAttendanceRequest $request)
    {
        try {
            DB::beginTransaction();
            $attendance_info = AttendanceInfo::where([
                'cours_id'    => $request->cours_id,
                'teacher_id'    => $request->techear_id,
                'date'    => $request->attendance_date_new_or_update,
            ])->first();

            if ($attendance_info && $attendance_info['status'] == 0) {
                return response()->json([
                    'message' => __('site.you can\'t take attendance for this days'),
                    'status' => 'error',
                ]);
            } else {
                $attendance_info = AttendanceInfo::updateOrCreate([
                    'cours_id'    => $request->cours_id,
                    'teacher_id'    => $request->techear_id,
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
            }
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    public function report_attendance($cours_id)
    {

        try {
            $array_of_selection = [
                'users.name as name', 'users.id as id',
                'attendance_details.total_hours as total_hours', 'attendance_infos.date'
            ];
            $goupby = ['name', 'date'];

            $data_for_attendance_report = $this->attendancerepos->data_for_attendance_report($cours_id, $array_of_selection, $goupby);

            if ($data_for_attendance_report->count() == 0) {
                $dataset = null;
                $header_column = null;
                $header_name = null;
                toastr()->error(__('site.attendance for this cours not defined'));
                // return view('admin.students-attendance.report-attendance', compact('dataset', 'header_column', 'header_name'));
                // return redirect()->route('admin.take.attendance.students');
            } else {
                $dataset =  $this->attendancerepos->dataset_attendance($data_for_attendance_report);

                $header =  $this->attendancerepos->header_column($cours_id);
                $header_column = $header['data'];
                $header_name = $header['header_name'];
            }
            return view('admin.students-attendance.report-attendance', compact('dataset', 'header_column', 'header_name'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function enable_disable_reset_take_attendance($cours_id)
    {
        try {
            // DB::beginTransaction();
            $cours = Cours::find($cours_id);
            if (!$cours) {
                toastr()->error(__('site.this cours is not defined'));
                return redirect()->route('admin.take.attendance.students');
            }
            $dates = $this->get_days_between_two_date($cours->act_StartDa, $cours->act_EndDa);

            $attendance_info_between_dates = AttendanceInfo::where('cours_id', $cours_id)->whereIN('date', $dates['dates'])->get();
            $total_attendance_hours =   $attendance_info_between_dates->sum('total_hours'); // = AttendanceInfo::where('cours_id', $cours_id)->whereIN('date', $dates['dates'])->get();

            $data = [];

            if ($attendance_info_between_dates->count() == 0) {
                //    return 0;
                foreach ($dates['days'] as $key => $date) {
                    $data[] = [
                        'date' => $key,
                        'day' => __('site.' . $date),
                        'attendance_hours' => null,
                        'cours_id' => $cours_id,
                        'status' => 1,
                    ];
                }
            } else {
                foreach ($dates['days'] as $key => $date) {
                    if ($attendance_info_between_dates->contains('date', $key)) {
                        $attendance = $attendance_info_between_dates->firstWhere('date', $key);
                        $data[] = [
                            'date' => $key,
                            'day' => __('site.' . $date),
                            'attendance_hours' => $attendance->total_hours,
                            'cours_id' => $cours_id,
                            'status' => $attendance->status,
                        ];
                    } else {
                        $data[] = [
                            'date' => $key,
                            'day' => __('site.' . $date),
                            'attendance_hours' => null,
                            'cours_id' => $cours_id,
                            'status' => 1,
                        ];
                    }
                }
            }

            //  $this->attendancerepos->cours_status_attendance($cours_id);

            return view('admin.students-attendance.edit-status-attendance', compact('data', 'total_attendance_hours', 'cours_id'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function reset_old_attendance($cours_id, $attendance_date)
    {
        try {
            DB::beginTransaction();
            $attendance_info = AttendanceInfo::where(['cours_id' => $cours_id, 'date' => $attendance_date])->get();
            if ($attendance_info->count() == 0) {
                $message = __('site.fail reset attendance for this date. it is not attendance');
                $status = 'error';
            } else {
                $is_reset = $this->attendancerepos->delete_attendance_details($attendance_info[0]->id);

                if ($is_reset) {
                    $message = __('site.successefully reset attendance for this date');
                    $status = 'success';
                } else {
                    $message = __('site.fail reset attendance for this date');
                    $status = 'error';
                    $cours_id = null;
                }
            }
            DB::commit();
            return response()->json([
                'message' => $message,
                'status' => $status,
                'date' => $attendance_date
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }


    public function  edit_status_attendance($cours_id, $attendance_date)
    {
        try {
            DB::beginTransaction();
            $attendance_info = AttendanceInfo::where(['cours_id' => $cours_id, 'date' => $attendance_date])->first();
            if (!$attendance_info) {
                $teacher_id = $this->coursrepos->is_defined($cours_id)['teacher_id'];

                AttendanceInfo::create([
                    'cours_id' => $cours_id,
                    'teacher_id' => $teacher_id,
                    'total_hours' => 0,
                    'date' => $attendance_date,
                    'status' => '0',
                ]);
                $message = __('site.successefully edit status of attendance for this date');
                $status = 'success';
                $attendance_info_edit_status = 0;
            } else {


                if ($attendance_info['status'] == 1)
                    $attendance_info_edit_status = '0';
                else
                    $attendance_info_edit_status = '1';

                $count_attendance_detail_of_attendance_date =  $this->attendancerepos->attendance_info_has_attendance_details($cours_id, $attendance_date)->count();

                /**
                 * remove attendance info if enabled and don't have attendance detail
                 *  check if has attendance detail for  attendace info date
                 */
                if ($count_attendance_detail_of_attendance_date > 0)
                    $attendance_info_updatedte = $attendance_info->update(['status' => $attendance_info_edit_status]);
                else {
                    if ($attendance_info_edit_status = 1)
                        $attendance_info_updatedte = $attendance_info->delete();
                    else
                        $attendance_info_updatedte = $attendance_info->update(['status' => $attendance_info_edit_status]);
                }


                if ($attendance_info_updatedte) {
                    $message = __('site.successefully edit status of attendance for this date');
                    $status = 'success';
                } else {
                    $message = __('site.fail edit status of attendance for this date');
                    $status = 'error';
                }
            }
            DB::commit();
            return response()->json([
                'message' => $message,
                'status' => $status,
                'attendance_status' => $attendance_info_edit_status
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function enable_all($cours_id)
    {
        DB::beginTransaction();
        try {
            $teacher_id = $cours['teacher_id'];
            $dates = $this->get_days_between_two_date($cours->act_StartDa, $cours->act_EndDa);
            $attendance_info_between_dates = AttendanceInfo::where('cours_id', $cours_id)->whereIN('date', $dates['dates'])->get();

            //  return  $attendance_enabled =  $attendance_info_between_dates->where('date', $dates['dates'][2]);//->delete();
            $data = [];
            if ($attendance_info_between_dates->count() == 0) {
            } else {
                foreach ($dates['days'] as $key => $date) {
                    $attendance_by_date = $attendance_info_between_dates->where('date', $key)->first();
                    $count_attendance_detail_of_attendance_date =  $this->attendancerepos->attendance_info_has_attendance_details($cours_id, $key)->count();
                    if ($count_attendance_detail_of_attendance_date == 0)
                        $attendance_enabled =  $attendance_by_date->delete();
                    else $attendance_enabled =  $attendance_by_date->update(['status' => '1']);
                }
            }
            if ($attendance_enabled) {
                $message = __('site.successefully edit status of attendance for this date');
                $status = 'success';
                $route = route('admin.enable.disable.take.attendance', $cours_id);
            } else {
                $message = __('site.fail edit status of attendance for this date');
                $status = 'error';
                $route = '#';
            }
            DB::commit();
            return response()->json(['message' => $message, 'status' => $status, 'route' => $route]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function disable_all($cours_id)
    {

        try {
            DB::beginTransaction();
            $cours = $this->coursrepos->is_defined($cours_id);
            $teacher_id = $cours['teacher_id'];
            $dates = $this->get_days_between_two_date($cours->act_StartDa, $cours->act_EndDa);
            $attendance_info_between_dates = AttendanceInfo::where('cours_id', $cours_id)->whereIN('date', $dates['dates'])->get();

            $data = [];
            if ($attendance_info_between_dates->count() == 0) {
                foreach ($dates['dates'] as $key => $date) {
                    $data[] = [
                        'cours_id' => $cours_id, 'teacher_id' => $teacher_id, 'date' => $date,
                        'status' => '0', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
                    ];
                }
                $attendance_disabled =   AttendanceInfo::insert($data);
            } else {
                foreach ($dates['days'] as $key => $date) {
                    $attendance = $attendance_info_between_dates->firstWhere('date', $key);
                    $t[] = $attendance;
                    if (!$attendance)
                        AttendanceInfo::create([
                            'cours_id' => $cours_id, 'teacher_id' => $teacher_id, 'date' => $key, 'status' => '0'
                        ]);
                    else {
                        $attendance_disabled = $attendance->update(['status' => 0]);
                    }
                }
            }

            if ($attendance_disabled) {
                $message = __('site.successefully edit status of attendance for this date');
                $status = 'success';
                $route = route('admin.enable.disable.take.attendance', $cours_id);
            } else {
                $message = __('site.fail edit status of attendance for this date');
                $status = 'error';
                $route = '#';
            }
            DB::commit();
            return response()->json([
                'message' => $message,
                'status' => $status,
                'route' => $route
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function reset_all($cours_id)
    {
        try {
            DB::beginTransaction();
            $cours = $this->coursrepos->is_defined($cours_id);
            $teacher_id = $cours['teacher_id'];
            $dates = $this->get_days_between_two_date($cours->act_StartDa, $cours->act_EndDa);
            $attendance_info_between_dates = AttendanceInfo::where('cours_id', $cours_id)->whereIN('date', $dates['dates'])->get();

            if ($attendance_info_between_dates->count() == 0) {
                $message = __('site.successefully edit status of attendance for this date');
                $status = 'success';
                $route = route('admin.enable.disable.take.attendance', $cours_id);
            } else {

                foreach ($attendance_info_between_dates as $key => $value) {
                    $is_reset_all = $this->attendancerepos->delete_attendance_details($value->id);
                }

                if ($is_reset_all) {
                    $message = __('site.successefully edit status of attendance for this date');
                    $status = 'success';
                    $route = route('admin.enable.disable.take.attendance', $cours_id);
                } else {
                    $message = __('site.fail edit status of attendance for this date');
                    $status = 'error';
                    $route = '#';
                }
            }


            DB::commit();
            return response()->json([
                'message' => $message,
                'status' => $status,
                'route' => $route
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
