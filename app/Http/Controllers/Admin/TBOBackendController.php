<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\HotelBooking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\TBOController;
use Illuminate\Support\Facades\Session;
use App\Mail\PaymentLinkForHotelBooking;

class TBOBackendController extends Controller
{
    // BACKEND FUNCTIONS
    public function showBooking(){

        
        return view('backend.tbo.bookings');

    }

    public function getBookings(Request $request ){

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
        $totalRecords = HotelBooking::select('count(*) as allcount')->count();
        $totalRecordswithFilter = HotelBooking::select('count(*) as allcount')->where('ConfirmationNo', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = HotelBooking::orderBy($columnName,$columnSortOrder)
            ->where('hotel_bookings.ConfirmationNo', 'like', '%' .$searchValue . '%')
            ->select('hotel_bookings.*')
            ->skip($start)
            ->take($rowperpage)
            ->latest()
            ->get();

        $data_arr = array();
        $sno = $start+1;
        foreach($records as $record){
            $id = $record->id;
            $confirmationNo = $record->ConfirmationNo;
            $status = $record->status;
            $details = $record->HotelName.' '. $record->city;
            $dates = $record->checkInDate.' to '. $record->checkOutDate;
            $price = $record->price; 

            // $Address = $record->Address;
            // $email = $record->email;

            $data_arr[] = array(
                "id" => $id,
                "confirmationNo" => $confirmationNo,
                "status" => $status,
                "details" => $details,
                "dates" =>$dates,
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

        $booking =  HotelBooking::where('id', $id)->firstorfail();
        // return $booking;
        return view('backend.tbo.editbooking')->with(compact('booking'));
    }

    public function sendPaymentLink(Request $request){

      
        $booking = HotelBooking::where('id', $request->bookingid)->firstorfail();

        $data = [
            'email' => $booking->email,
            'hotelname' => $booking->HotelName,
            'city' => $booking->city,
            'dates' => Carbon::parse( $booking->checkInDate)->format('d-m-Y').' to '.Carbon::parse( $booking->checkOutDate)->format('d-m-Y'),
            'guests' => $booking->rooms.Str::plural(' Room ', $booking->rooms ).$booking->adults.Str::plural(' Adult', $booking->adults ).' and '. $booking->children.Str::plural(' Child ', $booking->children ),
            'price' => 'AED: '.$booking->price,
            'payment_link'  => route('payment_link',$booking->unique_id),
            'unique_id' => $booking->unique_id
        ];

        $address = json_decode($booking->guest_address, true);
        
        // Send paymentlink email
        $mail = dispatch((new SendPaymentLinkEmail($data))->onQueue("high"));           

        Session::flash('success', 'Paymentlink Sent successfully');

       return back();
    }

    public function voucherBooking(Request $request, $id){

       $booking = HotelBooking::where('id', $id)->firstorfail();
       $generator = new TBOController();
       $confirmbooking = $generator->generateInvoice($booking);


       if($confirmbooking['status']['statusCode'] == '01'){
       
        // save the invoice number in hotel booking table   
        
        Session::flash('success', 'Booking invoice generated successfully ,Invoice #'.$confirmbooking['invoice']);
            
       }else{
           Session::flash('Error!', $confirmbooking['status']['statusDesc']);
       }
       
      return back();
    }
}
