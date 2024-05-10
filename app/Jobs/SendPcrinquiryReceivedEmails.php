<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\newPcrInquiryReceived;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use App\Mail\newPcrInquiryConfirmation;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class SendPcrinquiryReceivedEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,IsMonitored;

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
    {
         $booking = $this->booking; 
        Mail::to('shafi.uaere@gmail.com')->send(new newPcrInquiryReceived($booking));
        Mail::to('zahidshawl@superdeals.ae')->send(new newPcrInquiryReceived($booking));
        Mail::to('saad@uaepropertyfinder.ae')->send(new newPcrInquiryReceived($booking));
        Mail::to('divya@superdeals.ae')->send(new newPcrInquiryReceived($booking));

        //send email to customer
        Mail::to($booking->email)->send(new newPcrInquiryConfirmation($booking));
    }
}
