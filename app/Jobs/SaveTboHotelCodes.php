<?php

namespace App\Jobs;

use App\Helpers\TBO;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class SaveTboHotelCodes implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, IsMonitored ;

    public $tries = 3;
    
    public $timeout = 3600;

    private $hotels;

    private $cityCode; 
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($cityCode)
    {
        $this->cityCode = $cityCode;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

      

        $new = new TBO();
        $query = ["CityCode"=>["value"=>"$this->cityCode"], "IsDetailedResponse"  =>["value" => "false"]];
        $hotelcodes = $new->TBOHotelCodes($query);

        if($hotelcodes['status']['statusCode'] == '01'  &&  $hotelcodes['status']['statusDesc'] == 'Successful: TBOHotelCodeList Successful' ){

            $this->hotels = $hotelcodes['hotels'];              
            }

        foreach($this->hotels as $hotel){
            SaveTboHotelCode::dispatch($hotel);
        }
    }
}
