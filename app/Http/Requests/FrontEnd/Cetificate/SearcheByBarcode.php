<?php

namespace App\Http\Requests\FronEnd\Cetificate;

use Illuminate\Foundation\Http\FormRequest;

class SearcheByBarcode extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
          'barcode'=>'required|exists:students_certificate_barcodes,code_number',
         //  'template'=>'required|exists:certeficate_templates,id',

        ];
    }


    public  function messages()
    {
        return [
            '*.required' => __('site.its_require'),
            'barcode.exists' => __('site.this barcode it\'s not defined'),
           

        ];
    }


}
