<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\RoomInquiry;
use Illuminate\Http\Request;
use App\Models\HotelRack\City;
use App\Models\HotelRack\Country;
use Illuminate\Support\Collection;
use App\Models\HotelRack\HotelInfo;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Mail\NewHotelInterestReceived;
use Illuminate\Support\Facades\Session;

use App\Helpers\General\CollectionHelper;
use Illuminate\Pagination\LengthAwarePaginator;

class HotelRackController extends Controller
{   

    private $cacheNameCity; 
    private $cacheNameHotel; 

    public static $header = [
        'accept' => 'application/json',
        'accept-Encoding' => 'gzip',
        'userName' => 'SuperDeal',
        'password' => 'superde@!@o6o7z!'
    ];

     public function __construct()
    {
        $this->cacheNameCity = session('cacheNameCity') ;
    }
    public function GetCountryList()



    {

    $response = Http::withHeaders([
        'accept' => 'application/json',
        'accept-Encoding' => 'gzip',
        'userName' => 'SuperDeal',
        'password' => 'superde@!@o6o7z!'
    ])->post('https://services.xconnect.in/XCon_Service/APIOut/StaticData/1/GetCountryList', [
       'code' => ''
      ]);
      
      $countries = json_decode($response->getBody(), true);
      
      
      foreach($countries as $country)
      { 
        Country::firstOrCreate(['CountryId' => $country['CountryId']],['Country' => $country['Country'], 'ISOCode' => $country['ISOCode']]);
      }

      return 'success';

    }


    public function GetCityList()
    {
        $countries = Country::all();
        foreach($countries as $country)
        {
            $response = Http::withHeaders([
        'accept' => 'application/json',
        'accept-Encoding' => 'gzip',
        'userName' => 'SuperDeal',
        'password' => 'superde@!@o6o7z!'
    ])->post('https://services.xconnect.in/XCon_Service/APIOut/StaticData/1/GetCityList', [
       'CountryId' => $country->CountryId
      ]);

      $cities = json_decode($response->getBody(), true);

      foreach($cities as $city)
      {
          City::firstOrCreate(['CityId' => $city['CityId'] , 'City' => $city['City']],['CountryId' => $country->CountryId ]);
      }
       }

        return 'success';
        

    }

    public function GetHInfo()
    {
        $cities = City::all();
        foreach($cities as $city)
        {

            // if(!HotelInof::where('CityId' , $city->CityId)->exists())

          
            // {
                $response = Http::withHeaders([
        'accept' => 'application/json',
        'accept-Encoding' => 'gzip',
        'userName' => 'SuperDeal',
        'password' => 'superde@!@o6o7z!'
            ])->post('https://services.xconnect.in/XCon_Service/APIOut/StaticData/1/GetHInfo', [
       'CityId' => $city->CityId,
       'HCode' => 'ALL'
      ]);

      $hotels = json_decode($response->getBody(), true);
    foreach($hotels as $hotel)
    {       
        HotelInfo::firstOrCreate(['HCode' => $hotel['HCode']],[
          'HName' => $hotel['HName'] ?? 'NA',
          'Address' => $hotel['Address'] ?? 'NA',
          'city'=> $hotel['City'] ?? 'NA',
          'Country'=> $hotel['Country'] ?? 'NA',
          'Image'=> $hotel['Image'] ?? 'NA',
          'Location'=> 'NA',
          'Description'=>'NA',
        'Latitude'=> $hotel['Latitude'] ?? 'NA', 
        'Longitude'=> $hotel['Longitude'] ?? 'NA',
        'StarRating'=> $hotel['StarRating'] ?? 'NA',
        'CityId' => $city->CityId
      ]);
    }
            // }
            
      
        }

        return 'success';
    }

    public function HSearchByCity($searchData)
    {
        
        if(Session::has('cacheNameCity'))
        {
            if(Cache::has(session('cacheNameCity')))
                {  
           
                    $hotels = Cache::get(session('cacheNameCity')); 

                    return $hotels;
                 }

        }
        
        // dd($searchData);
        
        $response = Http::withHeaders([
        'accept' => 'application/json',
        'accept-Encoding' => 'gzip',
        'userName' => 'SuperDeal',
        'password' => 'superde@!@o6o7z!'
            ])->post('https://services.xconnect.in/XCon_Service/APIOut/Availability/1/HSearchByCity', [
       'CityId' => $searchData['cityId'],
       'NationalityId' => '1',
       'CheckInDate' => $searchData['CheckInDate'],
       'CheckOutDate' => $searchData['CheckOutDate'],
       'RoomDetail'=> [[
           'RoomSrNo' =>1,
           'NoOfAdult' =>$searchData['adults'],
           'NoOfChild' =>$searchData['children'],
           'ChildAges' => $searchData['children_age']

       ]]
      ]);


        $hotels = json_decode($response->getBody(), true);

        $this->cacheNameCity = $searchData['cityId'].$searchData['CheckInDate'].$searchData['CheckOutDate'].$searchData['adults'].$searchData['children'];
        
        // Caching the query to faster processing and avoiding API calls for all request

        Cache::put($this->cacheNameCity, $hotels);

        //  Saving cache name to session
        
        Session::put('cacheNameCity', $this->cacheNameCity);
        return $hotels;
    }


    public function HSearchByHotelCode($HCode)
    {
        
        // if Search Parameters not found in Session return back to search page
        if(!Session::has('searchData'))
        {
            return 'No Details found. Please try again';
        }

        // if(Session::has('cacheNameHotel'))
        // { 
        //     if(Cache::has(session('cacheNameHotel')))
        //     {  
        //         $hoteldetails = Cache::get(session('cacheNameHotel')); 
               
        //          Session::put('TokenId', $hoteldetails['TokenId']);
                 
        //         return $hoteldetails;
        //     }
        // }

        
        $searchData = Session::get('searchData');

        // Api request
        $response = Http::withHeaders([
        'accept' => 'application/json',
        'accept-Encoding' => 'gzip',
        'userName' => 'SuperDeal',
        'password' => 'superde@!@o6o7z!'
            ])->post('https://services.xconnect.in/XCon_Service/APIOut/Availability/1/HSearchByHotelCode', [
       'CityId' => $searchData['cityId'],
       'NationalityId' => $searchData['NationalityId'],   
       'CheckInDate' => $searchData['CheckInDate'],
       'CheckOutDate' => $searchData['CheckOutDate'],
        'HCode' => $HCode,
       'RoomDetail'=> [[
           'RoomSrNo' =>1,
           'NoOfAdult' =>$searchData['adults'],
           'NoOfChild' =>$searchData['children'],
           'ChildAges' => $searchData['children_age']

       ]]
      ]);

    $hoteldetails = json_decode($response->getBody(), true);
    
    if(isset($hoteldetails['Error_Code']))
    {
        return $hoteldetails;
    }

    //    $this->cacheNameHotel = $HCode.$searchData['cityId'].$searchData['CheckInDate'].$searchData['CheckOutDate'].$searchData['adults'].$searchData['children'];

       // Caching the query to faster processing and avoiding API calls for all request

        // Cache::put($this->cacheNameHotel, $hoteldetails);

        //  Saving cache name to session
        
        // Session::put('cacheNameHotel', $this->cacheNameHotel);
       
        Session::put('TokenId', $hoteldetails['TokenId']);
             

      return $hoteldetails;
       
    }


    public function HPreBooking($details, $hcode)
    {   
        $result = [];
        
        $searchData = Session::get('searchData');

        //  dd(Session::get('TokenId'));

        //  dd($searchData , $details['TokenId'], $hcode);
         // Api request

        foreach($details['Hotels'][0]['RateDetails'] as $room)
        {

        $response = Http::withHeaders([
        'accept' => 'application/json',
        'accept-Encoding' => 'gzip',
        'userName' => 'SuperDeal',
        'password' => 'superde@!@o6o7z!'
            ])->post('https://services.xconnect.in/XCon_Service/APIOut/Availability/1/HPreBooking', [
       'CityId' => $searchData['cityId'],
       'NationalityId' => $searchData['NationalityId'],      
       'CheckInDate' => $searchData['CheckInDate'],
       'CheckOutDate' => $searchData['CheckOutDate'],
        'HCode' => $hcode,
        'TokenId' => Session::get('TokenId'),
        'HKey' => $room['HKey'],
       'RoomDetail'=> [[
           'RoomSrNo' =>1,
           'NoOfAdult' =>$searchData['adults'],
           'NoOfChild' =>$searchData['children'],
           'ChildAges' => $searchData['children_age'],
           'RateKey' =>  $room['RateKey'] 

       ]]
      ]);

      
      $result[] = json_decode($response->getBody(), true); 

        }

       
        return $result;
        

    }

    // for returning ajax search result to homepage search

    public function homepagesearch(Request $request)
    {
        $data = [];
        $result= HotelInfo::select('HNAme','city')->where('HName', 'LIKE', $request->q.'%')
                                            ->orWhere('city', 'LIKE', $request->q.'%')
                                            ->take(25)->get();
        foreach($result as $hotel)
        {
            $data[] = $hotel->HNAme.', '.$hotel->city;
            if(!in_array($hotel->city, $data))
            {
                  $data[] = $hotel->city;
            }
           
        }
     
        return response()->json($data);
    }

    //  processing homepage hotel search
    public function homepagesearchSubmit(Request $request)
    {   
        $cityId = '';
        $is_city  = false;
         $results = null;

        $dates = explode('to' , $request->dates);
       
        //  finding all hotels in selected hotel's City
        $children_age = [];

        if($request->children > 0 )
        {
            for($i=1;$i<$request->children+1;$i++)
            {
                $children_age[] = rand(3,11);
            }
        }




        // to find if selected value is hotel or city - if true then its city

        if(strpos($request->hotel , ',') == false ){
            $is_city  = true;
            $cityId = City::where('City', trim($request->hotel))->firstorfail();
            
        }

         // SEARCHED FOR HOTEL
        if(strpos($request->hotel , ',') !== false ){

            $Search_hotel = explode(',',$request->hotel); 
            $cityId = HotelInfo::where('HName',trim($Search_hotel[0]))->firstorfail();
        }

        

        

        $searchData = [

            'cityId' => $cityId->CityId,
            'NationalityId' => $request->nationality,
            'CheckInDate' =>  Carbon::parse(trim($dates[0]))->format('Y-m-d'),
            'CheckOutDate' => Carbon::parse(trim($dates[1]))->format('Y-m-d'),
            'adults' => $request->adult ,
            'children' => $request->children,
            'children_age' => $children_age

        ];

        // dd( $searchData);

        // Saving search criteria to session
     
        Session::put('searchData' ,  $searchData);

        // Search for hotel
        if( $is_city == false){         
 
        
        $hotel = HotelInfo::where('HCode', $cityId->HCode)->firstorfail();

       
        $result = $this->HSearchByHotelCode($hotel->HCode) ;

        if(isset($result['Error_Code']))
        {
            echo "Something went wrong";
            die();
        }
        $hotelrooms = $result['Hotels'][0]['RateDetails'];   

        // $prebook = $this->HPreBooking($result , $hotel->HCode );

              

        //   if errors
        
    //     if( isset($prebook[0]['Error_Code']))
    //     {   
    //         $searchData = Session::get('searchData');

    //         $data['HSearchByHotelCode_response'] = $result;

    //         $data['HPreBooking_request'] = [
    //              'CityId' => $searchData['cityId'],
    //              'NationalityId' => $searchData['NationalityId'],      
    //    'CheckInDate' => $searchData['CheckInDate'],
    //    'CheckOutDate' => $searchData['CheckOutDate'],
    //      'HCode' => $hotel->HCode,
    //     'TokenId' => Session::get('TokenId'),
    //     'HKey' => '',
    //    'RoomDetail'=> [[
    //        'RoomSrNo' =>1,
    //        'NoOfAdult' =>$searchData['adults'],
    //        'NoOfChild' =>$searchData['children'],
    //        'ChildAges' => $searchData['children_age'],
    //        'RateKey' =>  ''

    //         ]]];

    //         $data['error'] =  $prebook[0];  
    //         return $data;
    //      }

    $countries  = Country::all();

         return view('frontend.hotel_detail_before_prebook')->with(compact(['hotel', 'hotelrooms','countries'] ));
        return view('frontend.hotel_detail')->with(compact(['prebook', 'hotel'] ));
        

        
        }



        if( $is_city == true){

            $results = $this->HSearchByCity($searchData);

            //  if error message, sending back with error.

        if(isset($results['Error_Code']))
        {   
            // Remove cached result to get new result on next search

            Cache::forget($this->cacheNameCity);

            return $results['Error_Msg'] ?? $results['Error_Code'];
            
        }


        // return $results;

        $hotels = [];

        $hotelIds = explode(',',implode(',', array_map(function($a) { return $a['HCode']; }, $results['Hotels'])));
       
        // return $hotelIds;
        
        $hotels = HotelInfo::select(['id','HCode','HName','Address','city','country','Image','StarRating','CityId'])
                       ->whereIn('HCode', $hotelIds)->get();

        // return $hotels;
        
        foreach($results['Hotels'] as $result)
        {   
            foreach($hotels as $hotel)
            {
                if($hotel->HCode == $result['HCode'])
                {
                    $hotel->price =   $this->getAmountWithCommission($result['Amount']); // round( $result['Amount'] +  (config('app.commissionpercentage') /100) * ($result['Amount']) , 0) ; // Adding commission percentage
                    $hotel->available =  $result['Available'];
                }
            }         
        }
        
        // return $hotels;
        $pageSize = 50;

        $hotels = CollectionHelper::paginate($hotels, $pageSize); 

        $currency = 'AED';
        
        $countries = Country::all();

         return view('frontend.hotel_results_list_view')->with(compact(['hotels' , 'currency', 'countries']));


        }

        
    }


    public function prepareListView($results)

    {
        $hotels = [];
        $hotelIds = explode(',',implode(',', array_map(function($a) { return $a['HCode']; }, $results['Hotels'])));
        
        $hotels = HotelInfo::select(['id','HCode','HName','Address','city','country','Image','StarRating','CityId'])
                       ->whereIn('HCode', $hotelIds)->get();
        
        foreach($hotels as $hotel)
        {
            $hotel->price = isset( $results['Hotels'][$hotel->HCode] ) ? $results['Hotels'][$hotel->HCode]  : 'NA';
            $hotel->available =  isset( $results['Hotels'][$hotel->available] ) ? $results['Hotels'][$hotel->available] : 'NA' ;
        }



        $currency = 'AED';
         $data = $this->paginate($hotels);

         dd($data);

        return view('frontend.hotel_results_list_view')->with(compact('hotels' , 'currency'));
        
    }


    public function HotelDetailView(Request $request , $id)
    {
         

        $hotel = HotelInfo::with('images')->where('HCode', $id)->firstorfail();

       
        $result = $this->HSearchByHotelCode($hotel->HCode) ;
       

        // $prebook = $this->HPreBooking($result , $hotel->HCode );

         $hotelrooms = $result['Hotels'][0]['RateDetails'];       

        //   return  $prebook ;
        
        // if( isset($prebook[0]['Error_Code']))
        // {
        //     $data['tokenId_passed'] = Session::get('TokenId');
        //     $data['searchDetails'] = Session::get('searchData');
        //     $data['error'] =  $prebook[0];

        //     return $data;
        //  }

        $countries  = Country::all();

        return view('frontend.hotel_detail_before_prebook')->with(compact(['hotel', 'hotelrooms','countries' ] ));

        // to show with prebook
        return view('frontend.hotel_detail')->with(compact(['prebook', 'hotel'] ));
    }

    public function hotelSearchResult($id)
    {   

        
        $hotel = HotelInfo::where('HCode', $id)->firstorfail();

       
        $result = $this->HSearchByHotelCode($hotel->HCode) ;     
       

         $prebook = $this->HPreBooking($result , $hotel->HCode );

        // $hotelrooms = $result['Hotels'][0]['RateDetails'];       

        //   return  $prebook ;
        
        if( isset($prebook[0]['Error_Code']))
        {
            $data['tokenId_passed'] = Session::get('TokenId');
            $data['searchDetails'] = Session::get('searchData');
            $data['error'] =  $prebook[0];

            return $data;
         }

         dd($prebook);
        return view('frontend.hotel_detail')->with(compact(['prebook', 'hotel'] ));
    }



    public function submitInterest(Request $request)
    {
        
        $details['hotel_id'] = $request->hotelcode;
        $details['hotel_name'] = $request->hotelname;
        $details['city'] = $request->city;
        $details['room_details'] = $request->roomdetails;
        $details['no_of_rooms'] = $request->no_of_rooms_selected;
        $details['booking_details'] = session('searchData') ?? 'NA';
        $details['price_offered'] = $request->price;
        
        $interest = RoomInquiry::create([
            'api_type' => 'hotelrack',
            'details' => json_encode($details),
            'name' => $request->name,
            'phone' =>$request->phone,
            'email' => $request->email,
            'request' => $request->specialrequest,
            'status'  => 'pending'
        ]);

        Mail::to('shafi.uaere@gmail.com')->queue(new NewHotelInterestReceived($interest));
        Mail::to('bookings@superdeals.ae')->queue(new NewHotelInterestReceived($interest));
        
        session::flash('success', 'Thank you for your interest');
        return back();
    }

    public function getAmountWithCommission($value)
    {
        $percentage =  config('app.commissionpercentage')/100;

        $commission = $value + $commission;

        $amount = $value + $commission;

        return $amount; 
    }


}
