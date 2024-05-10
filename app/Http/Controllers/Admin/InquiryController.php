<?php

namespace App\Http\Controllers\Admin;

use App\Models\RoomInquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InquiryController extends Controller
{
    public function byHotel()
    {   
        $inquiries = RoomInquiry::get();
        
        return view('backend.hotels')->with(compact('inquiries'));
    }

    public function byCity()
    {
        return view('backend.inquirybycity');
    }

}
