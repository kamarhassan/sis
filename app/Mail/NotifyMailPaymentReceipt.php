<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyMailPaymentReceipt extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public  $std;
    public  $user;
    public  $cours;
    public  $fee_required;
    public  $fees;
    public  $old_payment;
    public  $receipt;
    public  $currency ;
//  public function __construct($std,$user,$cours,$fee_required,$fees,$old_payment,$receipt)
 public function __construct($data)
    {
        // dd($data['user']);

        // $this->user = $user;
        // $this->cours =$cours;
        // $this->fee_required = $fee_required;
        // $this->fees = $fees;
        // $this->old_payment = $old_payment;
        // $this->receipt = $receipt;
        // $this->std = $std;

        $this->user = $data['user'];
        $this->cours =  $data['cours'];
        $this->fee_required = $data['fee_required'];

        $this->fees = $data['fees'];
        $this->old_payment = $data['old_payment'];
        $this->receipt = $data['receipt'];
        $this->std = $data['std'];
        $this->currency = $data['currency'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->markdown('emails.Payment.NotifyMailPaymentReceipt')
        ->with([
                "user" => $this->user,
                "cours" => $this->cours,
                'fee_required' => $this->fee_required,
                'fees' => $this->fees,
                'old_payment' => $this->old_payment,
                'receipt' => $this->receipt,
                'std' => $this->std,

            ]);
    }
}
