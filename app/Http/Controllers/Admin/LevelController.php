<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LevelRequest;
use App\Models\level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yoeunes\Toastr\Facades\Toastr;

class LevelController extends Controller
{
    public function create()
    {
        $level = level::select()->get();

        return view('admin.setup.level.create', compact('level'));
    }

    public function store(Request $request)
    {

        try {
            // return $request;
            DB::beginTransaction();
            $nb_level = count($request->level);
            $level = [];
            if ($nb_level > 0) {
                for ($i = 0; $i < $nb_level; $i++) {
                    if ($request->level[$i] != '') {
                        $level = new level();
                        $level->name = $request->level[$i];
                        $level->save();
                    }
                }
            }
            // print_r( $grade_to_insert[]);
            DB::commit();

            toastr()->success(__('site.Post created successfully!'));
            toastr()->warning(__('site.only not empty'));
            return redirect()->route('admin.level.add');
        } catch (\Exeption $ex) {
            toastr()->error(__('site.you have error'));
            DB::rollback();
        }
    }

    public function delete(Request $request)
    {

        return $request;

        // try {
        //     $level = level::find($request->id);
        //     if (!$level) {
        //         toastr()->error(__('site.level note defined'));
        //         return redirect()->route('admin.level.add');
        //     } else {
        //         $level->delete();
        //     }
        // } catch (\Exception $th) {
        //     toastr()->error(__('site.you have error'));
        // }
    }
    public function update(LevelRequest $request)
    {
        // return $request;
        try {
             $level = level::find($request->id);
            if (!$level) {
                toastr()->error(__('site.grade note defined'));
                return redirect()->route('admin.level.add');
            } else {
                // return $level;
                $level_updated = $level->update(['name' => $request->level]);
                $notification = [
                    'message' => __('site.level succefuly update'),
                    'status' => 'success',
                ];
                if ($level_updated)
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
                'message' => $th,
                'status' => 'error',

            ];
            // $notification = [
            //     'message' => __('site.you have error'),
            //     'status' => 'error',

            // ];
            return  response()->json($notification);
            //   toastr()->error(__('site.you have error'));
        }
    }
}
