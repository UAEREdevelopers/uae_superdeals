<?php

namespace App\Http\Controllers;

use App\Crypto;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    private $access_code;
    private $working_key;
    private $merchant_id;
    private $crypto;

    public function __construct(){

        $this->access_code =  config('app.accesscode');
        $this->working_key =  config('app.working_key');
        $this->crypto = new Crypto; 
    }


    public function index(Request $request, $id = null ){
        
       $payment = Payment::where('unique_id', $id)->firstorfail();
       $encrypted_string = $payment->encrypted_string;     
       $access_code = $this->access_code; 
       $production_url='https://secure.ccavenue.ae/transaction/transaction.do?command=initiateTransaction';
       return view('frontend.payment.index')->with(compact(['production_url', 'encrypted_string','access_code' ]));

    }


    public function paymentSuccess(Request $request){
      
        $encResponse=$request->encResp;
        $rcvdString=$this->crypto->decryptdata($encResponse, $this->working_key);
        $decryptValues=explode('&', $rcvdString);	
        $order_status="";
        $order_id = $decryptValues[0];
	    
        $dataSize=sizeof($decryptValues);

        for($i = 0; $i < $dataSize; $i++) 
            {
                $information=explode('=',$decryptValues[$i]);

                if($i==0)	$order_id=$information[1];                
                if($i==3)	$order_status=$information[1];

                
            }

         // UPDATE IN PAYMENTS TABLE
         update_payments_table($order_id , $rcvdString , $order_status);

         $status = $order_status;
         if($order_status=='Success'){
            \Log::info('PaymentController: payment: success');
         }


    return view('frontend.payment.paymentstatus')->with(compact('status'));

    }

    public function paymentFailure(Request $request){

    $status = 'failed';

    // change the status in the booking as failed.

    // email payment failure to operation team - Divya


    return view('frontend.payment.paymentstatus')->with(compact('status'));

    }
}
