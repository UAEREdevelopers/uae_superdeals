<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Models\HotelRack\City;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use romanzipp\QueueMonitor\Traits\IsMonitored;
use Illuminate\Support\Facades\Http;

class FetchCitiesByCountry implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, IsMonitored;

      public $tries = 3;

      private $country; 

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($country)
    {
        $this->country = $country; 
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Log::info('started for country '.$this->country->CountryId);
        
        $response = Http::withHeaders([
        'accept' => 'application/json',
        'accept-Encoding' => 'gzip',
        'userName' => 'SuperDeal',
        'password' => 'superde@!@o6o7z!'
    ])->post('https://services.xconnect.in/XCon_Service/APIOut/StaticData/1/GetCityList', [
       'CountryId' => $this->country->CountryId
      ]);

      $cities = json_decode($response->getBody(), true);

      foreach($cities as $city)
      {   
          Log::info('Saving city: '. $city['CityId']);

          City::firstOrCreate(['CityId' => $city['CityId'] , 'City' => $city['City']],['CountryId' => $this->country->CountryId ]);

          Log::info('Saving city: '. $city['CityId']);
      }

       Log::info('Finished for country '.$this->country->CountryId);
    }
}
