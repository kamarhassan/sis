<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StudentsRegistration;
use App\Http\Requests\SponsorRequest;
use Carbon\Carbon;

class SponsorController extends Controller
{
    public function index()
    {
        $sponsor =  Sponsor::get();
        return view('admin.setup.sponsor.index', compact('sponsor'));
    }
    public function delete_sponsor(Request $request)
    {
        try {
            //code...

            $count = StudentsRegistration::where('sponsor_id', $request->id)->count();
            $sponsor =     Sponsor::find($request->id);
            if ($sponsor->count() > 0) {
                if ($count > 0) {
                    $message = __('site.you can\'t delete this sponsore it have students');
                    $status = 'error';
                    $route = "#";
                } else {
                    $deleted =  $sponsor->delete();
                    if ($deleted) {
                        $message = __('site.delete this sponsore success');
                        $status = 'success';
                        $route = "#";
                    }
                }
            } else {
                $message = __('site.this sponsore is not defined');
                $status = 'error';
                $route = "#";
            }

            return response()->json([
                'message' => $message,
                'status' => $status,
                'route' => $route
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            $message = __('site.you have error');
            $status = 'error';
            $route = "#";
return response()->json([
            'message' => $message,
            'status' => $status,
            'route' => $route
        ]);
        }
    }


    public function store_sponsor(SponsorRequest $request)
    {

        try {
            if (
                !((count($request->sponsor_default_percent) == count($request->sponsor_limit)) ==
                    (count($request->sponsor_name) == count($request->sponsor_students_limit))) ==
                count($request->sponsor_type)
            ) {
                $message = __('site.you have error');
                $status = 'error';
                $route = "#";
                return response()->json(['message' => $message, 'status' => $status, 'route' => $route]);
            }

            $array_count = count($request->sponsor_default_percent);
            for ($i = 0; $i < $array_count; $i++) {
                $sponsored[] = [
                    'type'            =>   $request->sponsor_type[$i],
                    'name'            => $request->sponsor_name[$i],
                    'budgetLimit'     =>  $request->sponsor_limit[$i],
                    'studentLimit'    =>   $request->sponsor_students_limit[$i],
                    'defaultpercent'  => $request->sponsor_default_percent[$i],
                    'created_at'      => Carbon::now(),
                    'updated_at'      => Carbon::now()
                ];
            }
            $sponsor_inserted = Sponsor::insert($sponsored);

            if ($sponsor_inserted) {
                $message = __('site.Post created successfully!');
                $status = 'success';
                $route = route('admin.sponsor.all');
            } else {
                $message = __('site.Post created unsuccessfully!');
                $status = 'error';
                $route = "#";
            }
        
            return response()->json(['message' => $message, 'status' => $status, 'route' => $route]);
        } catch (\Throwable $th) {
            // throw $th;
            $message = __('site.you have error');
            $status = 'error';
            $route = "#";
            return response()->json(['message' => $message, 'status' => $status, 'route' => $route]);
        }
    }
}
