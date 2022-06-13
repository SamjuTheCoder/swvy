<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Welcome extends Mailable
{
    use Queueable, SerializesModels;
    public $email, $fullname;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $fullname)
    {
        //
        $this->email = $email;
        $this->fullname = $fullname;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('message');
    }
}
