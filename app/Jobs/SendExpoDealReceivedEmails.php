<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\newExpoDealReceived;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExpoDealConfirmationMail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendExpoDealReceivedEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  
    private $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {       $booking = $this->booking; 
        //send email to divya
            Mail::to('shafi.uaere@gmail.com')->send(new newExpoDealReceived($booking));
            Mail::to('divya@superdeals.ae')->send(new newExpoDealReceived($booking));

            //send email to customer
            Mail::to($booking->email)->send(new ExpoDealConfirmationMail($booking));
    }
}
