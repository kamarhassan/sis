<?php

namespace App\Http\Controllers\Admin;

use App\Traits\Image;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Slider\SliderInterface;
use App\Http\Requests\Slider\CreateSliderRequest;
use App\Http\Requests\Slider\DeleteSliderRequest;
use App\Http\Requests\Slider\EditSliderRequest;

class SliderController extends Controller
{

    use Image;
    protected $slider;

    public function __construct(SliderInterface $sliderinterface)
    {
        $this->slider = $sliderinterface;
    }
    public function index()
    {
        $sliders = $this->slider->all();
        return view('admin.setup.slider.index', compact('sliders'));
    }
    public function create()
    {
        return view('admin.setup.slider.create');
    }

    public function store_slider(CreateSliderRequest $request)
    {
        try {
            $status = 0;
            if ($request->has('status')) {
                $status = 1;
            }
            if ($request->has('image')) {
                $image = $this->saveImage($request->image, 'public/files/slider');
            }
            $is_updated = Slider::create([
                'image' => $image,
                'status' => $status,
                'link_label' => $request->link_label,
                'link' => $request->link,
                'description' => $request->description,
            ]);
            if (!$is_updated) {
                $message = __('site.wrong try again');
                $status = 'error';
                $route = "#";
            } else {
                $message = __('site.Post edit successfully!');
                $status = 'success';
                $route = "#";
                // $route=route('admin.institue.all');
            }
            return response()->json(['status' => $status, 'message' => $message, 'route' => $route]);
        } catch (\Throwable $th) {
            throw $th;
            $message = __('site.wrong try again');
            $status = 'error';
            return response()->json(['status' => $status, 'message' => $message]);
        }
    }
    public function delete_slider(DeleteSliderRequest  $request)
    {
        try {
            $id = $request->id;
            $slider = Slider::find($id);
            $old_img = $slider['image'];
            $is_delete = $slider->delete();
            if (!$is_delete) {
                $status = 'error';
                $message = __('site.wrong try again');
            } else {
                $this->removeImagefromfolder($old_img);
                $status = 'success';
                $message = __('site.deleted_msg_swal_fire');
            }
            return response()->json(['status' => $status, 'message' => $message]);
        } catch (\Throwable $th) {
            // throw $th;
            $status = 'error';
            $message = __('site.wrong try again');
            return response()->json(['status' => $status, 'message' => $message]);
        }
    }
    public function edit($id)
    {
        $slider = Slider::find($id);

        if (!$slider) {
            toastr()->error(__('site.wrong try again'));
            return redirect()->route('admin.slider.all');
        }
        return view('admin.setup.slider.edit', compact('slider'));
    }
    public function save_edit(EditSliderRequest $request)
    {
        try {
            $slider = Slider::find($request['id']);
            $old_img = $slider['image'];
          
            if ($request->has('image')) {
                $this->removeImagefromfolder($old_img);
                $image = $this->saveImage($request->image, 'public/files/slider');
            }else{
                $image =  $old_img;
            }

            $request->has('status') ? $status = 1 :  $status = 0;


            $is_updated = $slider->update([
                'image' => $image,
                'status' => $status,
                'link_label' => $request->link_label,
                'link' => $request->link,
                'description' => $request->description,
            ]);
            if (!$is_updated) {
                $message = __('site.wrong try again');
                $status = 'error';
                $route = "#";
            } else {
                $message = __('site.Post created successfully!');
                $status = 'success';
                // $route = "#";
                $route=route('admin.slider.all');
            }
            return response()->json(['status' => $status, 'message' => $message, 'route' => $route]);
        } catch (\Throwable $th) {
            throw $th;
            $message = __('site.wrong try again');
            $status = 'error';
            return response()->json(['status' => $status, 'message' => $message]);
        }



        return $request;
    }
}
