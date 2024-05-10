<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewHotelBookingReceived extends Mailable
{
    use Queueable, SerializesModels;

   
    protected  $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   

        //  sending mail to guest 
        if(config('app.apisource') == 'TBO'){   
          

             return $this->subject('New Hotel booking received')->markdown('emails.new_hotel_booking_received_tbo')->with('data', $this->data);
    }
             return $this->view('emails.new_hotel_booking_received')->with('data', $this->data);
       
    }
}
