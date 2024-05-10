<?php

namespace App\Jobs;

use App\Models\TboCity;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class SaveTboCity implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, IsMonitored ;

     public $tries = 3;

     private $city;
     private $country;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($city, $country)
    {
        $this->city = $city;
        $this->country = $country;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {       
        Log::info('started for city '.$this->city['CityName']);

        TboCity::firstOrCreate(['CityCode' => $this->city['CityCode']],['CityName' => $this->city['CityName'] , 'CountryCode' => $this->country->CountryCode, 'CountryName' =>$this->country->CountryName  ]);
        
        Log::info('Finished for city '.$this->city['CityName']);
        
    }
}
