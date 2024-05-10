<?php

namespace App\Jobs;

use App\Models\TboCity;
use App\Jobs\SaveTboCity;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class SaveTboCities implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, IsMonitored ;

     public $tries = 3;

      public $timeout = 3600;

     private $cities;
     private $country;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($cities, $country)
    {
        $this->cities = $cities;
        $this->country = $country;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach($this->cities as $city){

            SaveTbocity::dispatch($city, $this->country);

        // Log::info('started for city '.$city['CityName']);

        // TboCity::firstOrCreate(['CityCode' => $city['CityCode']],['CityName' => $city['CityName']]);
        
        // Log::info('started for hotel '.$city['CityName']);
            
        }
    }
}
