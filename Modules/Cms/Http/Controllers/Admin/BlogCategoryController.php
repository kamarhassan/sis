<?php

namespace  Modules\Cms\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Modules\Cms\Entities\BlogCategory;
use Modules\CourseSetting\Entities\Category;


class BlogCategoryController extends Controller
{


    public function index()
    {

        try {
            $user = Auth::user();
            $query = BlogCategory::with('user');
            if ($user->role_id == 2) {
                $query->where('user_id', $user->id);
            } else {
                if (isModuleActive('Organization') && Auth::user()->isOrganization()) {
                    $query->whereHas('user', function ($q) {
                        $q->where('organization_id', Auth::id());
                        $q->orWhere('user_id', Auth::id());
                    });
                }
            }

            $categories = $query->latest()->get();
            $max_id = BlogCategory::max('position_order') + 1;
            return view('blog::category', compact('categories', 'max_id'));

        } catch (\Exception $e) {

            GettingError($e->getMessage(), url()->current(), request()->ip(), request()->userAgent());
        }
    }


    public function store(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }

        $code = auth()->user()->language_code;

        $rules = [
            'title.' . $code => 'required|max:255',
        ];

        $this->validate($request, $rules, validationMessage($rules));

        try {
            $blog = new BlogCategory;
            foreach ($request->title as $key => $name) {
                $blog->setTranslation('title', $key, $name);
            }
            $blog->parent_id = (int)$request->parent;
            $blog->position_order = $request->position_order;
            $blog->user_id = Auth::id();
            $blog->save();

            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (\Exception $e) {
            GettingError($e->getMessage(), url()->current(), request()->ip(), request()->userAgent());

        }
    }

    public function edit($id)
    {
        $user = Auth::user();
        $edit = BlogCategory::find($id);
        $query = BlogCategory::with('user');
        if ($user->role_id == 2) {
            $query->where('user_id', $user->id);
        }

        $categories = $query->orderBy('position_order', 'asc')->get();
        $max_id = BlogCategory::max('position_order') + 1;
        return view('blog::category', compact('categories', 'max_id', 'edit'));

    }


    public function update(Request $request)
    {
        if (demoCheck()) {
            return redirect()->back();
        }

        $code = auth()->user()->language_code;

        $rules = [
            'title.' . $code => 'required|max:255',
            'id' => 'required',
        ];

        $this->validate($request, $rules, validationMessage($rules));


        try {


            $blog = BlogCategory::find($request->id);
            foreach ($request->title as $key => $name) {
                $blog->setTranslation('title', $key, $name);
            }
            $blog->parent_id = (int)$request->parent;
            $blog->position_order = $request->position_order;


            $blog->save();

            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();

        } catch (\Exception $e) {
            GettingError($e->getMessage(), url()->current(), request()->ip(), request()->userAgent());

        }
    }


    public function destroy($id)
    {
        if (demoCheck()) {
            return redirect()->back();
        }
        $blog = BlogCategory::findOrFail($id);

        try {
            $blog->delete();

            Toastr::success(trans('common.Operation successful'), trans('common.Success'));
            return redirect()->back();
        } catch (\Exception $e) {
            GettingError($e->getMessage(), url()->current(), request()->ip(), request()->userAgent());

        }
    }
}
