<?php

namespace App\Jobs;

use App\Helpers\TBO;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class FetchAllHotelResultsAndCache implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,IsMonitored;

    
    private $cacheName;
    private $query; 
    
    public function __construct($query ,$cacheName )
    {
        $this->query= $query;
        $this->cacheName = $cacheName; 
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   
        $new = new TBO();

        $this->query['ResultCount']['value'] = 0;

        $results = ($new->HotelSearch($this->query));  
        

        // Caching the query to faster processing and avoiding API calls for all request
        Cache::put($this->cacheName , $results);

        return true;    
    }
}
