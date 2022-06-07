<?php

namespace App\Http\Requests;

use App\Models\StudentsRegistration;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
        /****
         * $this->get_max_amount(decrypt($this->user_id), decrypt($this->cours_id));
         * get the max fees required
         * of this cours
         */
        $max_amount_to_paid =  $this->get_max_amount(decrypt($this->user_id), decrypt($this->cours_id));

        return [
            'amount_to_paid' => 'required|numeric|min:1|max:' . $max_amount_to_paid,
            // 'check_number'=>$this->checkNum()
        ];
    }

    public  function messages()
    {
        return [
            '*.required' => __('site.its_require'),
            'amount_to_paid.numeric' => __('site.must be a number'),
            'amount_to_paid.max' => __('site.amount to paid must be under fees Or the rest'),

            // 'cours_id.min' => __('site.must be a number positive'),
            'amount_to_paid.min' => __('site.must be a number positive'),

        ];
    }

    public function get_max_amount($user_id, $cours_id)
    {
        try {
            $std = StudentsRegistration::where([
                'user_id' => $user_id,
                'cours_id' => $cours_id
            ])->get();
            if ($std->count() > 0) {
                return $std[0]['remaining'];
            } else {
                return 0;
            }
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return 0;
        }
    }


    public function checkNum(){
        if($request->has('check_number'))
        return 'required|min:13|max:14|numeric';
        else return "";
    }
}
