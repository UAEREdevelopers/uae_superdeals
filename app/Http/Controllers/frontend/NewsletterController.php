<?php

namespace App\Http\Controllers\frontend;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsletterController extends Controller
{
    public function save(Request $request){

        Newsletter::firstorCreate(['email' => $request->email],['is_subscribed' => 1 ]);
        return 'Thank you for subscribing!'; 
    }
}
