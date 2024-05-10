<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrderReceivedConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    protected $invoice; 

    public function __construct($invoice)
    {
     $this->invoice = $invoice; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.orders.order_confirmed')->with('invoice',$this->invoice);
    }
}
