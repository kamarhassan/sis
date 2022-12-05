<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;

class LanguageController extends Controller
{
    public function __construct()
    {
    }
    public   function index()
    {
        $lang = Language::select()->get();

        return view('admin.language.index', compact('lang'));
    }


    public function create()
    {
        //   echo __(__('site.Post created successfully!');
        return view('admin.language.create');
    }

    public function store(LanguageRequest $request)
    {
        try {

            $notification = array(
                'message' => __('site.Post created successfully!'),
                'alert-type' => 'success'
            );

            // Language::create($request->except(['_token']));
            return redirect()->route('admin.language')->with($notification);
        } catch (\Exception $ex) {
            $notification = array(
                'message' => __('site.Post created successfully!'),
                'alert-type' => 'error'
            );
            return redirect()->route('admin.language.create')->with($notification);
        }
    }


    public function edit($language_id)
    {

        $language = Language::select()->find($language_id);
        if (!$language) {
            $notification = array(
                'message' => __('site.language note defined'),
                'alert-type' => 'error'
            );
            toastr()->error(__('site.language note defined'));
            return redirect()->route('admin.language');
        }

        return view('admin.language.edit', compact('language'));
    }

    public function update($language_id, LanguageRequest $request)
    {
        // return $request;
        try {
            $lang = Language::find($language_id);
            if (!$lang) {
                // $notification = array(
                //     'message' => __('site.language note defined'),
                //     'alert-type' => 'error'
                // );
                toastr()->error(__('site.language note defined'));
                return redirect()->route('admin.language.edit', $language_id);
            }
            if (!$request->has('active'))
                $request->request->add(['active' => 0]);

            $lang->update($request->except('_token'));



            $notification = array(
                'message' => __('site.Post edit successfully!'),
                'alert-type' => 'success'
            );
            return redirect()->route('admin.language')->with($notification);
        } catch (\Exception $ex) {
            $notification = array(
                'message' => __('site.wrong try again'),
                'alert-type' => 'error'
            );
            return redirect()->route('admin.language.edit', $language_id)->with($notification);
        }
    }

    public function delete(Request $request)
    {
        // return $request;
        try {
            $lang = Language::find($request->id);
            if (!$lang) {
                $notification = [
                    'message' =>  __('site.language note defined'),
                    'alert-type' => 'error'
                ];
                return redirect()->route('admin.language')->with($notification);
            }

            $lang->delete();


            $notification = [
                'message' => __('site.language delete successfully'),
                'status' => 'success',
                'data' => $request->id
            ];
            return responce()->json($notification);
        } catch (\Throwable $th) {
            $notification = [
                'message' => __('site.you have error'),
                'status' => 'success',
                'data' => $request->id
            ];
            return responce()->json($notification);
            //throw $th;
        }
    }
}
