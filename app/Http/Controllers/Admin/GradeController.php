<?php


namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GradesRequest;
use App\Models\Grade;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class GradeController extends Controller
{
    public function __construct()
    {
    }
    public function create()
    {
        $grade = Grade::select()->get();
        return view('admin.setup.grade.create', compact('grade'));
    }

    public function store(GradesRequest $request)
    {
        try {
            //   return $request;
            DB::beginTransaction();
            $nb_grade = count($request->grades);

            $grade = [];
            for ($i = 0; $i < $nb_grade; $i++) {
                if ($request->grades[$i] != '') {
                    $grade[] = [
                        'grade' => $request->grades[$i],
                        'total_hours' => $request->total_hours[$i],
                        'duration' => $request->period_by_mounth[$i],
                        'created_at' =>  Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                }
            }

            $inserted = Grade::insert($grade);
            DB::commit();
            if ($inserted) {


                $message = __('site.Post created successfully!');
                $status = 'success';
            } else {

                $message = __('site.you have error');
                $status = 'error';
            }
            return  response()->json([
                'message' => $message,
                'status' => $status
            ]);
            // print_r( $grade_to_insert[]);

        } catch (\Exeption $ex) {
            toastr()->error(__('site.you have error'));
            // return $ex;
            DB::rollback();
        }
    }

    public function delete(Request $request)
    {

        try {
            $grade = Grade::find($request->id);
            if (!$grade) {
                toastr()->error(__('site.grade note defined'));
                return redirect()->route('admin.grades.add');
            } else {
                $deleted =    $grade->delete();
                if (!$deleted) {
                    $notification = [
                        'message' => __('site.payment faild '),
                        'status' => 'error',

                    ];
                } else {
                    $notification = [
                        'message' => __('site.payment has delete success'),
                        'status' => 'success',
                    ];
                }
                return  response()->json($notification);
            }
        } catch (\Exception $th) {
            toastr()->error(__('site.you have error'));
        }
    }




    public function update(GradesRequest $request)
    {
        return $request;

        try {
            $grade = Grade::find($request->id);
            if (!$grade) {
                toastr()->error(__('site.grade note defined'));
                return redirect()->route('admin.grades.add');
            } else {
                // 'grade' => $request->grades[$i],
                // ' $request->total_hours[$i],
                // $request->period_by_mounth[$i],
 $grade_updated = $grade->update([
                    'grade' => $request->grade,
                    'total_hours' =>    $request->total_hours,
                    'duration' =>       $request->period_by_mounth,
                ]);
                $notification = [
                    'message' => __('site.grade succefuly update'),
                    'status' => 'success',

                ];
                if ($grade_updated)
                    return  response()->json($notification);
                else {
                    $notification = [
                        'message' => __('site.grade faild to update'),
                        'status' => 'error',

                    ];
                    return  response()->json($notification);
                }
            }
        } catch (\Exception $th) {

            $notification = [
                'message' => __('site.you have error'),
                'status' => 'error',

            ];
            return  response()->json($notification);
            //   toastr()->error(__('site.you have error'));
        }
    }
}
