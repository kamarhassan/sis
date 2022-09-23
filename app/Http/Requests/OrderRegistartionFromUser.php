<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Http\FormRequest;

class OrderRegistartionFromUser extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'order_id' => $this->orderid(),
        ];
    }




    private function  orderid()
    {
        $order_type = Crypt::decryptString($this->order_type);
      
        switch ($order_type) {
            case 'registration':
                return 'required|exists:courss,id';
                break;

            default:
                return '';
                break;
        }
    }
}
