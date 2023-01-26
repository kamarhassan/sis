<?php

namespace App\Http\Requests\SponsorFee;

use App\Models\CoursFee;
use App\Models\Fee_type;
use Illuminate\Foundation\Http\FormRequest;

class PerStudents extends FormRequest
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
        dd($this->fee_is_exist());
        // dd($this->max_discount());
        return [
            'discount.*' => 'required|numeric|min:0|max:' . $this->max_discount(),
            'percent.*' => 'required|numeric|min:1|max:100',
            'registration_id_.*' => 'required|array',
            'registration_id_.*' => 'numeric|exists:studentsregistrations,id',
            'sponsor_id' => 'required|exists:sponsors,id',

            'fee_selected' => 'required|array' ,
            'fee_selected.*' =>   'min:1', 
        ];
    }

    private function max_discount()
    {
        $sum = 0;
        if($this->fee_selected!=null){

            foreach ($this->fee_selected as $value) {
                $sum += explode('_', $value)[0]; // 0 is fee type value 
            }
        }
        return $sum;
    }
    private function fee_is_exist()
    {
     return    $fee = Fee_type::get();
        if($this->fee_selected!=null){
            // fee_selected.
            foreach ($this->fee_selected as $key =>$value) {
                // if()
                $fee_id  = explode('_',$value)[1] ; // 1 is fee type id
               if( $fee->contains($fee_id) == false) 
               return -1;
            }
           return true;
        }
       
    }

    // foreach ($this->attendance as $key => $value) {
    //     if ($value != null) {
    //         if (!is_numeric($value))
    //             return   ['id' => $key, 'attendance_error' => 'numeric|max:' . $nb_hours];
    //         else if ($value > $nb_hours)
    //             return   ['id' => $key, 'attendance_error' => 'numeric|max:' . $nb_hours];
    //         else if ($value <= 0)
    //             return   ['id' => $key, 'attendance_error' => 'numeric|min:1'];
    //     }
    // }
    // return   ['id' => '', 'attendance_error' => ''];









    public  function messages()
    {
        return [
            'discount.*.required' => __('site.its_require'),
            'discount.*.numeric' => __('site.must be a number'),
            'discount.*.min' => __('site.min 0'),
            'discount.*.max' => __('site.must be a number'),
            'percent.*.required' => __('site.its_require'),
            'percent.*.numeric' => __('site.must be a number'),
            'percent.*.min' => __('site.min 0'),
            'percent.*.max' => __('site.max discount').'  '.$this->max_discount(),

        ];
    }
}
