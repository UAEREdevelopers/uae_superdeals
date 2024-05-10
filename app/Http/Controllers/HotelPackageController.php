<?php

namespace App\Http\Controllers;

// use session;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\Settings;
use League\Flysystem\File;
use Illuminate\Support\Str;
use App\Models\HotelPackage;
use App\Models\PackageImage;
use Illuminate\Http\Request;
use App\Models\PackageInterest;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Mail\NewPackageInterestReceived;
use App\Jobs\SendPcrinquiryReceivedEmails;
use App\Jobs\SendPackageInterestInquiryReceivedEmails;

class HotelPackageController extends Controller
{   
    public function showAllCategories()
    {
        $categories = Category::all();

        return view('frontend.categories.show_all_categories')->with(compact('categories')); 
    }

    public function showCategory(Request $request, $category)
    {   
        
        $category = Category::where('slug',$category)->with('packages:id,title,short_description,package_price,thumbnail_image,category_id,slug')->firstorfail();
        $settings = Settings::select(['categories_banner'])->first();
     
        return view('frontend.categories.show_category')->with(compact(['category','settings'])); 
       
    }
    public function showAllPackages()
    {
        $packages = HotelPackage::paginate(15);
        
        return view('frontend.package.showall')->with(compact(['packages']));
    }

    public function showPackage(Request $request, $id)
    {
        $package = HotelPackage::with('images')->where('slug',$id)->firstorfail();
        $settings = Settings::select(['categories_banner'])->first();
        return view('frontend.package.packagedetail')->with(compact(['package','settings'] ));
    }

    publIc function submitInterest(Request $request)
    {      
        
        
        $package = PackageInterest::create([

            'name' =>    $request->name,
            'phone' =>   $request->phone,
            'email' =>   $request->email,
            'price' => $request->price,
            'package_id' =>  $request->packageid,
            'nationality'  =>  $request->nationality ?? null ,
            'date' => Carbon::parse($request->date)->format('d-m-Y') ?? null,
            'time' => $request->time ?? null ,
            'city' => $request->city ?? null ,
            'area' => $request->area ?? null ,
            'no_of_adults'   =>  $request->adults ?? null ,
            'no_of_children'  =>  $request->children_count_under_11 ?? null ,
            'no_of_children_under_5'  =>  $request->children_count_under_5 ?? null ,
            'no_of_infants'  =>  $request->infants_count ?? null ,
            'special_requests' =>  $request->special_requests,
            'status' => 'pending'

        ]);

        $package->load('package');

        if ($request->is_inquiry == 1 )
        {
            return $this->submitInquiry($package);
        }

        //  IF PCR PACKAGE SAVE AS PCR PACKAGE
        // if($package->package->category_id == '25'){
        if($package->package->category_id == '13'){

            $payment = save_to_payments_table($package, 'pcr_package');
        }
        

        //UPDATE PAYMENTS TABLE FOR PAYMENT ID      
        // if($package->package->category_id != '25'){
        if($package->package->category_id != '13'){

              $payment = save_to_payments_table($package, 'package');
        }      


        // UPDATE PAYMENT TABLE ID IN EXPO2020_DEALS TABLE
        $package->update(['payment_table_id' => $payment['id']]);
        



         // Sending email
        $to = 'shuhaib.uaere@gmail.com';
        $subject = 'SuperDeals test ';
        $message3 = "Super Deals Test";
        if(mail($to, $subject, $message3)){
           \Log::info('Your mail3 has been sent successfully. '.date('m/d/Y h:i:s a', time()));
        } else{
            \Log::info('Unable to send email3. Please try again.'.date('m/d/Y h:i:s a', time()));
        }



        $VERSION = "v18.0";
        $PHONE_NUMBER_ID = "256720837525582";
        $text = "Superdeals";
        $metaBearerToken = 'EAATCgHhL5dIBOzkZAUOlTCRZCChZCaEcmDAz0sso2CZB6zbHtaAldpRibLbMaSzBm0Q1ngRxsz4GV2ZCcKaNBWD78ZCj8QZADg6tTdZCTyU0DznSOZAZBXxNXLWbYYFfjhs0Bl4fZBs8U71o47VgQupxKJn1a804maDaBrQmOXQVK61t6weZAEoMymZAavFL0pZB1hKHgX';

        $url = 'https://graph.facebook.com/'.$VERSION.'/'.$PHONE_NUMBER_ID.'/messages';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $data = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => '971522436609',
            "type" => "text",
            "text" => [
                "preview_url" => false,
                "body" => $text
            ]
        ];

        /*$data = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $whatsappTo,
            "type" => "template",
            "template" => [
                "name" => 'uaehomefinder_welcome',
                "language" =>[
                    "code" => "en_US"
                ]
                
            ]
        ];*/


        $headers = array(
            "Accept: application/json",
            "Content-Type: application/json",
            "Authorization: Bearer " . $metaBearerToken
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        $respWhatsapp = curl_exec($curl);
        curl_close($curl);
        \Log::info("Superdeals whatsapp met dev13".print_r($respWhatsapp,true));



        Session::flash('success', 'Succesfully created');
        //return redirect()->route('payment_link', ['id'=> $payment['unique_id']]);
    }

    public function submitInquiry($package)
    {      
        //  SENDING PCR INQUIRY MAIL
        // if($package->package->category_id =='25' ) {
        if($package->package->category_id =='13' ) {
            
         $mail = dispatch((new SendPcrinquiryReceivedEmails($package))->onQueue("high"));     
        }

        else{
            
            $mail = dispatch((new SendPackageInterestInquiryReceivedEmails($package))->onQueue("high")); 
        }
         
        Session::flash('success', 'Succesfully submitted');
        return back();
    }


    // BACKEND ROUTES START


    public function listAllPackages()
    {
        return view('backend.package.listpackages');
    }
    public function getPackages(Request $request)
    {   

        // dd($request->get('order'));

        // datatables

         $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = HotelPackage::select('count(*) as allcount')->count();
        $totalRecordswithFilter = HotelPackage::select('count(*) as allcount')->where('title', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = HotelPackage::orderBy($columnName,$columnSortOrder)
            ->where('hotel_packages.title', 'like', '%' .$searchValue . '%')
            ->select('hotel_packages.*')->with('category')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        $sno = $start+1;
        foreach($records as $record){
            $id = $record->id;
            $title = $record->title;
            $category = $record->category->name ?? '';
            // $short_description = $record->short_description;
            $is_package_price = $record->is_package_price;
            $package_price = $record->package_price;
            $thumbnail_image = $record->thumbnail_image;
            $is_active = $record->is_active;
            $city = $record->city;
            $country = $record->country;

            $data_arr[] = array(
                "id" => $id,
                "title" => $title,
                "category" => $category,
                // "short_description" => $short_description,
                "is_package_price" =>$is_package_price,
                "package_price" => $package_price,
                "thumbnail_image" => $thumbnail_image,
                "is_active" =>$is_active ?? 1,
                 "city" => $city,
                  "country" => $country,
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        ); 

        echo json_encode($response);
        exit;

        // datatables ends
        
    }

    public function getPackageInterests(Request $request)
    {
         // dd($request->get('order'));

        // datatables

         $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = PackageInterest::select('count(*) as allcount')->count();
        $totalRecordswithFilter = PackageInterest::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = PackageInterest::with('package')->orderBy($columnName,$columnSortOrder)
            ->where('package_interests.name', 'like', '%' .$searchValue . '%')
            ->select('package_interests.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        $sno = $start+1;
        foreach($records as $record){
            $id = $record->id;
            $name = $record->name;
            $phone = $record->phone;
            $email = $record->email;
            $status = $record->status;
            $package = $record->package->title;
            $city =  $record->package->city;
            $country = $record->package->country;

            $data_arr[] = array(
                "id" => $id,
                "name" => $name,
                "phone" => $phone,
                "email" =>$email,
                "status" => $status,
                "package" => $package,
                "city" => $city,
                "country" => $country,
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        ); 

        echo json_encode($response);
        exit;

        // datatables ends
    }

    public function listAllInterests()
    {
        return view('backend.package.listinterests');
    }


    public function createPackage()
    {   
        $package_id = mt_rand();
        $categories = Category::all();
        Session::put('temp_package_id', $package_id);

        return view('backend.package.create')->with(compact(['package_id', 'categories'] ));
    }

    public function savePackage(Request $request)
    {   
        
        // dd($request);
        if( isset( $request->bannerimage) ) {

            //  format : save_uploaded_image( file, location_to_save , width, height )

           $bannerurl = asset('uploads/packages/'.save_uploaded_image($request->bannerimage , 'uploads/packages/') );
         
        }

        if( isset( $request->mobilebannerimage) ) {

            //  format : save_uploaded_image( file, location_to_save , width, height )

           $mobilebannerurl = asset('uploads/packages/'.save_uploaded_image($request->mobilebannerimage , 'uploads/packages/') );
         
        }



        if( isset( $request->thumbnail) ) {

            $thumbnailurl = asset('uploads/packages/'.save_uploaded_image($request->thumbnail , 'uploads/packages/' , 400 , 267 )) ;
          
        }

        $package = HotelPackage::create([

            'title' => $request->title,
            'slug' => $request->title,
            'category_id'=> $request->category_id ?? null,
            'short_description' => $request->short_description,
            'description' =>$request->description,
            'tracking_code'  =>  $request->tracking_code ?? null ,
            'package_price' => $request->package_price,
            'adult_price' => $request->adult_price ?? null,
            'single_price' => $request->single_price ?? null,
            'child_price_under_11' => $request->child_price_under_11 ?? null,
            'child_price_under_5' => $request->child_price_under_5 ?? null,
            'infant_price' => $request->infant_price ?? null,
            'city' =>$request->city,
            'country'=> $request->country,
            'banner_image' => $bannerurl ?? null,
            'mobile_banner_image' => $mobilebannerurl ?? null,
            'thumbnail_image' => $thumbnailurl ?? null,
            'itineraries' => json_encode($request->itinerary) ?? null,
            'itinerary_heading' => json_encode($request->itinerary_heading) ?? null,
            
        ]);

        // updating images

           if(Session::has('temp_package_id'))
        {
            $images = PackageImage::where('package_id', session('temp_package_id'))->update(['package_id'=>$package->id]);
        }

       
        Session::flash('success', 'Succesfully created');
        return redirect()->route('create_package');
    }

    public function editPackage(Request $request, $id)
    {
        $package =  HotelPackage::findOrFail($id);

        $package->load('images');
       
        $categories = Category::all();
        return view('backend.package.edit')->with(compact(['package', 'categories'] ));
    }

    public function updatePackage(Request $request)
    {   
        
        $package = HotelPackage::findorFail($request->id);

        $bannerurl = $package->banner_image;

        $thumbnailurl = $package->thumbnail_image;   
        
        $mobilebannerurl =  $package->mobile_banner_image;  

        if( isset($request->bannerimage))
        {    
            $delete = $this->deleteExistingImage($package->banner_image);
            $bannerurl = asset('uploads/packages/'.save_uploaded_image($request->bannerimage , 'uploads/packages/') );

        }

        if( isset($request->mobilebannerimage))
        {    
            $delete = $this->deleteExistingImage($package->mobile_banner_image);
            $mobilebannerurl = asset('uploads/packages/'.save_uploaded_image($request->mobilebannerimage , 'uploads/packages/') );

        }
        

        if( isset($request->thumbnail))
        {   
            
            $delete = $this->deleteExistingImage($package->thumbnail_image); 
            $thumbnailurl = asset('uploads/packages/'.save_uploaded_image($request->thumbnail , 'uploads/packages/' , 400 , 267 )) ;
            
        }

      
        
        

        
        $package->title = $request->title;
        // $package->slug = $request->title;
        $package->category_id = $request->category_id ?? null;
        $package->short_description= $request->short_description;
        $package->description = $request->description;
        $package->tracking_code = $request->tracking_code;
        $package->city = $request->city;
        $package->country = $request->country;
        $package->package_price = $request->package_price;
        $package->adult_price = $request->adult_price;
        $package->single_price = $request->single_price;
        $package->child_price_under_11 = $request->child_price_under_11;
        $package->child_price_under_5 = $request->child_price_under_5;
        $package->infant_price = $request->infant_price;
        $package->banner_image = $bannerurl;
        $package->mobile_banner_image = $mobilebannerurl;
        $package->thumbnail_image  = $thumbnailurl;
        $package->itineraries = json_encode($request->itinerary) ?? null;
        $package->itinerary_heading = json_encode($request->itinerary_heading) ?? null;

        $package->save();
       
        Session::flash('success', 'Succesfully updated');
        return back();
    }

    public function deleteExistingImage($image)
    {   

        if($image !=null ) {

        $url = asset('uploads/packages/');
        $jpgimage = trim( str_replace($url.'/', '',$image));
        $jpgimagepath = public_path('uploads/packages/'.$jpgimage);

        $webpimage = Str::replaceLast('.jpg','.webp',$jpgimage); 
        $webpimagepath =   public_path('uploads/packages/'.$webpimage);
        
       
        if(file_exists($jpgimagepath)){
            unlink($jpgimagepath);
        }

        if(file_exists($webpimagepath)){
            unlink($webpimagepath);
        }

        return true; 

        }

    }

    public function editPackageInterest(Request $request , $id)
    {
        $package = HotelPackage::findorFail($id);
        return $package;
    }

    public function deletePackage(Request $request , $id)
    {
        HotelPackage::findOrFail($id)->delete();
        Session::flash('success', 'Succesfully Deleted');

        return redirect()->route('list_all_packages');
    }

    public function deletePackageImage(Request $request)
    {
        $image = PackageImage::where('name',$request->name)->firstorfail();

        if($image){

             unlink(public_path('uploads/packages/'.$request->name));
              $image->delete();
              return true; 
        }
       

    }

    // UPLOAD IMAGES FOR PACKAGES
    public function uploadImage(Request $request)
    {      


        if($request->exists('packageid'))
        {      

            $fileName = save_uploaded_image($request->file , 'uploads/packages/');
            $url = asset('uploads/packages/'.$fileName );

            PackageImage::create([

                'link' => $url,
                'actual_name' => $request->file->getClientOriginalName(),
                'name'=> $fileName,
                'package_id' => $request->packageid
            ]);
          
        return $fileName;

        }


        // to Delete file

        if($request->type == 'delete')
        {
            $image = PackageImage::where('actual_name',$request->name)->orWhere('name',$request->name)->firstorfail();

        if($image){

             $image->delete();
            if( file_exists(public_path('uploads/packages/'.$image->name))){

              unlink(public_path('uploads/packages/'.$image->name));            

            }

            // for webp image
            $webpimage = explode('.',$image->name)[0].'.webp';
            // $webpimageurl = public_path('uploads/packages/'.$webpimage);

            if( file_exists(public_path('uploads/packages/'.$webpimage))){

                unlink(public_path('uploads/packages/'.$webpimage));     
            }
             
              return $webpimage; 
        }
        }

        
    }

}
