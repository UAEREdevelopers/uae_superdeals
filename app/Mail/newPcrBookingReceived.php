<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newPcrBookingReceived extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $package;

    public function __construct($package)
    {
        $this->package = $package;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        return $this->markdown('emails.pcr.booking.bookingreceived')->with('package', $this->package);
       
    }

    
}
