<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Helpers\TBO;
use App\Models\TboCity;
use App\Models\TboCountry;
use App\Jobs\SaveTboCities;
use App\Models\HotelBooking;
use App\Models\TboHotelCode;
use Illuminate\Http\Request;
use App\Models\TboHotelDetail;
use App\Jobs\SaveTboHotelCodes;
use App\Jobs\SaveTboHotelDetails;
use Illuminate\Support\Facades\Log;
use App\Jobs\SendHotelBookingEmails;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewHotelBookingReceived;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use App\Helpers\General\CollectionHelper;
use App\Jobs\FetchAllHotelResultsAndCache;

class TBOController extends Controller
{   


    public function GetCountryList(){
        $new = new TBO;

        $countries = $new->CountryList();  
      
      foreach($countries as $country)
      { 
        TboCountry::firstOrCreate(['CountryCode' => $country['CountryCode']],['CountryName' => $country['CountryName']]);
      }

      return 'success';

        print_r($new->CountryList());
    }

    public function GetCityList(){
        $new = new TBO();
        
        $countries = TboCountry::all();

        foreach($countries as $country)
        {      
              $new = new TBO();

              $query = ["CountryCode"=>["value"=> "$country->CountryCode" ], "ReturnNewCityCodes" => ["value"=>"true"] ];

              Log::info('received for country'. $country->CountryCode );
            
              $cities = $new->DestinationCityList($query);              
              
             SaveTboCities::dispatch($cities, $country);             

        }
      
        return 'success';
    }

    public function GetHotelCodeList(){   

        TboCity::chunk(100, function($cities){

            foreach($cities as $city){                

             SaveTboHotelCodes::dispatch($city->CityCode);
            
        }
        });       
        
        return 'success';
        // print_r($new->TBOHotelCodes($query)); 

    }

    public function getHotelDetail(){   
        
        TboHotelCode::select('HotelCode')->chunk(1000, function($hotelcodes){

        foreach($hotelcodes as $hotelcode){

             SaveTboHotelDetails::dispatch( $hotelcode->HotelCode);

        // $new = new TBO();
        // $query = ["HotelCode"=>["value"=>  $hotelcode->HotelCode]];
        // $details = $new->HotelDetails($query);

        //  if($details['status']['statusCode'] == '01'){
        //         SaveTboHotelDetails::dispatch($details['hoteldetails']);
        //     }
        } 

        });

               
        return 'success';
        // print_r($new->HotelDetails($query));
    }

    public function getHotelDetailForCity(Request $request, $city){

        TboHotelCode::where('CityName',$city)->select('HotelCode')->chunk(1000, function($hotelcodes){

        foreach($hotelcodes as $hotelcode){

             SaveTboHotelDetails::dispatch($hotelcode->HotelCode)->onQueue("medium");
      
        } 
        });

    }

    public function HotelSearch(){
        $new = new TBO();
        $query = [
            "CheckInDate"=>[
                "value"=>"2021-10-25"
            ],
            "CheckOutDate"=>[
                "value"=>"2021-10-26"
            ],
            "CountryName"=>[
                "value"=>"United Arab Emirates"
            ],
            "CityName"=>[
                "value"=>"Dubai"
            ],
            "CityId"=>[
                "value"=>"115936"
            ],
            "IsNearBySearchAllowed"=>[
                "value"=>'false'
            ],
            "NoOfRooms"=>[
                "value"=>2
            ],
            "GuestNationality"=>[
                "value"=>"IN"
            ],
            "RoomGuests"=>[
                "value"=>[
                    "0"=>[
                        "attr"=>[
                            "AdultCount"=>1,
                            "ChildCount"=> 2
                        ],
                        "childAge"=>[
                        "value"=> [5,10]
                        ]
                        ],

                    "1"=>[
                        "attr"=>[
                            "AdultCount"=>2,
                            "ChildCount"=> 3
                        ],
                        "childAge"=>[
                        "value"=> [5,10,15]
                        ]
                        ],
                ]
            ],
            "ResultCount" => [
                "value" => 1
            ],
            "Filters" => [
                "value" => [
                    "StarRating" =>[
                        "value"=>"All"
                    ],
                    "OrderBy" =>[
                        "value"=>"PriceAsc"
                    ]
                ]
            ]
        ];  

        // dd($query);
        print_r($new->HotelSearch($query)); 
    }

    public function getAvailableHotelRooms(){

         $new = new TBO();
         $query = [
             "SessionId"=>["value"=>  "90e5b7f4-34cf-4452-96bb-d978b1a72df5"],
             "ResultIndex"=>["value"=>  "1"],
             "HotelCode"=>["value"=>  "1225216"],
             "IsCancellationPolicyRequired"=>["value"=>  "true"]           
            
            ];

        print_r($new->AvailableHotelRooms($query));

    }

    public function getHotelCancellationPolicy(){
        $new = new TBO();
         $query = [
             "SessionId"=>["value"=>  "90e5b7f4-34cf-4452-96bb-d978b1a72df5"],
             "ResultIndex"=>["value"=>  "1"],
             "OptionsForBooking" =>["value" => [ 

                                                "FixedFormat" => ["value" => "false"],
                                                "RoomCombination" =>["value" => ["RoomIndex" =>  ["value" => 1 ]]]
                 
                                               ] 
                                    ]          
            
            ];

        print_r($new->HotelCancellationPolicy($query));
    }

    public function getAvailabilityAndPricing(){
          $new = new TBO();
         $query = [
             "SessionId"=>["value"=>  "90e5b7f4-34cf-4452-96bb-d978b1a72df5"],
             "ResultIndex"=>["value"=>  "1"],
             "OptionsForBooking" =>["value" => [ 

                                                "FixedFormat" => ["value" => "false"],
                                                "RoomCombination" =>["value" => ["RoomIndex" =>  ["value" => 1 ]]]
                 
                                               ] 
                                    ]          
            
            ];

        print_r($new->AvailabilityAndPricing($query));
    }

    public function getHotelBook(){
        $new = new TBO();
         $query = [
             "ClientReferenceNumber"=>["value"=>  "180214120000000#TBOH"],
             "GuestNationality"=>["value"=>  "IN"],

            "SessionId"=>["value"=>  "IN"],
            "NoOfRooms"=>["value"=>  "1"],
            "ResultIndex"=>["value"=>  "1"],
            "HotelCode"=>["value"=>  "1"],
            "HotelName"=>["value"=>  "1"],



             "Guests" =>[
                 "value" =>[ 
                    "Guest" => [
                        "attr"=>[
                                "LeadGuest"=>1,
                                "GuestType"=> "Adult",
                                "GuestInRoom" => 1
                            ],

                            "value" => [
                                "Title" => ["value"=>  "Mr."]  ,
                        "FirstName" => ["value"=>  "FirstName"] ,
                        "LastName" => ["value"=>  "LastName"] ,
                        "Age" => ["value"=>  20] 
                            ]
                        


                 ]                 
                    ]],
            "AddressInfo" =>[
                    "value"=>[
                "AddressInfo" =>["value"=>  "AddressInfo"],
                "AddressLine1" => ["value"=>  "AddressLine1"]  ,
                "AddressLine2" => ["value"=>  "AddressLine2"] ,
                "CountryCode" =>  ["value"=>  "CountryCode"] ,
                "AreaCode" =>  ["value"=>  "AreaCode"] ,
                "AddressInfo" => ["value"=>  "AddressInfo"]  ,
                "AddressInfo" => ["value"=>  "AddressInfo"] ,

            ]],
            "PaymentInfo" =>[ 
                 "attr" => [
                    "VoucherBooking" =>"false",
                    "PaymentModeType" => "Limit"
                ]],
            
           

            
            ];

            // dd($query);

        print_r($new->HotelBook($query));
    }

    public function getHotelBookingDetail($client_reference_number){

        $new = new TBO();
         $query = ["ClientReferenceNumber" =>["value" => $client_reference_number] ];
         $details = $new->HotelBookingDetail($query);
         return $details;
         print_r($new->HotelBookingDetail($query));
         die();

    }

    //  Above codes are tested and working sturcture for TBO Xml Calls . Do not alter them 

    public function countriesList(){

        $countries = TboCountry::select('CountryCode as country_id','CountryName as country_name')->get();
        return $countries;

    }

    public function homepagesearch(Request $request){
        
          $data = [];
        $result= TboHotelCode::select('HotelName','CityName')->where('HotelName', 'LIKE', $request->q.'%')
                                            ->orWhere('CityName', 'LIKE', $request->q.'%')
                                            ->take(50)->get();
        foreach($result as $hotel)
        {
            $data[] = $hotel->HotelName.' | '.$hotel->CityName;

            // Adding city name also to the search

            if(!in_array($hotel->CityName, $data))
            {
                  $data[] = $hotel->CityName;
            }
           
        }
     
        return response()->json($data);
    }

    public function homepagesearchSubmit(Request $request){   

        // IF TRUE THEN SEARCHING FOR CITYWISE
        if(strpos($request->hotel , '|') == false ){
            
            return $this->showResultsForCity($request);
        }

         // IF TRUE THEN SEARCHING FOR SPECIFIC HOTEL
        if(strpos($request->hotel , '|') !== false ){

            return $this->showResultsForHotel($request);
        } 

        
    }

    public function showResultsForHotel($request){
        
        $Search_hotel = explode('|',$request->hotel); 
        $hotel = TboHotelCode::with('city:id,CityName,CityCode')->where('HotelName',trim($Search_hotel[0]))->firstorfail();
        
        $CityCode = $hotel->city->CityCode;

        // CREATE searchData  AND SAVE IN THE SESSION
        $searchData = setSearchData($CityCode ,$request);

         $results = $this->HotelSearchbyCityCodeWithHotelCode($hotel , $searchData ) ;

          // CHECK IF ERROR        
            if ($results['status']['statusCode']  != '01' ){
                echo $results['status']['statusDesc'];
                die();
            } 
            
             // setting session expiry time and check
            set_session_expiry();

        $hotels = $this->paginate($results['HotelResult'] );

         
        return view('frontend.hotel_results_list_view_tbo')->with(compact(['hotels']));  


    }

    public function showResultsForCity($request){

        $city = TboCity::where('CityName', trim($request->hotel))->firstorfail();
        $CityCode = $city->CityCode;

        // CREATE searchData  AND SAVE IN THE SESSION
        $searchData = setSearchData($CityCode ,$request );
        $results = $this->getCacheOrNewSearch($searchData , $city, $request);

        // CHECK IF ERROR        
            if ($results['status']['statusCode']  != '01' ){
                echo $results['status']['statusDesc'];
                die();
            } 
        
        $hotels = $this->paginate($results['HotelResult'] );

        return view('frontend.hotel_results_list_view_tbo')->with(compact(['hotels']));    

       
    }

    public function HotelSearchbyCityCodeWithHotelCode($hotel , $searchData){
      
       $new = new TBO();
       $guests = $this->divideGuestsInRooms($searchData['rooms'], $searchData['adults'],  $searchData['children'], $searchData['children_age'], $searchData['roomguests']);   
       
        $query = [

            "CheckInDate"=>["value"=>$searchData['CheckInDate']],
            "CheckOutDate"=>["value"=> $searchData['CheckOutDate']],
            "CountryName"=>["value"=> $hotel->CountryName ?? "United Arab Emirates"],
            "CityName"=>["value"=> $hotel->CityName],
            "CityId"=>["value"=> $hotel->city->CityCode],
            "IsNearBySearchAllowed"=>["value"=>'false'],
            "NoOfRooms"=>["value"=>$searchData['rooms']],
            "GuestNationality"=>["value"=> $searchData['NationalityId']],
            "RoomGuests"=>$guests,
            "ResultCount" => ["value" => 1],
            "PreferredCurrencyCode" => ["value" => 'AED'],
            "Filters" => ["value" => ["StarRating" =>["value"=>"All"],"OrderBy" =>["value"=>"PriceAsc"] , "HotelCodeList" => [ "value" => $hotel->HotelCode ]]]

        ];  

        // Make API Call

        $hotels = $new->HotelSearch($query);
        // print_r($new->HotelSearch($query)); 
        //  dd($query);
        return $hotels;

    }

    public function getCacheOrNewSearch($searchData , $city , $request ){

        // Cache name include: checkin, checkout, city, room, adult, children,nationality

        // Need to add filter also to make more specific for caching.

        $cacheName = $searchData['CheckInDate'].$searchData['CheckOutDate'].$city->CityCode.$searchData['rooms'].$searchData['adults'].$searchData['children'].$searchData['NationalityId'];

        //  Saving cache name to session
        
        Session::put('cacheNameCity', $cacheName);

        // setting session expiry time and check
        set_session_expiry();

        

        if(Session::has('cacheNameCity'))
        {
            if(Cache::has(session('cacheNameCity')) &&  session('cacheNameCity') == $cacheName )
                {  
           
                    $results = Cache::get(session('cacheNameCity'));  
                  
                    if( $request->sorttype != ''){

                        return $this->sorting($request->sorttype, $request->value);
                    }

                                 
                    return $results;

                 }

        }        
        // If no cache results found, Make API Call 

        $results = $this->HotelSearchbyCityCode($searchData , $city);
        return $results; 
    }

    public function HotelSearchbyCityCode($searchData, $city){       

        $new = new TBO();

        
        $guests = $this->divideGuestsInRooms($searchData['rooms'], $searchData['adults'],  $searchData['children'], $searchData['children_age'], $searchData['roomguests']);   
        
        $query = [

            "CheckInDate"=>["value"=>$searchData['CheckInDate']],
            "CheckOutDate"=>["value"=> $searchData['CheckOutDate']],
            "CountryName"=>["value"=> $city->CountryName],
            "CityName"=>["value"=> $city->CityName ],
            "CityId"=>["value"=> $city->CityCode],
            "IsNearBySearchAllowed"=>["value"=>'false'],
            "NoOfRooms"=>["value"=>$searchData['rooms']],
            "GuestNationality"=>["value"=> $searchData['NationalityId']],
            "RoomGuests"=>$guests,
            "PreferredCurrencyCode" => ["value" => 'AED'],
            "ResultCount" => ["value" => 30],
            "Filters" => ["value" => ["StarRating" =>["value"=>"All"],"OrderBy" =>["value"=>"PriceAsc"]]]

        ];  

        $results = ($new->HotelSearch($query));     

        // Caching the query to faster processing and avoiding API calls for all request

        
        Cache::put(session('cacheNameCity'), $results,  now()->addMinutes(30));

        Log::info('Cache Name before job started '. session('cacheNameCity'));
        // Fetch remaining hotel results and cache
        dispatch(new FetchAllHotelResultsAndCache($query, session('cacheNameCity')))->onQueue("high"); 
        
        return $results; 

    }

    public function divideGuestsInRooms( $rooms, $adults, $children, $children_age , $roomguests){

        // dd($roomguests);
        // testing
        $guests = [] ; 
        for($i = 0; $i < $rooms ; $i++ ){
             $guests['value'][$i]['attr']['AdultCount']  = $roomguests[$i]['adultcount'];
             $guests['value'][$i]['attr']['ChildCount']  = $roomguests[$i]['childcount'];

             if( isset(  $roomguests[$i]['childage']) && $roomguests[$i]['childage'] != null ){

                  $guests['value'][$i]['childAge']['value']  = $roomguests[$i]['childage'];
             }
        }
        //   dd($guests);
         return $guests;

       

        // testing ends
              
        $a =0;
        $k = 0;
        $totalAdults = 1;
        $totalChildren = 1;

        $guests = [];

        // case for 2 rooms and 1 adult 1 child 
        // if( $rooms =2 && $adults =1 && $children = 1){
        //      $guests['value'][0]['attr']['AdultCount'] = 1;
        //      $guests['value'][1]['attr']['ChildCount'] = 1; 
        //       $guests['value'][1]['childAge']['value']= $children_age;

        //        return $guests;

        // }


        for($i = $adults ; $i>= 0 ; $i = $i- $rooms ){   
            for($j=0; $j<$rooms; $j++){

                    $a = $guests['value'][$j]['attr']['AdultCount'] ?? 0 ;
                    if ($totalAdults <= $adults ){
                       $guests['value'][$j]['attr']['AdultCount'] = $a+1; 
                       $guests['value'][$j]['attr']['ChildCount']  = 0 ;
                       $totalAdults = $totalAdults +1 ;
                    }                     
                }
                
            }

            for($i = $children ; $i>= 0 ; $i = $i- $rooms ){  
                  
            for($j=0; $j<$rooms; $j++){

                    $a = $guests['value'][$j]['attr']['ChildCount'] ?? 0 ;
                    if ($totalChildren <= $children ){

                       $guests['value'][$j]['attr']['ChildCount'] = $a+1; 
                    
                       // To make children Age    

                       $guests['value'][$j]['childAge']['value'][] = $children_age[$k];
                    }
                       $totalChildren = $totalChildren +1 ;
                       $k = $k + 1  ;
                    }                     
                }

            return $guests;
                
    }

    public function HotelDetailView(Request $request, $id, $resultindex){

        $hotel = TboHotelDetail::where('HotelCode', $id)->firstorfail();
        $new = new TBO();
        $query = [ "SessionId"=>["value"=>  session('sessionId')],"ResultIndex"=>["value"=>  $resultindex ],"HotelCode"=>["value"=>  $id],"IsCancellationPolicyRequired"=>["value"=>  "true"]];

        $result = $new->AvailableHotelRooms($query);

        if(session('searchData.rooms') > 1 &&  count( $result['combinations']) > 0 ){
            return $this->hotelViewForMultipleRooms($result , $hotel) ; 
        }



        return view('frontend.hotel_detail_tbo')->with(compact(['result', 'hotel']));


    }

    public function hotelViewForMultipleRooms($result, $hotel){

        $data = [];

        foreach($result['RoomDetails'] as $room){
            foreach($result['combinations'] as $index => $combination){
                if( in_array($room['RoomIndex'], $combination)){
                    $data[$index][] = $room; 
                }
            }
        }
        //  dd($data);
        return view('frontend.hotel_detail_tbo_multiple_rooms')->with(compact(['data', 'hotel' , 'result']));

    }

    public function checkAvailability(Request $request){

         $new = new TBO();
         $roomindex = $this->getRoomIndexForAvailability($request->roomIndex);
         $query = [
              "ResultIndex"=>["value"=>  $request->ResultIndex],
              "HotelCode" =>["value"=>  ""],
             "SessionId"=>["value"=>  $request->SessionId],            
             "OptionsForBooking" =>["value" => ["FixedFormat" => ["value" => "false"],"RoomCombination" =>[
                 "value" => $roomindex // ["RoomIndex" =>  ["value" =>  $request->roomIndex ]]
             
             ]]]];
        
            $result = $new->AvailabilityAndPricing($query);

            // setting Available for Booking in the Session
            set_available_for_booking($result['AvailableForConfirmBook']);

            
            return $result;
        print_r($new->AvailabilityAndPricing($query));
        
    }

    public function getRoomIndexForAvailability($roomIndex){

        $rooms = session('searchData.rooms');
        $result = [];

        if( $rooms == 1 ){
            $result[0]['value'] = $roomIndex ;
            return $result ;
        }

        if($rooms > 1 ){

            $roomindex = explode("," , $roomIndex);

            //Saving combinations to session for room booking
            $set = set_room_combinations( $roomindex);
          
        }

        for($i = 0; $i < $rooms ; $i++){
            $result[$i]['value'] =$roomindex[$i];
        }

        return $result;
    }

    public function submitInterest(Request $request){
        // dd($request);
        $price = $request->price; 
        $roomdetails = json_decode($request->roomdetails , true) ;

        if( session('searchData.rooms') == 1 ){
            $temp[] = $roomdetails ;
            $roomdetails = $temp; 
        }
        $bookingdetails = setBookingDetails($request);
        $guests = get_guests_for_cart();
        //  dd($roomdetails);
        return view('frontend.cart')->with(compact(['price','roomdetails']));
    }

    public function bookHotel(Request $request){

        $country = explode('|', $request->country);
        $searchData = Session::get('searchData');
        $bookingDetails = Session::get('bookingDetails');
        $roomdetails = json_decode($bookingDetails['roomdetails'], true);
       
       $guests = $this->formatGuestsForBooking($request->guest);
       $HotelRooms = $this->formatHotelRoomsForBooking($roomdetails , $searchData['rooms']);      
       $client_reference_number = ClientReferenceNumber();

        $new = new TBO();
        $query = [
             "ClientReferenceNumber"=>["value"=> $client_reference_number ],
             "GuestNationality"=>["value"=>  $searchData['NationalityId']],
            "SessionId"=>["value"=> session('sessionId')],
            "NoOfRooms"=>["value"=>  $searchData['rooms']],
            "ResultIndex"=>["value"=> $bookingDetails['ResultIndex']],
            "HotelCode"=>["value"=>  $bookingDetails['HotelCode']],
            "HotelName"=>["value"=>  $bookingDetails['HotelName']],
            "Guests" => $guests,
            "AddressInfo" =>[
                    "value"=>[
                "AddressLine1" => ["value"=>   $request->street_1]  ,
                "AddressLine2" => ["value"=>   $request->street_2] ,
                "CountryCode" =>  ["value"=>  $country[0]] ,
                "AreaCode" =>  ["value"=>   $request->postal_code] ,
                "PhoneNo" => ["value"=>  $request->phone]  ,
                "Email" => ["value"=>   $request->email] ,
                "City" => ["value"=>   $request->city] ,
                "State" => ["value"=>   $request->state] ,
                "Country" => ["value"=>   $country[1]] ,
                "ZipCode" => ["value"=>   $request->postal_code] ,

            ]],
            "PaymentInfo" =>[ 
                 "attr" => [
                     "VoucherBooking" =>"true",
                    // "VoucherBooking" => session('availableForBooking') == 'true' ? "false" : "true",
                    "PaymentModeType" => "Limit"
                ]],

                "HotelRooms" => $HotelRooms              
             ];

       
        
        $createbooking = null; 

        // Save the booking to Database
        $booking = $this->saveBooking($request, $searchData, $bookingDetails, $roomdetails , $createbooking , $country ,  $guests , $query );

        //UPDATE PAYMENTS TABLE FOR PAYMENT ID        
        $payment = save_to_payments_table($booking, 'hotel_booking');

        // UPDATE PAYMENT TABLE ID IN HOTEL BOOKINGS TABLE
        $booking->update(['payment_table_id' => $payment['id']]);

        // REDIRECT TO PAYMENT PAGE
        return redirect()->route('payment_link', ['id'=> $payment['unique_id']]);

       
        // REMOVE LINES BELOW THIS ONCE CODES ARE CONFIRMED 


        $createbooking = $new->HotelBook($query);
            
            // if( session('availableForBooking') == 'true')
            // {

            // //  Making booking API call
            // $createbooking = $new->HotelBook($query);

            // }
           
        
        // fetch booking details from TBO to confirm booking
        //  $hotelbookingdetail =  $this->getHotelBookingDetail( $client_reference_number); 
        
        

        // send Email to guest and backend team       
        SendHotelBookingEmails::dispatch($guests, $bookingDetails, $createbooking ); 

        clear_stored_sessions();
     
        return view('frontend.booking_completed')->with(compact('createbooking'));

        print_r($new->HotelBook($query));

        // REMOVE TILL ABOVE 
       
    }

    public function generateInvoice($booking){

        $query = [
              "ConfirmationNo"=>["value"=>  $booking->ConfirmationNo],
              "PaymentInfo"=>["attr"=>[ "VoucherBooking" =>"true", "PaymentModeType" => "Limit"]]
        ];

         $new = new TBO();
         $confirmation = $new->GenerateInvoice($query);
        return $confirmation;

    }

    public function saveBooking($request, $searchData, $bookingDetails, $roomdetails , $createbooking , $country , $guests , $query ){

        $booking = HotelBooking::create([
            'unique_id'=>generate_unique_id(),
            'reference_no_to_api' => ClientReferenceNumber(),
            'api_platform' => 'TBO',
            'status'=> $createbooking['BookingStatus'] ?? 'Pending',
            'BookingId' => $createbooking['BookingId'] ?? 'NA',
            'ConfirmationNo' => $createbooking['ConfirmationNo'] ?? 'NA',
            'TripId' => $createbooking['TripId'] ?? 'NA',
            'HotelCode' => $bookingDetails['HotelCode'],
            'HotelName' => $bookingDetails['HotelName'],
            'city' => $bookingDetails['city'] ?? 'NA',
            'country' => $country[1] ?? 'NA',
            'checkInDate' => $searchData['CheckInDate'],
            'checkOutDate' => $searchData['CheckOutDate'],
            'adults' => $searchData['adults'],
            'children' => $searchData['children'],
            'rooms' => $searchData['rooms'],
            'price'  => $bookingDetails['price'] ?? 'NA',
            'guests' => json_encode($guests) ?? 'NA',
            'guest_address' => json_encode( $query['AddressInfo']),
            'searchData' => json_encode($searchData),
            'bookingDetails' => json_encode($bookingDetails),
            'roomdetails' => json_encode($roomdetails),
            'booking_response_from_api' => json_encode($createbooking) ?? '',
            'query_to_tbo' => json_encode($query) ?? '',
            'email' => $request->email ?? '',
            'phone' => $request->phone ?? ''

        ]);

        return $booking;

    }

    public function formatGuestsForBooking($guests){
       
        $result = [];
        $i = 0 ; 

        foreach($guests as $index => $guest){
         
            $adults  = $guest['adult'];
            $children = isset( $guest['child'] ) ?  $guest['child'] : null ;
           

            foreach($adults as  $adult){
                
                 $result['value'][$i]['attr'] = ["GuestType"=> "Adult", "GuestInRoom" => $adult['room']];

                 if($i == 0 ){
                     $result['value'][$i]['attr'] = ["LeadGuest"=>"true", "GuestType"=> "Adult", "GuestInRoom" => $adult['room']];
                 }

                  $result['value'][$i]['value'] = [
                  "Title" => ["value"=>  $adult['title']],
                  "FirstName" => ["value"=>  $adult['firstname']] ,
                  "LastName" => ["value"=>  $adult['lastname']] ,
                  "Age" => ["value"=>   $adult['age']] 
            ];

                 $i++ ; 
            }

            if( $children !=null ) {
               
                foreach($children as $child){
                     $result['value'][$i]['attr'] = ["GuestType"=> "Child", "GuestInRoom" => $child['room']]; 
                     $result['value'][$i]['value'] = [
                                                    "Title" => ["value"=>  $child['title']],
                                                    "FirstName" => ["value"=>  $child['firstname']] ,
                                                    "LastName" => ["value"=>  $child['lastname']] ,
                                                    "Age" => ["value"=>    $child['age']]
                                                    ];
                                                 $i++ ; 

                }
            }

           
        }

      
        return $result; 
    }

    public function formatHotelRoomsForBooking($roomdetails , $rooms){
        
   
        
        $result = [];
        $seachdata = Session::get('searchData'); 
         

        if($seachdata['rooms'] > 1  ){

           

            foreach($roomdetails as $index => $roomdetail ){

             $result['value'][$index]['value'] =[

                 "RoomIndex" => ["value" => $roomdetail['RoomIndex']],
                                "RoomTypeName" => ["value" => $roomdetail['RoomTypeName']],
                                "RoomTypeCode" => ["value" => $roomdetail['RoomTypeCode']],
                                "RatePlanCode" => ["value" => $roomdetail['RatePlanCode']],
                                "RoomRate"=>[
                                    "attr"=>[
                                        "RoomFare" =>$roomdetail['RoomRate']['RoomFare'],
                                        "Currency" => $roomdetail['RoomRate']['Currency'],
                                        "AgentMarkUp" =>$roomdetail['RoomRate']['AgentMarkUp'],
                                        "RoomTax" => $roomdetail['RoomRate']['RoomTax'],
                                        "TotalFare"=>$roomdetail['RoomRate']['TotalFare']
                                    ]
                                    ]

            ];

             if( isset( $roomdetail['Supplements'] )) {

                 $result['value'][$index]['value']['Supplements']['value'] = [
                                        "SuppInfo"=> ["attr"=>[
                                            "SuppID" => $roomdetail['Supplements'][0]['SuppID'] ?? "",
                                            "SuppChargeType" => $roomdetail['Supplements'][0]['SuppChargeType'] ?? "", 
                                            "Price" => $roomdetail['Supplements'][0]['Price'] ?? "",
                                            "SuppIsSelected" => $roomdetail['Supplements'][0]['SuppIsSelected'] ?? 'false'
                                        ]]
                                        ];
            }


        }

        return $result ;

        }

        
        for($i = 0 ; $i<$rooms; $i++){

         
            $result['value'][$i]['value'] =[

                 "RoomIndex" => ["value" => $roomdetails['RoomIndex']],
                 "RoomTypeName" => ["value" => $roomdetails['RoomTypeName']],
                "RoomTypeCode" => ["value" => $roomdetails['RoomTypeCode']],
                "RatePlanCode" => ["value" => $roomdetails['RatePlanCode']],
                "RoomRate"=>[
                            "attr"=>[
                                "RoomFare" =>$roomdetails['RoomRate']['RoomFare'],
                                "Currency" => $roomdetails['RoomRate']['Currency'],
                                "AgentMarkUp" =>$roomdetails['RoomRate']['AgentMarkUp'],
                                "RoomTax" => $roomdetails['RoomRate']['RoomTax'],
                                "TotalFare"=>$roomdetails['RoomRate']['TotalFare']
                            ]]

            ];

            if( isset( $roomdetails['Supplements'] )) {

               

                 $result['value'][$i]['value']['Supplements']['value']= [
                                        "SuppInfo"=> ["attr"=>[
                                            "SuppID" => $roomdetails['Supplements'][0]['SuppID'] ?? "",
                                            "SuppChargeType" => $roomdetails['Supplements'][0]['SuppChargeType'] ?? "", 
                                            "Price" => $roomdetails['Supplements'][0]['Price'] ?? "",
                                            "SuppIsSelected" => $roomdetails['Supplements'][0]['SuppIsSelected'] ?? 'false'
                                        ]]
                                        ];
            }
        }
       // dd($result); 
        return $result;


    }

    public function paginate($results){

        $hotels = collect($results);
        $pageSize = config('app.hotelsperpage');
        $hotels = CollectionHelper::paginate($hotels, $pageSize);
        return $hotels; 
    }

    public function sorting($type, $value){

        $results = Cache::get(session('cacheNameCity'));

        

        $col = array_column( $results['HotelResult'], "PrefPrice" );

        if( $type == 'price'){
            if( $value == 'PriceAsc'){

                  array_multisort( $col, SORT_ASC, $results['HotelResult'] );
            }
            else{

                array_multisort( $col, SORT_DESC, $results['HotelResult'] );
            }
        }


        if( $type == 'star'){

           

            if($value == 'All'){

                     $results['HotelResult'] = array_filter($results['HotelResult'], function ($var) {
                    return ($var['Rating'] == 'OneStar' || $var['Rating'] == 'TwoStar' || 'Rating'== 'ThreeStar' ||  $var['Rating'] == 'FourStar' || $var['Rating'] == 'FiveStar' || $var['Rating'] == 'SixStar'|| $var['Rating'] == 'SevenStar' );
                });

                $col = array_column( $results['HotelResult'], "Rating" );  
                 array_multisort( $col, SORT_ASC, $results['HotelResult'] );
            }

            if( $value =='FourStarOrMore'){
                
              $results['HotelResult'] = array_filter($results['HotelResult'], function ($var) {
                    return ($var['Rating'] == 'FourStar' || $var['Rating'] == 'FiveStar' || $var['Rating'] == 'SixStar'|| $var['Rating'] == 'SevenStar' );
                });

                $col = array_column( $results['HotelResult'], "Rating" );  
                 array_multisort( $col, SORT_ASC, $results['HotelResult'] );

            }

            if( $value =='ThreeStarOrLess'){
               

                $results['HotelResult']  = array_filter($results['HotelResult'], function ($var) {
                    return ($var['Rating'] == 'ThreeStar' || $var['Rating'] == 'TwoStar' || $var['Rating'] == 'OneStar');
                });

                 $col = array_column( $results['HotelResult'], "Rating" );  
                 array_multisort( $col, SORT_ASC, $results['HotelResult'] );

                
               
            }
        }
      

        return $results; 

    }

    
        
        
    



}
