<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;




class emailSent extends Mailable
{

    public $emails;

    public $fromUser;

    public $leadEmail;

    use Queueable, SerializesModels;

    public function __construct($emails, $user, $lead)
    {
        $this->emails = $emails;
        $this->fromUser = $user;
        $this->lead = $lead;

    }




    public function build()
    {

       $fromUser = $this->fromUser->email;
       $leadEmail = $this->lead->email;
    
          
        return $this->from($fromUser)
                    ->to($leadEmail)
                    ->subject($this->emails->subject)
                    ->markdown('mail.email-sent');
    }


}



