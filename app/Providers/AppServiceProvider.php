<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\TboCountry;
use App\Models\HotelRack\Country;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   

        if (! $this->app->runningInConsole()) {

         Paginator::useBootstrap();

         $countries; 

         $categories =Category::whereNull('category_id')
                    ->with('childrenCategories')
                    ->get();

         if(config('app.apisource') == 'HOTELRACK')
         {  
              $countries = Country::select('CountryId as country_id', 'Country as country_name')->get();
         }

         if(config('app.apisource') == 'TBO')
         {
             $countries = TboCountry::select('CountryCode as country_id','CountryName as country_name')->get(); 
         }

         View::share('countries',$countries);  
         View::share('categories',$categories); 
        }
         
    }
}
