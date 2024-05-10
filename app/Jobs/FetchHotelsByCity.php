<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Jobs\FetchSingleHotelInfo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class FetchHotelsByCity implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, IsMonitored  ;

    private $city;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($city)
    {
        $this->city = $city;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   
        Log::info('started for City '.$this->city->CityId);
        

         $response = Http::withHeaders([
        'accept' => 'application/json',
        'accept-Encoding' => 'gzip',
        'userName' => 'SuperDeal',
        'password' => 'superde@!@o6o7z!'
            ])->post('https://services.xconnect.in/XCon_Service/APIOut/StaticData/1/GetHInfo', [
       'CityId' => $this->city->CityId,
       'HCode' => 'ALL'
      ]);

       $hotels = json_decode($response->getBody(), true);

       foreach($hotels as $hotel)
    {
        
        
        FetchSingleHotelInfo::dispatch($hotel, $this->city->CityId);        
        
        
    }


     Log::info('Finished for City '.$this->city->CityId);


    }
}
