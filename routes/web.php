<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProductController;
  
Route::resource('products', ProductController::class);

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

Route::get('/pcr-test', function(){

    return redirect()->route('show_package', ['id'=>'covid-19-pcr-test']);
});


/*
|--------------------------------------------------------------------------
| CUSTOM AUTHENTICATION ROUTES 
|--------------------------------------------------------------------------
|
*/
Route::post('/custom-registraion', 'CustomAuthenticationController@customRegistration')->name('custom-registraion');

Route::post('/custom-login', 'CustomAuthenticationController@customLogin')->name('custom-login');

Route::post('/updateprofile', 'CustomAuthenticationController@updateprofile')->name('update-profile');


/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES 
|--------------------------------------------------------------------------
|
*/
// middleware([ 'verified'])->
Route::get('/', 'frontend\FrontEndController@home')->name('homepage');

Route::get('/terms', 'frontend\FrontEndController@termsAndConditions')->name('terms');

Route::get('/about', 'frontend\FrontEndController@about')->name('about');

Route::get('/search', 'frontend\FrontEndController@search')->name('home_search');

Route::get('/searchhotels', 'frontend\FrontEndController@searchSubmit')->name('search_submit');

Route::post('/newsletter/subscribe', 'frontend\NewsletterController@save')->name('save_newsletter_subscriber');

// USER PAGEES

Route::group(['middleware' => 'auth'], function(){

Route::get('/profile', 'frontend\FrontEndController@userProfile')->name('user_profile');

Route::get('/mybookings', 'frontend\FrontEndController@myBookings')->name('user_bookings');

Route::get('/wishlist', 'frontend\FrontEndController@wishlist')->name('wishlist');

});

/*
|--------------------------------------------------------------------------
| PRODUCTS ROUTES
|--------------------------------------------------------------------------
|
*/

//  FRONTEND
Route::get('/iqibla', 'ProductController@index')->name('show_product');
/* Route::get('/product/iqibla', 'ProductController@index')->name('show_product'); */

Route::get('/product/iqibla/{id}', 'ProductController@showProduct')->name('show_product_details');
Route::post('/product/iqibla/buy', 'ProductController@buy')->name('buy_product');

/* Route::post('/product/iqibla', 'ProductController@addToCart')->name('add_to_cart_product'); */
Route::post('iqibla', 'ProductController@addToCart')->name('add_to_cart_product');


// BACKENDDDDDD

/*
|--------------------------------------------------------------------------
| EXPO PACKAGE ROUTES FRONTEND
|--------------------------------------------------------------------------
|
*/

Route::get('/expo-2020-deals', 'Expo2020DealsController@index')->name('expo2020');
Route::post('/expo-2020-deals', 'Expo2020DealsController@book')->name('expodeals-submit');

// backend pages for expo

Route::get('/expodeals/bookings', 'Expo2020DealsController@showBooking')->name('expodeals_bookings');     

Route::get('/expodeals/getbookings', 'Expo2020DealsController@getBookings')->name('get_expodeals_bookings'); 

Route::get('/expodeals/edit/{id?}', 'Expo2020DealsController@editBooking')->name('edit_expodeal_booking'); 

Route::post('/expodeals/update', 'Expo2020DealsController@updateBooking')->name('update_expodeals_booking'); 




/*
|--------------------------------------------------------------------------
| PACKAGES ROUTES FRONTEND
|--------------------------------------------------------------------------
|
*/
Route::get('/categories/all','HotelPackageController@showAllCategories' )->name('show_all_categories');

Route::get('/categories/{category}','HotelPackageController@showCategory' )->name('show_category');


Route::prefix('packages')->group(function () {


Route::get('/package/all','HotelPackageController@showAllPackages' )->name('show_all_package');

Route::get('/{id}','HotelPackageController@showPackage' )->name('show_package');

Route::post('/submitinterest','HotelPackageController@submitInterest' )->name('submit_package_interest');

});



/*
|--------------------------------------------------------------------------
| PACKAGES ROUTES BACKEND
|--------------------------------------------------------------------------
|
*/

Route::middleware(['auth', 'admin'])->prefix('admin/packages')->group(function () {

Route::get('/list','HotelPackageController@listAllPackages' )->name('list_all_packages');

Route::get('/interests','HotelPackageController@listAllInterests' )->name('list_package_interests');


Route::get('/list/get', 'HotelPackageController@getPackages')->name('list_packages');

Route::get('/listinterests/get', 'HotelPackageController@getPackageInterests')->name('list_interests');



Route::get('/create','HotelPackageController@createPackage' )->name('create_package');

Route::post('/save','HotelPackageController@savePackage' )->name('save_package');

Route::get('/edit/{id?}','HotelPackageController@editPackage' )->name('edit_package');

Route::get('/editinterest/{id?}','HotelPackageController@editPackageInterest' )->name('edit_package_interest');

Route::post('/update','HotelPackageController@updatePackage' )->name('update_package');

Route::get('/delete/{id?}','HotelPackageController@deletePackage' )->name('delete_package');


});

// needs to be outside of middleware
Route::post('/packageimage/delete','HotelPackageController@deletePackageImage' )->name('delete_package_image');

Route::post('/uploadimage', 'HotelPackageController@uploadImage')->name('upload_hotel_image');

/*
|--------------------------------------------------------------------------
| HOTELRACK ROUTES  
|--------------------------------------------------------------------------
|
*/

Route::middleware(['auth', 'admin'])->prefix('hr')->group(function () {

    // Static calls to API for fetching info..... No need to do always.  
    Route::get('/countrylist', 'HotelRackController@GetCountryList')->name('hotelrack_countrylist');

    Route::get('/citylist', 'HotelRackController@GetCityList')->name('hotelrack_citylist');

    Route::get('/hotelinfo', 'HotelRackController@GetHInfo')->name('hotelrack_getinfo');

    Route::get('/searchroom', 'HotelRackController@HSearchByCity')->name('hotelrack_searchroom');

    Route::get('/hoteldetails/{id}', 'HotelRackController@HotelDetailView')->name('hotel_detail_view');

    Route::post('/fetchroominfo', 'HotelRackController@PrebookSingleRoom')->name('singleRoomPrebook');

    //  Static Calls End

    Route::get('/search', 'HotelRackController@homepagesearch')->name('hotelrack_search');
    Route::get('/searchhotelshr', 'HotelRackController@homepagesearchSubmit')->name('hotelrack_search_submit');

    Route::post('/submitinterest','HotelRackController@submitInterest')->name('submit_interest_on_room');


    Route::get('/listhotels', 'Admin\HoteRackBackendController@index')->name('list_hotels_view');
    
    Route::get('/listhotels/get', 'Admin\HoteRackBackendController@getHotels')->name('list_hotels');

    Route::get('/edithotel/{id?}', 'Admin\HoteRackBackendController@editHotel')->name('edit_hotel');

    Route::post('/updatehotel', 'Admin\HoteRackBackendController@updateHotel')->name('update_hotel');    

    Route::post('/uploadimage', 'Admin\HoteRackBackendController@uploadImage')->name('hotel_rack_upload_hotel_image');

     Route::get('/deleteimage/{id}', 'Admin\HoteRackBackendController@deleteImage')->name('delete_image');

    

    

    
});


/*
|--------------------------------------------------------------------------
| TBO ROUTES 
|--------------------------------------------------------------------------
|
*/

Route::prefix('tbo')->group(function () {

Route::get('/countrylist', 'TBOController@GetCountryList')->name('tbo_countrylist');

Route::get('/citylist', 'TBOController@GetCityList')->name('tbo_citylist');

Route::get('/hotelcodelist', 'TBOController@GetHotelCodeList')->name('tbo_hotelcode_list');

Route::get('/hoteldetails', 'TBOController@getHotelDetail')->name('tbo_hotel_details');

Route::middleware(['sessionvaliditycheck'])->group(function(){

    Route::get('/hoteldetails/{city?}', 'TBOController@getHotelDetailForCity')->name('tbo_hotel_details_for_city');
    Route::get('/hoteldetails/{id}/{resultindex}', 'TBOController@HotelDetailView')->name('hotel_detail_view_tbo');
    Route::get('/availablerooms', 'TBOController@getAvailableHotelRooms')->name('tbo_available_rooms');
    Route::get('/availabilityandpricing', 'TBOController@getAvailabilityAndPricing')->name('tbo_availablity_and_pricing');
    Route::post('/checkavailability','TBOController@checkAvailability')->name('check_availability');
    Route::post('/bookhotel','TBOController@bookHotel')->name('book_hotel_tbo');
});





Route::get('/cancellationpolicy', 'TBOController@getHotelCancellationPolicy')->name('tbo_cancelation_policy');

Route::get('/bookhotel', 'TBOController@getHotelBook')->name('tbo_hotel_book');

Route::get('/hotelsearch', 'TBOController@HotelSearch')->name('tbo_hotel_search');





Route::post('/submitinterested','TBOController@submitInterest')->name('submit_interest_on_room_tbo');


 
});


 // BACKEND ROUTES


Route::middleware(['auth', 'admin'])->prefix('tbo')->group(function () {

Route::get('/bookings', 'Admin\TBOBackendController@showBooking')->name('tbo_hotel_bookings');     

Route::get('/getbookings', 'Admin\TBOBackendController@getBookings')->name('get_tbo_hotel_bookings'); 

Route::get('/editbooking/{id?}', 'Admin\TBOBackendController@editBooking')->name('edit_tbo_hotel_booking'); 

Route::get('/sendpaymentlink/{id}', 'Admin\TBOBackendController@sendPaymentLink')->name('send_payment_link');  

Route::get('/voucherbooking/{id}', 'Admin\TBOBackendController@voucherBooking')->name('voucher_booking');  


    });


/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
|
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () { 

    Route::get('/home', 'Admin\AdminController@index')->name('admin.home');

    Route::get('/settings', 'Admin\AdminController@getSetting')->name('admin_settings');

    Route::post('/settings', 'Admin\AdminController@saveSettings')->name('admin_save_settings');

    Route::get('/blankpage', 'Admin\AdminController@blankPage')->name('admin.blankpage');

    Route::get('/inquiries/hotel', 'Admin\InquiryController@byHotel')->name('room_inquiry');

    Route::get('/inquiries/city', 'Admin\InquiryController@byCity')->name('room_inquiry_by_city');

    Route::get('/categories', 'Admin\AdminController@Categories')->name('admin_categories');

    Route::post('/categories', 'Admin\AdminController@saveCategory')->name('admin_save_category');

    Route::get('/category/{id}', 'Admin\AdminController@editCategory')->name('admin_edit_category');

    Route::post('/updatecategory', 'Admin\AdminController@updateCategory')->name('admin_update_category');

    Route::get('/deletecategory/{id}', 'Admin\AdminController@deleteCategory')->name('admin_delete_category');

    

    
  
});

Route::post('admin/upload','Admin\AdminController@uploadImage')->name('upload_image_tinymce');
Route::post('admin/uploadvideo','Admin\AdminController@uploadVideo')->name('upload_video_tinymce');


/*
|--------------------------------------------------------------------------
| BLOGS ROUTES BACKEND & FRONTEND 
|--------------------------------------------------------------------------
|
*/
Route::middleware(['auth', 'admin'])->prefix('admin/blogs')->group(function () {

    Route::get('/list','BlogController@listAllBlogs' )->name('list_all_blogs');

    Route::get('/list/get', 'BlogController@getBlogs')->name('list_blogs');

    Route::get('/create','BlogController@create' )->name('create_blog');

    Route::post('/save','BlogController@save' )->name('save_blog');

    Route::get('/edit/{id?}','BlogController@edit' )->name('edit_blog');

    Route::post('/update','BlogController@update' )->name('update_blog');

    Route::get('/delete/{id?}','BlogController@deleteBlog' )->name('delete_blog');   


});

Route::prefix('blogs')->group(function () { 

    Route::get('/','BlogController@showAllBlogs' )->name('show_all_blogs');
    Route::get('/{slug}','BlogController@SingleBlogPost' )->name('show_single_blog');
});



/*
|--------------------------------------------------------------------------
| PAYMENTLINK ROUTES
|--------------------------------------------------------------------------
|
*/

   Route::get('/pay/{id?}','PaymentController@index' )->name('payment_link');

   Route::post('/payment/success','PaymentController@paymentSuccess' )->name('payment_success');

   Route::post('/payment/failure','PaymentController@paymentFailure' )->name('payment_failure');


/*
|--------------------------------------------------------------------------
| QUEUE MONITORING
|--------------------------------------------------------------------------
|
*/



Route::middleware(['auth', 'admin'])->prefix('jobs')->group(function () {
    Route::queueMonitor();
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');