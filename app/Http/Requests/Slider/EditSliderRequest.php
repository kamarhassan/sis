<?php

namespace App\Http\Requests\Slider;

use Illuminate\Foundation\Http\FormRequest;

class EditSliderRequest extends FormRequest
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

        return [
            'image' =>  $this->img(),
            'link_label' => $this->link_label(),
            'link' => $this->ImageLink(),
            'description' => $this->description(),
        ];
    }

    private function img()
    {
        $width = slider_width();
        $height = slider_height();
        if ($this->request->has('img'))
            if ($this->img != "")
                return 'required|mimes:png,jpg|dimensions:width=' . $width . ',height=' . $height;
        return '';
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
