<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewHotelBookingReceived;
use App\Mail\NewHotelInterestReceived;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class SendHotelBookingEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, IsMonitored;

 

    private $guests;
    private $roomdetails;
    private $bookingdetails; 
    private $email;

    public function __construct($email, $guests, $roomdetails, $bookingdetails)
    {
        $this->guests = $guests;
        $this->roomdetails = $roomdetails;
        $this->bookingdetails = $bookingdetails;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   
        $data['guests'] = $this->guests;
        $data['roomdetails'] = $this->roomdetails;
        $data['bookingdetails'] = $this->bookingdetails;

        //Send mail to cutomer 
          Mail::to($this->email)->queue(new NewHotelBookingReceived($data));

        // send mail to backendteam
          Mail::to('shafi.uaere@gmail.com')->queue(new NewHotelInterestReceived($data));
          Mail::to('divya@superdeals.ae')->queue(new NewHotelInterestReceived($data));
    }
}
