<?php

namespace App\Http\Controllers\frontend;

use Carbon\Carbon;
use App\Models\Blog;
use GuzzleHttp\Client;
use App\Models\Settings;
use Illuminate\Http\File;
use App\Models\HotelBooking;
use App\Models\HotelPackage;
use Illuminate\Http\Request;
use App\Models\PackageInterest;
use App\Models\HotelRack\Country;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\TBOController;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\HotelRackController;

class FrontEndController extends Controller
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
    //   $packages = HotelPackage::select(['id','title','thumbnail_image','short_description','package_price'])->where('category_id',6)->take(5)->get();
    //   $discoveruae = HotelPackage::select(['id','title','thumbnail_image','short_description','package_price'])->where('category_id',8)->take(4)->get();
    //   $specialtours =  HotelPackage::select(['id','title','thumbnail_image','short_description','package_price','country'])->where('category_id',7)->take(4)->get();
     
    

      return view('frontend.home')->with(compact(['packages', 'blogs','settings']));
    }

    public function getCategoriesforHomepage($settings){
        $data = [];
        $data['top_section'] =    HotelPackage::select(['id','title','thumbnail_image','short_description','package_price','country','category_id','slug'])->with('category:id,name,slug')->where('category_id',$settings->top_section_category_id)->take(5)->get();
        $data['middle_section'] = HotelPackage::select(['id','title','thumbnail_image','short_description','package_price','country','category_id','slug'])->with('category:id,name,slug')->where('category_id',$settings->middle_section_category_id)->take(4)->get();
        $data['bottom_section'] = HotelPackage::select(['id','title','thumbnail_image','short_description','package_price','country','category_id','slug'])->with('category:id,name,slug')->where('category_id',$settings->bottom_section_category_id)->take(4)->get();

        return $data; 
    }

    public function search(Request $request){        

        $results = $this->controller->homepagesearch($request);
        return $results;
       
    }

    public function searchSubmit(Request $request){
    
        return $this->controller->homepagesearchSubmit($request);
    }

    public function userProfile(){

        return view('frontend.userprofile.myprofile');
    }

    public function myBookings(){

        $bookings = HotelBooking::where('user_id', auth()->user()->id)->get();
        $packages = PackageInterest::where('user_id', auth()->user()->id)->get();
        return view('frontend.userprofile.mybookings')->with(compact(['bookings', 'packages']));
       
    }

    public function wishlist(){
        return view('frontend.userprofile.wishlist');
       
    }
    
   public function about(){
        
       return view('frontend.about');
    }


    public function termsAndConditions(){
        
       return view('frontend.terms');
    }

    
}
