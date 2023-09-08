<?php

namespace App\Repository\Slider;

use App\Models\Slider;

class SliderRepository implements SliderInterface
{
    public function all()
    {
        return Slider::get();
    }
    public function AllActive()
    {
        return Slider::where('status',1)->get();
    }
}
