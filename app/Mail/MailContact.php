<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailContact extends Mailable
{
    use Queueable, SerializesModels;

    public $messageContact;

    public function __construct($messageContact)
    {
        $this->messageContact = $messageContact;
    }

    public function build()
    {
        return $this->subject($this->messageContact['subject'])->view('MailContact', $this->messageContact);
    }
}
