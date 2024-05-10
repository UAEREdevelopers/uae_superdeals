<?php

namespace App\Helpers;

use SoapClient;
use DOMDocument;
use Debugbar;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;

class TBO
{
    private $xml;

    public function __construct(){
        $this->xml = new DOMDocument("1.0", "UTF-8");
    }
    // copy taken to fix issues 
     private function recursion($key,$value,&$xml_elem){
 
        $value['value'] = (isset($value['value'])) ? $value['value'] : '';
        $attr = (isset($value['attr'])) ? $value['attr'] : null;

        if (is_array($value['value'])) {        

            $xml_bdyreqele = $this->xml->createElement("hot:$key");
            if ($attr) {
                foreach ($attr as $k => $v) {
                    $xml_bdyreqele->setAttribute($k, $v);
                }
            }
            foreach ($value['value'] as $key2 => $value2) {
               
                if($key == 'Guests'){
                   $key2 = 'Guest';
                }

                if($key =='RoomCombination'){
                    $key2 = 'RoomIndex';
                }

                if($key =='HotelRooms'){
                    $key2 = 'HotelRoom';
                }


                $this->recursion($key2,$value2,$xml_bdyreqele);
            }
            $xml_elem->appendChild($xml_bdyreqele);
        } else {
            $xml_bdyreqele = $this->xml->createElement("hot:$key", $value['value']);
            if ($attr) {
                foreach ($attr as $k => $v) {
                    $xml_bdyreqele->setAttribute($k, $v);
                }
            }
            $xml_elem->appendChild($xml_bdyreqele);
        }
    }

    private function recursionSearch($key,$value,&$xml_elem){
        $attr = (isset($value['attr'])) ? $value['attr'] : null;
        $childAge = (isset($value['childAge'])) ? $value['childAge'] : null;
        $value['value'] = (isset($value['value'])) ? $value['value'] : '';
        if (is_array($value['value'])) {
            $xml_bdyreqele = $this->xml->createElement("hot:$key");
            if ($attr) {
                foreach ($attr as $k => $v) {
                    $xml_bdyreqele->setAttribute($k, $v);

                    if($k == 'ChildCount' && $v > 0)
                    {   
                        $this->insertchildElement('ChildAge',$childAge, $xml_bdyreqele); 
                    }
                }
            }
            
            foreach ($value['value'] as $key2 => $value2) {

                if( $key == 'RoomGuests')
            {
                $key2 = 'RoomGuest';
            }

                $this->recursionSearch($key2,$value2,$xml_bdyreqele);
            }
            $xml_elem->appendChild($xml_bdyreqele);
        } else {

            $xml_bdyreqele = $this->xml->createElement("hot:$key", $value['value']);
            if ($attr) {
                foreach ($attr as $k => $v) {
                    $xml_bdyreqele->setAttribute($k, $v);
                    if($k == 'ChildCount' && $v > 0)
                    {                         
                       $this->insertchildElement('ChildAge',$childAge, $xml_bdyreqele);                       
                        
                    }
                }
            }
            $xml_elem->appendChild($xml_bdyreqele);
        }
    }

    private function insertchildElement($key,$value,&$xml_elem){     
           
            $xml_bdyreqele = $this->xml->createElement("hot:$key");   
               
            
            foreach ($value['value'] as $key2 => $value2) {  
                
                $key2 = 'int';
                $value2 = ['value' => $value2 ];
                $this->recursionSearch($key2,$value2,$xml_bdyreqele);

            }

            $xml_elem->appendChild($xml_bdyreqele);
        

    }
    
    private function loadRequest($action,$arr_value){   

        $xml_file_name = $action;
        $username = config('app.tbousername');
        $password  = config('app.tbopassword');
        $url = config('app.tbourl');

        $xml_env = $this->xml->createElement("soap:Envelope");
        $xml_env->setAttribute("xmlns:soap", "http://www.w3.org/2003/05/soap-envelope");
        $xml_env->setAttribute("xmlns:hot", "http://TekTravel/HotelBookingApi");

        /*create header*/
        $xml_hed = $this->xml->createElement("soap:Header");
        $xml_hed->setAttribute("xmlns:wsa", "http://www.w3.org/2005/08/addressing");

        $xml_cred = $this->xml->createElement("hot:Credentials");
        $xml_cred->setAttribute("UserName", $username);
        $xml_cred->setAttribute("Password", $password);
        
        $xml_wsaa = $this->xml->createElement("wsa:Action", "http://TekTravel/HotelBookingApi/$action");
        $xml_wsat = $this->xml->createElement("wsa:To", $url);

        $xml_hed->appendChild($xml_cred);
        $xml_hed->appendChild($xml_wsaa);
        $xml_hed->appendChild($xml_wsat);

        $xml_env->appendChild($xml_hed);

        /*create body*/
        $xml_bdy = $this->xml->createElement("soap:Body");
        $xml_bdyreq= $this->xml->createElement("hot:$action"."Request");

        /* to set request name for available hotel rooms */ 
        if($action=='AvailableHotelRooms'){
             $xml_bdyreq= $this->xml->createElement("hot:HotelRoomAvailability"."Request");
        }
        

        
         if( $action == "HotelSearch"){

             foreach ($arr_value as $key => $value ) {
                    $this->recursionSearch($key,$value,$xml_bdyreq);
             }
         }
         else{

            foreach ($arr_value as $key => $value ) {
                 $this->recursion($key,$value,$xml_bdyreq);  
            }
         }


        $xml_bdy->appendChild($xml_bdyreq);
        $xml_env->appendChild($xml_bdy);

        $this->xml->appendChild($xml_env);
        $request = $this->xml->saveXML();

        File::put(storage_path()."/tbo/request_$xml_file_name.xml", $request);

        
        
        $action = "http://TekTravel/HotelBookingApi/$action";

        $options['keep_alive'] = FALSE;

        $client = new SoapClient("$url?wsdl" , $options);

        $result = $client->__doRequest($request, $url, $action, 2);

        File::put(storage_path()."/tbo/response_$xml_file_name.xml", $result);

        return $result;

    }

    private function loadXML($function, $arr_value = []){
        $this->xml->loadXML($this->loadRequest($function,$arr_value));
    }

    // for fetching countries list

    public function CountryList($arg = []){
        $this->loadXML(__FUNCTION__,$arg);
        $xml_res = $this->xml->getElementsByTagName('Country');
        
        for($i = 0; $i < $xml_res->length; $i++) {

            $output = $xml_res->item($i)->attributes;

            $result[$i][$output->item(0)->name] = $output->item(0)->value;
            $result[$i][$output->item(1)->name] = $output->item(1)->value;
        }

        return $result;
        
    }

    // For Cities list


    public function  DestinationCityList($arg){

        Log::info(print_r($arg, true));
        
        $this->loadXML(__FUNCTION__,$arg);
        $xml_res = $this->xml->getElementsByTagName('City');
        for($i = 0; $i < $xml_res->length; $i++) {

            $output = $xml_res->item($i)->attributes;

            $result[$i][$output->item(0)->name] = $output->item(0)->value;
            $result[$i][$output->item(1)->name] = $output->item(1)->value;
        }

        return $result;

    }

    public function TBOHotelCodes($arg){
         $this->loadXML(__FUNCTION__,$arg);

         $result['status']['statusCode'] = $this->xml->getElementsByTagName('Status')->item(0)->getElementsByTagName('StatusCode')->item(0)->nodeValue;
         $result['status']['statusDesc'] = $this->xml->getElementsByTagName('Status')->item(0)->getElementsByTagName('Description')->item(0)->nodeValue;

        $hotels = $this->xml->getElementsByTagName('Hotel');

         foreach( $hotels as $index => $hotel)

        {   
            $result['hotels'][$index]['HotelCode'] = $hotel->attributes->getNamedItem( 'HotelCode')->value;   
            $result['hotels'][$index]['HotelName'] = $hotel->attributes->getNamedItem( 'HotelName')->value;
            $result['hotels'][$index]['HotelAddress'] = $hotel->attributes->getNamedItem( 'HotelAddress')->value;
            $result['hotels'][$index]['StarRating'] = $hotel->attributes->getNamedItem( 'StarRating')->value;
            $result['hotels'][$index]['Longitude'] = $hotel->attributes->getNamedItem( 'Longitude')->value;
            $result['hotels'][$index]['Latitude'] = $hotel->attributes->getNamedItem( 'Latitude')->value;
            $result['hotels'][$index]['CountryCode'] = $hotel->attributes->getNamedItem( 'CountryCode')->value;
            $result['hotels'][$index]['CityName'] = $hotel->attributes->getNamedItem( 'CityName')->value;
            $result['hotels'][$index]['CountryName'] = $hotel->attributes->getNamedItem( 'CountryName')->value;
        }

        return $result;
    }

    public function HotelDetails($arg){

        $this->loadXML(__FUNCTION__,$arg);

        
         $result['status']['statusCode'] = $this->xml->getElementsByTagName('Status')->item(0)->getElementsByTagName('StatusCode')->item(0)->nodeValue;
         $result['status']['statusDesc'] = $this->xml->getElementsByTagName('Status')->item(0)->getElementsByTagName('Description')->item(0)->nodeValue;

         if($result['status']['statusCode'] == '01' ){

            $details =  $this->xml->getElementsByTagName('HotelDetails');

        $result['hoteldetails']['HotelRating'] = $details->item(0)->attributes->getNamedItem('HotelRating')->value ?? 'NA';
        $result['hoteldetails']['HotelName'] = $details->item(0)->attributes->getNamedItem('HotelName')->value ?? 'NA';
        $result['hoteldetails']['HotelCode'] = $details->item(0)->attributes->getNamedItem('HotelCode')->value ?? 'NA';
        $result['hoteldetails']['Address'] = $details =  $this->xml->getElementsByTagName('Address')->item(0)->nodeValue ?? 'NA';
        $result['hoteldetails']['Description'] = $details =  $this->xml->getElementsByTagName('Description')->item(0)->nodeValue ?? 'NA';
        $result['hoteldetails']['FaxNumber'] = $details =  $this->xml->getElementsByTagName('FaxNumber')->item(0)->nodeValue ?? 'NA';
        $result['hoteldetails']['Map'] = $details =  $this->xml->getElementsByTagName('Map')->item(0)->nodeValue ?? 'NA';
        $result['hoteldetails']['PhoneNumber'] = $details =  $this->xml->getElementsByTagName('PhoneNumber')->item(0)->nodeValue ?? 'NA';
        $result['hoteldetails']['PinCode'] = $details =  $this->xml->getElementsByTagName('PinCode')->item(0)->nodeValue ?? 'NA';
        $result['hoteldetails']['TripAdvisorRating'] = $details =  $this->xml->getElementsByTagName('TripAdvisorRating')->item(0)->nodeValue ?? 'NA';
        $result['hoteldetails']['CityName'] = $details =  $this->xml->getElementsByTagName('CityName')->item(0)->nodeValue ?? 'NA';

        $attractions = $this->xml->getElementsByTagName('Attraction');
        $facilities =  $this->xml->getElementsByTagName('HotelFacility');
        $images = $this->xml->getElementsByTagName('ImageUrl');
        $rooms =  $this->xml->getElementsByTagName('Room');

       

        foreach($attractions as $index => $attraction){
             $result['hoteldetails']['Attractions'][$index] = $attraction->nodeValue;
        }

        foreach($facilities as $index => $facility){
             $result['hoteldetails']['facilities'][$index] = $facility->nodeValue;
        }

        foreach($images as $index => $image){
             $result['hoteldetails']['images'][$index] = $image->nodeValue;
        }

        foreach($rooms as $index => $room){
             $result['hoteldetails']['rooms'][$index]['RoomTypeCode'] = $room->attributes->getNamedItem('RoomTypeCode')->value;
             $result['hoteldetails']['rooms'][$index]['RoomName'] = $room->attributes->getNamedItem('RoomName')->value;
             
             $roomimages = $room->getElementsbyTagName('Image');

             foreach($roomimages as $index2 => $roomimage){                
                $result['hoteldetails']['rooms'][$index]['images'][$index2] =  $roomimage->nodeValue;
             }
        }
        
         }

         


        return $result;


    }

    public function HotelSearch($arg){
        
        $this->loadXML(__FUNCTION__,$arg);

        $result = [];

        $result['status']['statusCode'] = $this->xml->getElementsByTagName('Status')->item(0)->getElementsByTagName('StatusCode')->item(0)->nodeValue;
        $result['status']['statusDesc'] = $this->xml->getElementsByTagName('Status')->item(0)->getElementsByTagName('Description')->item(0)->nodeValue;
        $result['sessionId'] = $this->xml->getElementsByTagName('SessionId')->item(0)->nodeValue;

        // SAVING THE SESSIONID IN SESSION 
        setSessionId($result['sessionId']);

        if ($result['status']['statusCode']  == '01' ){

        $result['NoOfRoomsRequested'] = $this->xml->getElementsByTagName('NoOfRoomsRequested')->item(0)->nodeValue??'NA';
        $result['CityId'] = $this->xml->getElementsByTagName('CityId')->item(0)->nodeValue??'NA';
        $result['CheckInDate'] = $this->xml->getElementsByTagName('CheckInDate')->item(0)->nodeValue??'NA';
        $result['CheckOutDate'] = $this->xml->getElementsByTagName('CheckOutDate')->item(0)->nodeValue??'NA';

        $RoomGuests = $this->xml->getElementsByTagName('RoomGuests');

        foreach( $RoomGuests as $index => $roomguest)
        {   
            $result['RoomGuests'][$index]['ChildCount'] =   $roomguest->getElementsByTagName('RoomGuest')->item(0)->attributes->getNamedItem( 'ChildCount')->value;
            $result['RoomGuests'][$index]['AdultCount'] =   $roomguest->getElementsByTagName('RoomGuest')->item(0)->attributes->getNamedItem( 'ChildCount')->value;
        }

        $HotelResult = $this->xml->getElementsByTagName('HotelResult');

        

        foreach($HotelResult as $index => $hotel)
        {   
            
            $result['HotelResult'][$index]['ResultIndex'] = $hotel->getElementsByTagName('ResultIndex')->item(0)->nodeValue??'NA';
            $result['HotelResult'][$index]['HotelCode'] = $hotel->getElementsByTagName('HotelCode')->item(0)->nodeValue??'NA';
            $result['HotelResult'][$index]['HotelName'] = $hotel->getElementsByTagName('HotelName')->item(0)->nodeValue??'NA';
            $result['HotelResult'][$index]['HotelPicture'] = $hotel->getElementsByTagName('HotelPicture')->item(0)->nodeValue??'NA';
            $result['HotelResult'][$index]['HotelDescription'] = $hotel->getElementsByTagName('HotelDescription')->item(0)->nodeValue ??'NA';
            $result['HotelResult'][$index]['Latitude'] = $hotel->getElementsByTagName('Latitude')->item(0)->nodeValue ??'NA';
            $result['HotelResult'][$index]['Longitude'] = $hotel->getElementsByTagName('Longitude')->item(0)->nodeValue ??'NA'; 
            $result['HotelResult'][$index]['HotelAddress'] = $hotel->getElementsByTagName('HotelAddress')->item(0)->nodeValue ??'NA';
            $result['HotelResult'][$index]['Rating'] = $hotel->getElementsByTagName('Rating')->item(0)->nodeValue ??'NA';
            $result['HotelResult'][$index]['TripAdvisorRating'] = $hotel->getElementsByTagName('TripAdvisorRating')->item(0)->nodeValue ??'NA';
            $result['HotelResult'][$index]['OriginalPrice'] = $hotel->getElementsByTagName('MinHotelPrice')->item(0)->attributes->getNamedItem( 'OriginalPrice')->value ??'NA' ;
            $result['HotelResult'][$index]['B2CRates'] = $hotel->getElementsByTagName('MinHotelPrice')->item(0)->attributes->getNamedItem( 'B2CRates')->value ??'NA' ;
            $result['HotelResult'][$index]['Currency'] = $hotel->getElementsByTagName('MinHotelPrice')->item(0)->attributes->getNamedItem( 'Currency')->value ??'NA';
            $result['HotelResult'][$index]['TotalPrice'] = $hotel->getElementsByTagName('MinHotelPrice')->item(0)->attributes->getNamedItem( 'TotalPrice')->value ??'NA';
            $result['HotelResult'][$index]['PrefCurrency'] = $hotel->getElementsByTagName('MinHotelPrice')->item(0)->attributes->getNamedItem( 'PrefCurrency')->value ??'NA';
            $result['HotelResult'][$index]['PrefPrice'] = $hotel->getElementsByTagName('MinHotelPrice')->item(0)->attributes->getNamedItem( 'PrefPrice')->value ??'NA';
            $result['HotelResult'][$index]['IsPkgProperty'] = $hotel->getElementsByTagName('IsPkgProperty')->item(0)->nodeValue ??'NA';
            $result['HotelResult'][$index]['IsPackageRate'] = $hotel->getElementsByTagName('IsPackageRate')->item(0)->nodeValue ??'NA';
            $result['HotelResult'][$index]['MappedHotel'] = $hotel->getElementsByTagName('MappedHotel')->item(0)->nodeValue ??'NA';
            $result['HotelResult'][$index]['IsHalal'] = $hotel->getElementsByTagName('IsHalal')->item(0)->nodeValue ??'NA';

        }

        }else{
           
            print_r($result); die();
        }
       

        // dd($result);

        return $result;
    }

    public function AvailableHotelRooms($arg){

        $this->loadXML(__FUNCTION__,$arg);
        $result = [];
        
         $result['status']['statusCode'] = $this->xml->getElementsByTagName('Status')->item(0)->getElementsByTagName('StatusCode')->item(0)->nodeValue;
         $result['status']['statusDesc'] = $this->xml->getElementsByTagName('Status')->item(0)->getElementsByTagName('Description')->item(0)->nodeValue;

         if ($result['status']['statusCode']  == '01' ){ 

            $result['ResultIndex'] = $this->xml->getElementsByTagName('ResultIndex')->item(0)->nodeValue;

            $roomdetails= $this->xml->getElementsByTagName('HotelRoom');
            foreach($roomdetails as $index => $room)
            {
                $result['RoomDetails'][$index]['RoomIndex'] = $room->getElementsByTagName('RoomIndex')->item(0)->nodeValue;
                $result['RoomDetails'][$index]['RoomTypeName'] = $room->getElementsByTagName('RoomTypeName')->item(0)->nodeValue;
                $result['RoomDetails'][$index]['Inclusion'] = $room->getElementsByTagName('Inclusion')->item(0)->nodeValue;
                $result['RoomDetails'][$index]['RoomTypeCode'] = $room->getElementsByTagName('RoomTypeCode')->item(0)->nodeValue;
                $result['RoomDetails'][$index]['RatePlanCode'] = $room->getElementsByTagName('RatePlanCode')->item(0)->nodeValue;

                $result['RoomDetails'][$index]['RoomRate']['PrefPrice'] = $room->getElementsByTagName('RoomRate')->item(0)->attributes->getNamedItem( 'PrefPrice')->value ?? 'NA';
                $result['RoomDetails'][$index]['RoomRate']['PrefCurrency'] = $room->getElementsByTagName('RoomRate')->item(0)->attributes->getNamedItem( 'PrefCurrency')->value ?? 'NA';
                $result['RoomDetails'][$index]['RoomRate']['PrefRoomFare'] = $room->getElementsByTagName('RoomRate')->item(0)->attributes->getNamedItem( 'PrefRoomFare')->value  ?? 'NA';
                 $result['RoomDetails'][$index]['RoomRate']['PrefRoomTax'] = $room->getElementsByTagName('RoomRate')->item(0)->attributes->getNamedItem( 'PrefRoomTax')->value ??  'NA';

                $result['RoomDetails'][$index]['RoomRate']['RoomTax'] = $room->getElementsByTagName('RoomRate')->item(0)->attributes->getNamedItem( 'RoomTax')->value;
                $result['RoomDetails'][$index]['RoomRate']['RoomFare'] = $room->getElementsByTagName('RoomRate')->item(0)->attributes->getNamedItem( 'RoomFare')->value;
                $result['RoomDetails'][$index]['RoomRate']['AgentMarkUp'] = $room->getElementsByTagName('RoomRate')->item(0)->attributes->getNamedItem( 'AgentMarkUp')->value;
                $result['RoomDetails'][$index]['RoomRate']['TotalFare'] = $room->getElementsByTagName('RoomRate')->item(0)->attributes->getNamedItem( 'TotalFare')->value;
                $result['RoomDetails'][$index]['RoomRate']['Currency'] = $room->getElementsByTagName('RoomRate')->item(0)->attributes->getNamedItem( 'Currency')->value;
                $result['RoomDetails'][$index]['RoomRate']['IsPackageRate'] = $room->getElementsByTagName('RoomRate')->item(0)->attributes->getNamedItem( 'IsPackageRate')->value;
                $result['RoomDetails'][$index]['RoomRate']['B2CRates'] = $room->getElementsByTagName('RoomRate')->item(0)->attributes->getNamedItem( 'B2CRates')->value;
                $result['RoomDetails'][$index]['RoomRate']['IsInstantConfirmed'] = $room->getElementsByTagName('RoomRate')->item(0)->attributes->getNamedItem( 'IsInstantConfirmed')->value;

                $dayrates = $room->getElementsByTagName('DayRate');
                foreach($dayrates as $index2 => $dayrate)
                {   
                    $result['RoomDetails'][$index]['RoomRate']['DayRates'][$index2]['PrefBaseFare'] = $dayrate->attributes->getNamedItem('BaseFare')->value ?? 'NA';
                    $result['RoomDetails'][$index]['RoomRate']['DayRates'][$index2]['BaseFare'] = $dayrate->attributes->getNamedItem('BaseFare')->value;
                    $result['RoomDetails'][$index]['RoomRate']['DayRates'][$index2]['Date'] = $dayrate->attributes->getNamedItem('Date')->value;
                }

                $result['RoomDetails'][$index]['RoomRate']['ExtraGuestCharges'] = $room->getElementsByTagName('RoomRate')->item(0)->getElementsByTagName('ExtraGuestCharges')->item(0)->nodeValue;
                $result['RoomDetails'][$index]['RoomRate']['ChildCharges'] = $room->getElementsByTagName('RoomRate')->item(0)->getElementsByTagName('ChildCharges')->item(0)->nodeValue;
                $result['RoomDetails'][$index]['RoomRate']['Discount'] = $room->getElementsByTagName('RoomRate')->item(0)->getElementsByTagName('Discount')->item(0)->nodeValue;
                $result['RoomDetails'][$index]['RoomRate']['OtherCharges'] = $room->getElementsByTagName('RoomRate')->item(0)->getElementsByTagName('OtherCharges')->item(0)->nodeValue;
                $result['RoomDetails'][$index]['RoomRate']['ServiceTax'] = $room->getElementsByTagName('RoomRate')->item(0)->getElementsByTagName('ServiceTax')->item(0)->nodeValue;
                $result['RoomDetails'][$index]['RoomPromtion'] = $room->getElementsByTagName('RoomPromtion')->item(0)->nodeValue;

                $suppliments = $room->getElementsByTagName('Supplement');

                foreach($suppliments as $index3 => $suppliment)
                {
                    $result['RoomDetails'][$index]['Supplements'][$index3]['CurrencyCode'] = $suppliment->attributes->getNamedItem('CurrencyCode')->value;
                    $result['RoomDetails'][$index]['Supplements'][$index3]['Price'] = $suppliment->attributes->getNamedItem('Price')->value;
                    $result['RoomDetails'][$index]['Supplements'][$index3]['SuppChargeType'] = $suppliment->attributes->getNamedItem('SuppChargeType')->value;
                    $result['RoomDetails'][$index]['Supplements'][$index3]['SuppIsMandatory'] = $suppliment->attributes->getNamedItem('SuppIsMandatory')->value;
                    $result['RoomDetails'][$index]['Supplements'][$index3]['SuppName'] = $suppliment->attributes->getNamedItem('SuppName')->value;
                    $result['RoomDetails'][$index]['Supplements'][$index3]['SuppID'] = $suppliment->attributes->getNamedItem('SuppID')->value;
                    $result['RoomDetails'][$index]['Supplements'][$index3]['Type'] = $suppliment->attributes->getNamedItem('Type')->value;
                }

                
                 $result['RoomDetails'][$index]['RoomAdditionalInfo']['Description'] = $room->getElementsByTagName('Description')->item(0)->nodeValue ?? 'NA';

                 $images =  $room->getElementsByTagName('URL');

                 foreach($images as $index4 => $image){
                     $result['RoomDetails'][$index]['RoomAdditionalInfo']['images'][$index4] = $image->nodeValue;
                 }
                  $result['RoomDetails'][$index]['CancelPolicies']['LastCancellationDeadline'] = $room->getElementsByTagName('LastCancellationDeadline')->item(0)->nodeValue;
                  $result['RoomDetails'][$index]['CancelPolicies']['CancelPolicy']['Currency'] =  $room->getElementsByTagName('CancelPolicy')->item(0)->attributes->getNamedItem( 'Currency')->value;
                  $result['RoomDetails'][$index]['CancelPolicies']['CancelPolicy']['CancellationCharge'] =  $room->getElementsByTagName('CancelPolicy')->item(0)->attributes->getNamedItem( 'CancellationCharge')->value;
                  $result['RoomDetails'][$index]['CancelPolicies']['CancelPolicy']['ChargeType'] =  $room->getElementsByTagName('CancelPolicy')->item(0)->attributes->getNamedItem( 'ChargeType')->value;
                  $result['RoomDetails'][$index]['CancelPolicies']['CancelPolicy']['ToDate'] =  $room->getElementsByTagName('CancelPolicy')->item(0)->attributes->getNamedItem( 'ToDate')->value;
                  $result['RoomDetails'][$index]['CancelPolicies']['CancelPolicy']['FromDate'] =  $room->getElementsByTagName('CancelPolicy')->item(0)->attributes->getNamedItem( 'FromDate')->value;
                  $result['RoomDetails'][$index]['CancelPolicies']['CancelPolicy']['RoomTypeName'] =  $room->getElementsByTagName('CancelPolicy')->item(0)->attributes->getNamedItem( 'RoomTypeName')->value;
                  $result['RoomDetails'][$index]['CancelPolicies']['DefaultPolicy'] = $room->getElementsByTagName('DefaultPolicy')->item(0)->nodeValue;

                  $result['RoomDetails'][$index]['Amenities'] = $room->getElementsByTagName('Amenities')->item(0)->nodeValue;
                  $result['RoomDetails'][$index]['MealType'] = $room->getElementsByTagName('MealType')->item(0)->nodeValue;                 
                
            }
            $combinations = $this->xml->getElementsByTagName('RoomCombination') ?? null ; 

                  if( $combinations !=null ){
                      foreach($combinations as $index5 => $combination){
                          Log::info('index5:'.$index5);
                          $roomindex = $combination->getElementsByTagName('RoomIndex');
                            foreach( $roomindex as $index6 => $roomindexvalue){
                                 Log::info('index6:'.$index6);
                                 Log::info('value:'.$roomindexvalue->nodeValue);
                                $result['combinations'][$index5][] = $roomindexvalue->nodeValue;
                            }
                        
                      }
                     
                  }

         }

         return $result;
        

       
    }

    public function HotelCancellationPolicy($arg){
        $this->loadXML(__FUNCTION__,$arg);

        
         $result['status']['statusCode'] = $this->xml->getElementsByTagName('Status')->item(0)->getElementsByTagName('StatusCode')->item(0)->nodeValue;
         $result['status']['statusDesc'] = $this->xml->getElementsByTagName('Status')->item(0)->getElementsByTagName('Description')->item(0)->nodeValue;

        

        dd($result);

    }

    public function AvailabilityAndPricing($arg){
        $this->loadXML(__FUNCTION__,$arg);
        $result = [];

        $result['status']['statusCode'] = $this->xml->getElementsByTagName('Status')->item(0)->getElementsByTagName('StatusCode')->item(0)->nodeValue;
        $result['status']['statusDesc'] = $this->xml->getElementsByTagName('Status')->item(0)->getElementsByTagName('Description')->item(0)->nodeValue;

        if ($result['status']['statusCode']  == '01' ){ 
        
            $result['ResultIndex'] = $this->xml->getElementsByTagName('ResultIndex')->item(0)->nodeValue;
            $result['AvailableForBook'] = $this->xml->getElementsByTagName('AvailableForBook')->item(0)->nodeValue;
            $result['AvailableForConfirmBook'] = $this->xml->getElementsByTagName('AvailableForConfirmBook')->item(0)->nodeValue;
            $result['CancellationPoliciesAvailable'] = $this->xml->getElementsByTagName('CancellationPoliciesAvailable')->item(0)->nodeValue;
            $result['PriceVerification']['AvailableOnNewPrice'] = $this->xml->getElementsByTagName('PriceVerification')->item(0)->attributes->getNamedItem( 'AvailableOnNewPrice')->value;
            $result['PriceVerification']['Status'] = $this->xml->getElementsByTagName('PriceVerification')->item(0)->attributes->getNamedItem( 'Status')->value;
            $result['PriceVerification']['PriceChanged'] = $this->xml->getElementsByTagName('PriceVerification')->item(0)->attributes->getNamedItem( 'PriceChanged')->value;
            $result['PriceVerification']['Status'] = $this->xml->getElementsByTagName('PriceVerification')->item(0)->attributes->getNamedItem( 'Status')->value;
            $result['AccountInfo']['AgencyBlocked'] = $this->xml->getElementsByTagName('AccountInfo')->item(0)->attributes->getNamedItem( 'AgencyBlocked')->value;
            $result['AccountInfo ']['AgencyBalance'] = $this->xml->getElementsByTagName('AccountInfo')->item(0)->attributes->getNamedItem( 'AgencyBalance')->value;
            $result['HotelDetailsVerification']['Status'] = $this->xml->getElementsByTagName('HotelDetailsVerification')->item(0)->attributes->getNamedItem( 'Status')->value;
            $result['HotelDetailsVerification']['Remarks'] = $this->xml->getElementsByTagName('HotelDetailsVerification')->item(0)->attributes->getNamedItem( 'Remarks')->value;
            $result['IsFlightDetailsMandatory'] = $this->xml->getElementsByTagName('IsFlightDetailsMandatory')->item(0)->nodeValue;
            $result['HotelDetails']['HotelRating'] = $this->xml->getElementsByTagName('HotelDetails')->item(0)->attributes->getNamedItem( 'HotelRating')->value;
            $result['HotelDetails']['HotelName'] = $this->xml->getElementsByTagName('HotelDetails')->item(0)->attributes->getNamedItem( 'HotelName')->value;
            $result['Address'] = $this->xml->getElementsByTagName('Address')->item(0)->nodeValue;
            $result['Map'] = $this->xml->getElementsByTagName('Map')->item(0)->nodeValue;

            $result['CancelPolicies']['LastCancellationDeadline'] = $this->xml->getElementsByTagName('LastCancellationDeadline')->item(0)->nodeValue;
            $result['CancelPolicies']['AutoCancellationText'] = $this->xml->getElementsByTagName('AutoCancellationText')->item(0)->nodeValue;
            $result['CancelPolicies']['DefaultPolicy'] = $this->xml->getElementsByTagName('DefaultPolicy')->item(0)->nodeValue;

            $cancelpolicies = $hotelnorms = $this->xml->getElementsByTagName('CancelPolicy');
            foreach($cancelpolicies as $index2 => $policy){

                 $result['CancelPolicies']['CancelPolicy'][$index2]['Currency'] = $policy->attributes->getNamedItem( 'Currency')->value;
                  $result['CancelPolicies']['CancelPolicy'][$index2]['CancellationCharge'] = $policy->attributes->getNamedItem( 'CancellationCharge')->value;
                  $result['CancelPolicies']['CancelPolicy'][$index2]['ChargeType']= $policy->attributes->getNamedItem( 'ChargeType')->value;
                  $result['CancelPolicies']['CancelPolicy'][$index2]['ToDate'] = $policy->attributes->getNamedItem( 'ToDate')->value;
                  $result['CancelPolicies']['CancelPolicy'][$index2]['FromDate'] = $policy->attributes->getNamedItem( 'FromDate')->value;

            }

            $hotelnorms = $this->xml->getElementsByTagName('string');
            foreach($hotelnorms as $index => $norm){
                $result['HotelNorms'][$index] = $norm->nodeValue;
            }



        }
         
        return $result;

    }

    public function HotelBook($arg){

        $this->loadXML(__FUNCTION__,$arg);
        $result = [];
        
         $result['status']['statusCode'] = $this->xml->getElementsByTagName('Status')->item(0)->getElementsByTagName('StatusCode')->item(0)->nodeValue;
         $result['status']['statusDesc'] = $this->xml->getElementsByTagName('Status')->item(0)->getElementsByTagName('Description')->item(0)->nodeValue;

         if ($result['status']['statusCode']  == '01' ){ 

        $result['BookingStatus'] = $this->xml->getElementsByTagName('BookingStatus')->item(0)->nodeValue;
        $result['BookingId'] = $this->xml->getElementsByTagName('BookingId')->item(0)->nodeValue;
        $result['ConfirmationNo'] = $this->xml->getElementsByTagName('ConfirmationNo')->item(0)->nodeValue;
        $result['TripId'] = $this->xml->getElementsByTagName('TripId')->item(0)->nodeValue;
        $result['PriceChange']['AvailableOnNewPrice'] = $this->xml->getElementsByTagName('PriceChange')->item(0)->attributes->getNamedItem( 'AvailableOnNewPrice')->value;
        $result['PriceChange']['Status'] = $this->xml->getElementsByTagName('PriceChange')->item(0)->attributes->getNamedItem( 'Status')->value;
        
        }

        return $result;
    }

    public function  GenerateInvoice($arg){   
        $this->loadXML(__FUNCTION__,$arg);

        $result['status']['statusCode'] = $this->xml->getElementsByTagName('Status')->item(0)->getElementsByTagName('StatusCode')->item(0)->nodeValue;
         $result['status']['statusDesc'] = $this->xml->getElementsByTagName('Status')->item(0)->getElementsByTagName('Description')->item(0)->nodeValue;

         if ($result['status']['statusCode']  == '01' ){  
        $result['InvoiceNo'] = $this->xml->getElementsByTagName('InvoiceNo')->item(0)->nodeValue;
        
        }    

        return $result; 
    }

    public function HotelBookingDetail($arg){

        $this->loadXML(__FUNCTION__,$arg);
          $result = [];
        
         $result['status']['statusCode'] = $this->xml->getElementsByTagName('Status')->item(0)->getElementsByTagName('StatusCode')->item(0)->nodeValue;
         $result['status']['statusDesc'] = $this->xml->getElementsByTagName('Status')->item(0)->getElementsByTagName('Description')->item(0)->nodeValue;

         if ($result['status']['statusCode']  == '01' ){ 
                
         }

         return $result ;
       
    }

    public function HotelBookingDetailBasedOnDate($arg){

    }

    public function HotelCancel($arg){

    }

    public function Amendment($arg){

    }




}