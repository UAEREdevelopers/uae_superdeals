<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\NewOrderReceived;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\NewOrderReceivedConfirmation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendNewOrderReceivedEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $invoice;

    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         $invoice = $this->invoice; 
        Mail::to('shafi.uaere@gmail.com')->send(new NewOrderReceived($invoice));
        Mail::to('divya@superdeals.ae')->send(new NewOrderReceived($invoice));

        //send email to customer
        Mail::to($invoice->email)->send(new NewOrderReceivedConfirmation($invoice));
    }
}
