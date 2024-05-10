<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckIfSessionValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   
        $startTime = Carbon::parse(session()->get('session_expiry_time')) ;
        $currentTime = Carbon::now();
        $a = $currentTime->diffInMinutes($startTime); 

        
        if($currentTime->diffInMinutes($startTime) > 28)
        {
            clear_stored_sessions();
            Session::flash('error', "Session timed out Please start again");
            return redirect()->route('homepage');
        }


        return $next($request);
    }
}
