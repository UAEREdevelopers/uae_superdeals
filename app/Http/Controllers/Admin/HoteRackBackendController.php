<?php

namespace App\Http\Controllers\Admin;


use App\Models\HotelImage;
use App\Models\PackageImage;
use Illuminate\Http\Request;
use App\Models\HotelRack\HotelInfo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class HoteRackBackendController extends Controller
{
    public function index()
    {
         return view('backend.hotelrack.hotels');
    }
    public function getHotels(Request $request)
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
        $totalRecords = HotelInfo::select('count(*) as allcount')->count();
        $totalRecordswithFilter = HotelInfo::select('count(*) as allcount')->where('HName', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = HotelInfo::orderBy($columnName,$columnSortOrder)
            ->where('hotel_infos.HName', 'like', '%' .$searchValue . '%')
            ->select('hotel_infos.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        $sno = $start+1;
        foreach($records as $record){
            $id = $record->id;
            $image = $record->Image;
            $HCode = $record->HCode;
            $HName = $record->HName;
            $city = $record->city;
            $Country = $record->Country;
            $StarRating = $record->StarRating;

            // $Address = $record->Address;
            // $email = $record->email;

            $data_arr[] = array(
                "id" => $id,
                "HCode" => $HCode,
                "HName" => $HName,
                "image" =>$image,
                "city" => $city,
                "Country" => $Country,
                "StarRating" =>$StarRating ?? 'NA'
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


    public function editHotel(Request $request)
    {   

        $hotel = HotelInfo::with('images')->findOrFail($request->id); 
      
        return view('backend.hotelrack.edithotel')->with(compact('hotel')); 
    }

    public function updateHotel(Request $request)
    {
        $hotel = HotelInfo::findorFail($request->id); 
        $hotel->HName = $request->HName;
        $hotel->city = $request->city;
        $hotel->Country = $request->Country;
        $hotel->Address = $request->Address;
        $hotel->Description = $request->Description;
        $hotel->save();
        Session::flash('success', 'Succesfully updated');
        return back();
    }

    public function deleteImage(Request $request , $id)
    {   
        $fileName = HotelImage::findorFail($id);
        File::delete('uploads/hotelimages/'.$fileName->fileName);
        $fileName->delete();
        return back();
    }

    public function uploadImage(Request $request)
    {   

        if($request->type == 'delete')
        {
            $image = PackageImage::where('actual_name',$request->name)->orWhere('name',$request->name)->firstorfail();

        if($image){

             unlink(public_path('uploads/packages/'.$image->name));
              $image->delete();
              return true; 
        }
        }

        if($request->exists('packageid'))
        {   
             $fileName = time().'.'.$request->file->getClientOriginalName();
            $request->file->move(public_path('uploads/packages'), $fileName);
            $url = asset('uploads/packages/'.$fileName );

            PackageImage::create([

                'link' => $url,
                'actual_name' => $request->file->getClientOriginalName(),
                'name'=> $fileName,
                'package_id' => $request->packageid
            ]);
          
        return $fileName;

        }

         $fileName = time().'.'.$request->file->getClientOriginalName();
            $request->file->move(public_path('uploads/hotelimages'), $fileName);
            $url = asset('uploads/hotelimages/'.$fileName );

            HotelImage::create([

                'link' => $url,
                'name' => $fileName,
                'hotel_infos_id' => $request->id
            ]);
       
        return $fileName;
    }
}
