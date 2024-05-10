<?php

namespace App\Jobs;

use App\Models\TboHotelCode;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class SaveTboHotelCode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, IsMonitored ;

    public $tries = 3;
    
    public $timeout = 3600;

    private $hotel;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($hotel)
    {
        $this->hotel = $hotel;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        TboHotelCode::firstOrCreate(['HotelCode' => $this->hotel['HotelCode']],[

            'HotelName' => $this->hotel['HotelName'],
            'HotelAddress' => $this->hotel['HotelAddress'],
            'StarRating' => $this->hotel['StarRating'],
            'Longitude' => $this->hotel['Longitude'],
            'Latitude' => $this->hotel['Latitude'],
            'CountryCode' => $this->hotel['CountryCode'],
            'CityName' => $this->hotel['CityName'],
            'CountryName' => $this->hotel['CountryName']

        ]);
    }
}
