<?php

use App\Crypto;
use Carbon\Carbon;
use App\Helpers\TBO;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\HotelBooking;
use App\Models\Expo2020Deals;
use App\Models\PackageInterest;
use App\Mail\newExpoDealReceived;
use App\Jobs\SendHotelBookingEmails;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExpoDealConfirmationMail;
use Illuminate\Support\Facades\Session;
use App\Jobs\SendExpoDealReceivedEmails;
use App\Jobs\SendNewOrderReceivedEmails;
use App\Mail\NewPackageInterestReceived;
use App\Jobs\SendPcrBookingReceivedEmails;
use App\Mail\NewPackageInterestConfirmation;
use App\Jobs\SendPackageInterestReceivedEmails;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

// TO RETURN CHILDREN AGE FOR HOTELROOMS

if (! function_exists('generateChildrenAge')) {
    function generateChildrenAge($children_count = 0 ) {

         $children_age = [];

        if($children_count > 0 )
        {
            for($i=1; $i<$children_count + 1; $i++)
            {
                $children_age[] = rand(3,11);
            }
        }
        
        return $children_age;

    }
}


// TO RETURN PRICE WITH COMMISSION 

if(!function_exists('getAmountWithCommission')){
    function getAmountWithCommission($price){
        // if TBO then commission is se int TBO Dashboard
        if(config('app.apisource') == 'TBO'){
            return $price; 
        }
        $percentage = Config::get('app.commissionpercentage');
		$amount = ceil( $price +   ($percentage/100) * ($price));
        return $amount;
    }
}

// TO SET THE SEARCHDATA AND SAVE IT TO THE SESSION
if(!function_exists('setSearchData')){
    function setSearchData($city, $request){
       
        $children_age = $request->childage ?? null;
        $roomguests = [];
        $dates = explode('to' , $request->dates);

        if( $request->rooms == 1 ){

             $roomguests[0] = ['adultcount' => $request->adult  , 'childcount' => $request->children ];
        }

        if( $request->rooms > 1 )
       
        {
            for($i = 0 ; $i < $request->rooms ; $i++){
                
                $roomguests[$i] = ['adultcount' => $request->roomadult[$i] ?? 1  , 'childcount' => $request->roomchild[$i] ?? 0 ];
            }
        }

        if( $request->children > 0 ){
           
            for($j =0 ; $j < $request->children ; $j++  ){
                
                foreach($roomguests as $index => $guests){
                
                    if( $guests['childcount'] > 0 ){
                      
                        $k = $guests['childcount'] ; 
                        for($l = 0 ;  $l < $k; $l++){
                            if( !empty( $children_age )){
                                 $roomguests[$index]['childage'][] = array_shift($children_age); 
                            }
                           
                      
                        }
                    }
                }
            }
        }
        // need to fecth city code
        $searchData = ['cityId' => $city,'NationalityId' => $request->nationality,'CheckInDate' =>  Carbon::parse(trim($dates[0]))->format('Y-m-d'),'CheckOutDate' => Carbon::parse(trim($dates[1]))->format('Y-m-d'),
            'adults' => $request->adult ,'children' => $request->children,'rooms' => $request->rooms,'children_age' => $children_age , 'roomguests' => $roomguests ];
        // dd($searchData);
        // Saving search criteria to session     
        Session::put('searchData' ,  $searchData);

        return $searchData;
    }
}

// SET SESSION ID IN THE SESSION
if(!function_exists('setSessionId')){
    function setSessionId($sessionId){      
        Session::put('sessionId' ,  $sessionId);       
    }
}

// SET SESSION ID IN THE SESSION
if(!function_exists('set_available_for_booking')){
    function set_available_for_booking($avaiable_for_booking = 'false'){      
        Session::put('availableForBooking' ,  $avaiable_for_booking);       
    }
}


// To generate Reference Number for TBO
if(!function_exists('ClientReferenceNumber')){
    function ClientReferenceNumber(){
            
        $d =  reference_number_for_tbo(); //  '2021082252511';
      
        $unique_id = generate_unique_id();

        $output = $d.'000#'.$unique_id;
        return $output;
    }
}

// TO GENERATE 4 DIGIT UNIQUE ID
if(!function_exists('generate_unique_id')){
    function generate_unique_id(){

        $length = 4 ;
        $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        $unique_id = substr(str_shuffle($str), 0, $length);
    //    $unique_id = mt_rand(1000,9999);
        return $unique_id;

    }
}

// TO GENERATE 6 DIGIT UNIQUE ID
if(!function_exists('generate_long_unique_id')){
    function generate_long_unique_id(){

        $length = 6 ;
        $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        $unique_id = strtoupper(substr(str_shuffle($str), 0, $length));
    //    $unique_id = mt_rand(1000,9999);
        return $unique_id;

    }
}


// TO SET BOOKING DETAILS
if(!function_exists('setBookingDetails')){
    function setBookingDetails($request){

        $bookingDetails = ['roomdetails' => $request->roomdetails, 'ResultIndex' => $request->ResultIndex, 'roomIndex' => $request->roomIndex, 
                           'price' => $request->price, 'HotelCode' => $request->HotelCode,'HotelName' => $request->HotelName,'city' => $request->city
    ];

     Session::put('bookingDetails' ,  $bookingDetails);     
       
    }
}

// STORE ROOM COMBINATOINS
if(!function_exists('set_room_combinations')){
    function set_room_combinations($combinations){

         Session::put('roomcombinations' , $combinations);
         return true;
    }
}

// FORMATTING GUESTS FOR CART PAGE
if(!function_exists('get_guests_for_cart')){
    function get_guests_for_cart(){
       
        $searchData = Session::get('searchData');
        $guests = $searchData['roomguests'];



    }
}

// CLEAR STORED SESSIONS
if(!function_exists('clear_stored_sessions')){
    function clear_stored_sessions(){
       
        session()->forget('sessionId');
        session()->forget('bookingDetails');
        session()->forget('availableForBooking');
        
    }
}

// REFERENCE NO FOR TBO
if(!function_exists('reference_number_for_tbo')){
    function reference_number_for_tbo(){
       $a = now()->format('YmdHis');
       return $a; 
    }
}


// ENCRYPT DATA FOR PAYMENT
if(!function_exists('encrypt_data_for_payment')){
    function encrypt_data_for_payment($booking , $unique_id){
        
        $ccavenue = new Crypto; 

        $merchant_data = '';
        $data= [
            'merchant_id' => config('app.merchantid'),
            'order_id' => $unique_id, 
            'currency' => 'AED',
            'amount' => (float) $booking->price,
            'redirect_url' => route('payment_success'),
            'cancel_url' => route('payment_failure'),
            'language' =>'EN',
            'billing_name' => $booking->name ?? '',
            'billing_address'=> $booking->address ?? 'Dubai',
            'billing_city'=> $booking->city ?? 'Dubai',
            'billing_zip'=>'12345',
            'billing_country'=>$booking->country ?? 'United Arab Emirates',
            'billing_tel'=> $booking->phone ?? '',
            'billing_email' => $booking->email ?? '',
        ];

        foreach ($data as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}

       $encrypted_data=$ccavenue->encryptdata($merchant_data,config('app.working_key'));

        //  dd($merchant_data, $encrypted_data);
       return $encrypted_data ;
       
    }
}


// SAVING TO PAYMENTS TABLE
if(!function_exists('save_to_payments_table')){
    function save_to_payments_table($booking, $booking_type){

        $unique_id =  generate_long_unique_id();
        $encrypted_data = encrypt_data_for_payment($booking , $unique_id);

        $payment = Payment::create([

            'unique_id' =>  $unique_id,
            'booking_type' => $booking_type,
            'booking_id' => $booking->id ?? '',
            'encrypted_string' => $encrypted_data

        ]);

       

        $data= [
            'id' => $payment->id,
            'unique_id' =>$payment->unique_id,
            'status' => $payment->status,
        ];
        
        return $data;
    }
}

// UPDATE PAYMENTS TABLE AFTER PAYMENT 

if(!function_exists('update_payments_table')){
    function update_payments_table($unique_id , $response_data, $status){

        $payment = Payment::where('unique_id', $unique_id)->first();
        $payment->response_data = $response_data;
        $payment->status = $status;
        $payment->save();

        // UPDATE BOOKING TABLE AFTER PAYMENT
        update_booking_table($payment->booking_id, $payment->booking_type, $status);
        return true;
       
    }
}


// UPDATE BOOKING TABLE AFTER PAYMENT
if(!function_exists('update_booking_table')){
    function update_booking_table($id, $booking_type, $status){
       
        if($booking_type =='expo2020_deals'){

            $booking = Expo2020Deals::where('id',$id)->first();
            $booking->payment_status = $status;
            $booking->save();

            
            $mail = dispatch((new SendExpoDealReceivedEmails($booking))->onQueue("high"));            
        }

        if( $booking_type =='package'){
            $booking = PackageInterest::where('id',$id)->first();
            $booking->payment_status = $status;
            $booking->save();

            $booking->load('package');
            $mail = dispatch((new SendPackageInterestReceivedEmails($booking))->onQueue("high"));            
             
        }

        if( $booking_type =='pcr_package'){
            $booking = PackageInterest::where('id',$id)->first();
            $booking->payment_status = $status;
            $booking->save();

            $booking->load('package');
            $mail = dispatch((new SendPcrBookingReceivedEmails($booking))->onQueue("high"));            
             
        }


        if($booking_type =='hotel_booking'){

            $booking = HotelBooking::where('id',$id)->first();
            $booking->payment_status = $status;            

            $new = new TBO();

            $query = json_decode($booking->query_to_tbo, true);
            $bookingDetails = json_decode($booking->bookingDetails, true);
            $guests = json_decode($booking->guests, true);
            $email = $booking->email;

            // CREATE BOOKING AT TBO
            $createbooking = $new->HotelBook($query);

            // UPDATE BOOKING RESPONSE TO HOTEL BOOKINGS TABLE
            $booking->booking_response_from_api = json_encode($createbooking) ?? ''; 
            $booking->save();

           // send Email to guest and backend team       
           SendHotelBookingEmails::dispatch($email, $guests, $bookingDetails, $createbooking )->onQueue("high");

           clear_stored_sessions();     
           return true;

        }



        if( $booking_type =='product'){
            $booking = Invoice::where('id',$id)->first();
            $booking->payment_status = $status;
            $booking->save();

            $booking->load('items');            

            session()->forget('cart');

            $mail = dispatch((new SendNewOrderReceivedEmails($booking))->onQueue("high"));            
             
        }

        return true;

    }
}

// IMAGE UPLOAD HANDLER
if(!function_exists('save_uploaded_image')){
    function save_uploaded_image($file , $location, $width = null , $height = null ){

        $filename = explode('.', time().'_'.$file->getClientOriginalName())[0];

        $filename = preg_replace('/\s+/', '_', $filename);
        
        $filename  = str_replace('.', '_', $filename);
       
       $image = Image::make($file)->encode('jpg', 90);

       if (  $width !=null && $height !=null ){
        $image->resize($width, $height);
       }

          // Save as Jpg
       $image->save(public_path( $location.$filename.'.jpg'));

    //    Optimizing image

        ImageOptimizer::optimize(public_path( $location.$filename.'.jpg'));
    //    ImageOptimizer::optimize($location.$filename.'.jpg', $location.$filename.'_optimized.jpg');
         //    save as Webp
       $image->save(public_path($location.$filename.'.webp'));

       return $filename.'.jpg'; 

       
    }
}

// GET TOTAL PRICE FROM CART
if(!function_exists('get_total_price')){
    function get_total_price(){
       
        $cart = session()->get('cart');
        $sum = 0 ; 
        foreach($cart as $item){


            // for offer price buy 2 for 250 ;

            if ( $item['qty'] % 2 == 0 ){

               $price = $item['qty'] * 100 ;
            }else{

                $price = $item['qty'] * $item['price'];
            }
            
            $sum = $sum + $price; 
        }

        return $sum; 
    }
}


// SETTING SESSION EXPIRY TIME
if(!function_exists('set_session_expiry')){
    function set_session_expiry(){
       $time = Carbon::now();
       Session::put('session_expiry_time', $time);
    }
}


// CHECK IF SESSION STILL VALID OR NOT
if(!function_exists('check_session_valid')){
    function check_session_valid(){

        $startTime = Carbon::parse(session()->get('session_expiry_time')) ;
        $currentTime = Carbon::now();
        $a = $currentTime->diffInMinutes($startTime); 

        if($currentTime->diffInMinutes($startTime) > 1)
        {
            clear_stored_sessions();
            Session::flash('error', 'Session timed out! Please start again');
            return redirect()->route('homepage');
        }
        return true;
       
    }
}




// TEMPLATE
if(!function_exists('template')){
    function template(){
       
    }
}









