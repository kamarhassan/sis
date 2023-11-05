<?php

namespace App\Http\Requests\Services;

use App\Models\Currency;
use App\Models\Service;
use App\Models\UserService;
use Illuminate\Foundation\Http\FormRequest;

class ClientPaymentRequest extends FormRequest
{

   private $quantity_limit = null;

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
//      dd($this->quantity_validate());
      $max_amount_to_paid = $this->get_max_amount(decrypt($this->client_services_id));
      // $t = ['user-id'=>decrypt($this->user_id),'service-id'=>decrypt($this->service_id)];
      //             dd($t);
      return [
         'primary_fee' => 'required|numeric',
         'amount_to_paid' => $this->amount_to_paid($max_amount_to_paid),
         'quantity' => $this->quantity_validate(),
         'check_number' => $this->checkNum(),
         'other_amount_to_paid' => $this->other_amount($max_amount_to_paid),
         'service_currency_id' => 'required|exists:currencies,id',
         'rate' => $this->rate(),
         'bank' => $this->bank(),
      ];
   }

   public function messages()
   {
      return [
         'quantity.max' => __('site.you have reached the limit') .   $this->quantity_limit ,
         '*.required' => __('site.its_require'),
         '*.numeric' => __('site.must be a number'),
         '*.min' => __('site.must be a number positive'),
         'amount_to_paid.max' => __('site.amount to paid must be under fees Or the rest')
            . "  " . $this->service_currency_abbr . "  " . $this->get_max_amount(decrypt($this->client_services_id)),

         'other_amount_to_paid.max' => __('site.amount to paid must be under fees Or the rest')
            . "  " . $this->service_currency_abbr . "  " . $this->get_max_amount(decrypt($this->client_services_id)),

         'chek_number.digits' => __('site.must be a only 14 number'),
      ];
   }


   private function get_max_amount($service_client_id)
   {
      // dd($service_client_id);
      try {
         $client_services = UserService::where('id', $service_client_id)->get();
         if ($this->quantity == null)
            $quantity = 1;
         else  $quantity = $this->quantity;
         // dd($client_services);
         if ($client_services->count() > 0) {
            return $quantity * $this->primary_fee;
            // return $client_services->remaining;
         } else {
            return 0;
         }
         //code...
      } catch (\Throwable $th) {
         throw $th;
         return -1;
      }
   }

   private function amount_to_paid($max_amount_to_paid)
   {
      if (!$this->request->has('payment_methode'))
         return 'required|numeric|min:1|max:' . $max_amount_to_paid;
      else return "";
   }

   //
   public function checkNum()
   {
      if ($this->pay_type == 'pay_check_')
         return 'required|digits:14|numeric';
      else return "";
   }
   // public function userId()

   // public function userId()
   // {
   //     return  'required|exists:users,' . decrypt($this->user_id);
   // }
   public function bank()
   {
      if ($this->pay_type == 'pay_check_')
         return 'required';
      else return "";
   }

   public function other_amount($max_amount_to_paid)
   {
      try {
         if ($this->request->has('payment_methode')) {
            $service_curency_abbr = Currency::find($this->other_payment_currency);
            if (
               strcmp($service_curency_abbr['abbr'], "L.L") == 0
               && (strcmp($this->service_currency_abbr, "USD") == 0 || strcmp($this->service_currency_abbr, "EUR") == 0)
               && $this->rate > 0
            ) {
               $amount_to_paid = $this->other_amount_to_paid / $this->rate;
               // dd($amount_to_paid);
            } else {
               $amount_to_paid = $this->other_amount_to_paid * $this->rate;
            }
            if ($amount_to_paid <= $max_amount_to_paid)
               return 'required|numeric|min:1';
            else     return 'required|numeric|min:1|max:' . $max_amount_to_paid;
         } else return "";
      } catch (\Throwable $th) {
         throw $th;
      }
   }

   public function rate()
   {
      if ($this->request->has('payment_methode'))
         return 'required|numeric|min:1';
      else return "";
   }

   public function quantity_validate()
   {

      $services = Service::find(decrypt($this->service_id));


      if ($services->quantity != null && $this->quantity != null) {
         $this->quantity_limit = $services->quantity;
         return ($services->quantity < $this->quantity) ? 'required|numeric|max:' . $services->quantity : '';
      } elseif ($services->quantity != null && $this->quantity == null) {
         $this->quantity_limit = $services->quantity;
         return $services->quantity < 0 ? 'required|numeric|max:0' : '';
      } elseif ($services->quantity == null && $this->quantity != null) {

         return 'required|numeric|min:1';
      } else return "";
   }
}
