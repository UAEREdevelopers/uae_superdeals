<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Models\HotelRack\HotelInfo;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class FetchSingleHotelInfo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, IsMonitored;

    private $hotel , $cityId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($hotel ,$cityId)
    {
        $this->hotel = $hotel;

          $this->cityId = $cityId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   
        Log::info('started for hotel '.$this->hotel['HCode']);

        if( !HotelInfo::where('HCode', $this->hotel['HCode'])->exists() )
        {
        
            HotelInfo::Create([

          'HCode' => $this->hotel['HCode'],
          'HName' => $this->hotel['HName'] ?? 'NA',
          'Address' => $this->hotel['Address'] ?? 'NA',
          'city'=> $this->hotel['City'] ?? 'NA',
          'Country'=> $this->hotel['Country'] ?? 'NA',
          'Image'=> $this->hotel['Image'] ?? 'NA',
          'Location'=> 'NA',
          'Description'=>'NA',
        'Latitude'=> $this->hotel['Latitude'] ?? 'NA', 
        'Longitude'=> $this->hotel['Longitude'] ?? 'NA',
        'StarRating'=> $this->hotel['StarRating'] ?? 'NA',
        'CityId' => $this->cityId

      ]);
        }

       

       Log::info('Finished for hotel '.$this->hotel['HCode']);
    }
}
