<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expo2020Deals;
use Illuminate\Support\Facades\Session;

class Expo2020DealsController extends Controller
{
    public function index()
    {  
        // return view('expo2020.frontend.show-vue');
        return view('expo2020.frontend.show');
    }

    public function book(Request $request)
    {   
       
       $booking = Expo2020Deals::create([
        
        'name' => $request->name,
        'email' => $request->email,
        'phone'  => $request->phone,
        'price'  =>  $request->price,
        'unique_id' => generate_long_unique_id(),
        'days_selected' =>  $request->hotel_selected,
        'hotel_selected' =>  $request->hotel_selected,
        'booking_status' =>  'pending',
        'payment_status' =>  'pending',

       ]);

        //UPDATE PAYMENTS TABLE FOR PAYMENT ID        
        $payment = save_to_payments_table($booking, 'expo2020_deals');


        // UPDATE PAYMENT TABLE ID IN EXPO2020_DEALS TABLE
        $booking->update(['payment_table_id' => $payment['id']]);




        //Redirect to payment page

        Session::flash('success', 'Succesfully created');
        return redirect()->route('payment_link', ['id'=> $payment['unique_id']]);
        return redirect()->back();
    }

    // BACKEND PAGES FUNCTIONS

    public function showBooking(){

        
        return view('backend.expo2020deals.bookings');

    }

    public function getBookings(Request $request ){

      

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
        $totalRecords = Expo2020Deals::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Expo2020Deals::select('count(*) as allcount')->where('unique_id', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = Expo2020Deals::orderBy($columnName,$columnSortOrder)
            ->where('expo2020_deals.unique_id', 'like', '%' .$searchValue . '%')
            ->select('expo2020_deals.*')
            ->skip($start)
            ->take($rowperpage)
            ->latest()
            ->get();

        $data_arr = array();
        $sno = $start+1;
        foreach($records as $record){
            $id = $record->id;
            $unique_id = $record->unique_id;
            $status = $record->booking_status;
            $payment_status = $record->payment_status;
            $hotel_selected = $record->hotel_selected;
            $days_selected = $record->days_selected;
            $price = $record->price; 

            // $Address = $record->Address;
            // $email = $record->email;

            $data_arr[] = array(
                "id" => $id,
                "unique_id" => $unique_id,
                "status" => $status,
                "payment_status" => $payment_status,
                "hotel_selected" =>$hotel_selected,
                "days_selected" => $days_selected,
                "price" => $price
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

    public function editBooking(Request $request , $id){

         $booking =  Expo2020Deals::where('id', $id)->firstorfail();
        // return $booking;
        return view('backend.expo2020deals.editbooking')->with(compact('booking'));
    }

    public function updateBooking(Request $request){
       
        $booking = Expo2020Deals::where('id' , $request->id)->update(['booking_status'=> $request->status]);
        Session::flash('success', 'Succesfully updated');
        return redirect()->back();

    }


}
