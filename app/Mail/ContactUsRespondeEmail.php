<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactUsRespondeEmail extends Mailable
{
    

    use Queueable, SerializesModels;

    public $emailSubject;
    public $emailDescription;

    public function __construct($subject, $description)
    {
        $this->emailSubject = $subject;
        $this->emailDescription = $description;
    }

    public function build()
    {
        return $this->subject($this->emailSubject)
                    ->view('emails.Contact-us.contact-us-reponse');
    }
}
