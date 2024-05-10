<?php

namespace App\Jobs;

use App\Helpers\TBO;
use Illuminate\Bus\Queueable;
use App\Models\TboHotelDetail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class SaveTboHotelDetails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, IsMonitored;

    public $tries = 3;
    
    public $timeout = 3600;

    private $hotelcode;

    private $hoteldetails;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($hotelcode)
    {
        $this->hotelcode = $hotelcode;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   
         $new = new TBO();
        $query = ["HotelCode"=>["value"=>  $this->hotelcode ]];
        $this->hoteldetails = $new->HotelDetails($query);

         if($this->hoteldetails['status']['statusCode'] == '01'){

            $details = TboHotelDetail::firstOrNew(['HotelCode' => $this->hoteldetails['hoteldetails']['HotelCode']],
            [
                'HotelRating' => isset($this->hoteldetails['hoteldetails']['HotelRating']  ) ?  $this->hoteldetails['hoteldetails']['HotelRating'] : 'NA',
                'HotelName'  => isset($this->hoteldetails['hoteldetails']['HotelName']  ) ?  $this->hoteldetails['hoteldetails']['HotelName'] : 'NA',
                'Address' => isset($this->hoteldetails['hoteldetails']['Address']  ) ?  $this->hoteldetails['hoteldetails']['Address'] : 'NA',
                'Description' => isset($this->hoteldetails['hoteldetails']['Description']  ) ?  $this->hoteldetails['hoteldetails']['Description'] : 'NA',
                'FaxNumber' => isset($this->hoteldetails['hoteldetails']['FaxNumber']  ) ?  $this->hoteldetails['hoteldetails']['FaxNumber'] : 'NA',
                'Map' => isset($this->hoteldetails['hoteldetails']['Map']  ) ?  $this->hoteldetails['hoteldetails']['Map'] : 'NA',
                'PhoneNumber' => isset($this->hoteldetails['hoteldetails']['PhoneNumber']  ) ?  $this->hoteldetails['hoteldetails']['PhoneNumber'] : 'NA',
                'PinCode' => isset($this->hoteldetails['hoteldetails']['PinCode']  ) ?  $this->hoteldetails['hoteldetails']['PinCode'] : 'NA',
                'TripAdvisorRating' => isset($this->hoteldetails['hoteldetails']['TripAdvisorRating']  ) ?  $this->hoteldetails['hoteldetails']['TripAdvisorRating'] : 'NA',
                'CityName' => isset($this->hoteldetails['hoteldetails']['CityName']  ) ?  $this->hoteldetails['hoteldetails']['CityName'] : 'NA',
                'Attractions' => isset($this->hoteldetails['hoteldetails']['Attractions']) ?  json_encode($this->hoteldetails['hoteldetails']['Attractions']) : 'NA',
                'facilities' =>  isset($this->hoteldetails['hoteldetails']['facilities']) ?  json_encode($this->hoteldetails['hoteldetails']['facilities']) : 'NA',
                'images' => isset($this->hoteldetails['hoteldetails']['images']) ?  json_encode($this->hoteldetails['hoteldetails']['images']) : 'NA',
                'rooms' => isset($this->hoteldetails['hoteldetails']['rooms']) ?  json_encode($this->hoteldetails['hoteldetails']['rooms']) : 'NA',
            ]);

            $details->save();
        }
    }
}
