<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Slider\SliderInterface;

class SliderController extends Controller
{

    protected $slider;

    public function __construct(SliderInterface $sliderinterface)
    {
        $this->slider = $sliderinterface;
    }
    public function AllActive()
    {
        
       try{
           
        $slider =  $this->slider->AllActive();
        !$slider ?  $status = "error" : $status = 'success';
        return response()->json(['status' => $status, 'slider' => $slider]);
       }catch (\Throwable $th) {
   //throw $th;
}
    }
}
