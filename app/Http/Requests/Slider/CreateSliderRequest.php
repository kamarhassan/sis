<?php

namespace App\Http\Requests\Slider;

use App\Rules\ImageSizeRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateSliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $width = slider_width();
        $height = slider_height();
        return [
           'image' => ['required','mimes:png,jpg',new ImageSizeRule($width['min'],$width['max'], $height['max'],$height['min'])/*'dimensions:width=' . $width . ',height=' . $height*/],
            'image' => 'required|mimes:png,jpg',
            'link_label' => $this->link_label(),
            'link' => $this->ImageLink(),
            'description' => $this->description(),
        ];
    }

    private function link_label()
    {
        if ($this->link_label != "")
            return 'max:255';
        return '';
    }
    private function ImageLink()
    {
        if ($this->link != "")
            return 'url';
        return '';
    }
    private function description()
    {
        if ($this->description != "")
            return 'max:255';
        return '';
    }
}
