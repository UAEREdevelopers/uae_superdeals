<?php

namespace App\Http\Controllers\frontend;

use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Settings;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Models\PackageInterest;
use App\Models\HotelRack\Country;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\TBOController;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\HotelRackController;
use App\Mail\NewNameRecieved;

class MailSentController extends Controller
{   
    private $controller;

    public function __construct(){

         if(config('app.apisource') == 'HOTELRACK')
         {
             $this->controller = new HotelRackController();
         }

         if(config('app.apisource') == 'TBO')
         {
             $this->controller = new TBOController();
         }


    }


    public function home()
    {
      $settings = Settings::select(['homepage_second_banner','home_banner','banner_heading','banner_text', 'top_section_category_id', 'middle_section_category_id','bottom_section_category_id'])->first();
      $packages = $this->getCategoriesforHomepage($settings); 
      $blogs = Blog::select(['id','thumbnail_image', 'slug', 'title','short_description','created_at'])->latest()->take(4)->get();
     
    

      return view('frontend.home')->with(compact(['packages', 'blogs','settings']));
    }


    public function sendEmail(){

        $data_mail = "Mail";
        return view('frontend.send_email')->with(compact(['data_mail']));
    }


    public function sendEmailCheck(Request $request){


        $name = $request->name;
        $data = ['name'->$name];

        \Log::info("MailSentController: sendCheckmail: before Send Mail");
        Mail::to('rohan.uaere13@gmail.com')->queue(new NewNameRecieved($data));
        \Log::info("MailSentController: sendCheckmail: after Send Mail");


        return 1;
    }

   

    
}
