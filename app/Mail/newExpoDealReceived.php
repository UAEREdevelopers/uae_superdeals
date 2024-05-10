<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newExpoDealReceived extends Mailable
{
    use Queueable, SerializesModels;

    protected $booking; 

    public function __construct($booking)
    {
     $this->booking = $booking; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.expodeals.newexpodealreceived')->with('booking',$this->booking);
    }
}
