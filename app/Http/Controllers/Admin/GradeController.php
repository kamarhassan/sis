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
    public function create()
    {
        $grade = Grade::select()->get();
        return view('admin.setup.grade.create', compact('grade'));
    }

    public function store(Request $request)
    {
        try {
            // return $request;
            DB::beginTransaction();
            $nb_grade = count($request->grade);

            $grade = [];
            for ($i = 0; $i < $nb_grade; $i++) {
                if ($request->grade[$i] != '') {
                    $grade[] = [
                        'grade' => $request->grade[$i],
                        'created_at' =>  Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                }
            }

            // return $grade;
            //  $grade;

            $inserted = Grade::insert($grade);
            DB::commit();
            if ($inserted) {

                toastr()->success(__('site.Post created successfully!'));
                toastr()->warning(__('site.only not empty'));

                return redirect()->route('admin.grades.add');
            } else {

                toastr()->error(__('site.please add data in the field'));
                return redirect()->route('admin.grades.add');
            }

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

        try {
            $grade = Grade::find($request->id);
            if (!$grade) {
                toastr()->error(__('site.grade note defined'));
                return redirect()->route('admin.grades.add');
            } else {

                $grade_updated = $grade->update(['grade' => $request->grade]);
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
