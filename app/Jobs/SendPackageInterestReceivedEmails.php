<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use App\Mail\NewPackageInterestReceived;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\NewPackageInterestConfirmation;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendPackageInterestReceivedEmails implements ShouldQueue
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
    {   $booking = $this->booking; 
        Mail::to('shafi.uaere@gmail.com')->send(new NewPackageInterestReceived($booking));
        Mail::to('divya@superdeals.ae')->send(new NewPackageInterestReceived($booking));

        //send email to customer
        Mail::to($booking->email)->send(new NewPackageInterestConfirmation($booking));
    }
}
