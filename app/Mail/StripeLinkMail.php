<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StripeLinkMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $bar;
    public $link;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($bar,$link)
    {
        $this->bar=$bar;
        $this->link=$link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Barconnex')
        ->view('emails.stripe_link_mail');
    }
}
