<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Session;

class CustomAuthenticationController extends Controller
{   
       public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended()
                        ->withSuccess('Signed in');
        }
  
        return redirect()->route('home')->withSuccess('Login details are not valid');
    }


    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'mobile'=> 'required'
        ]);
           
        $data = $request->all();
        
        $user = $this->create($data);

        event(new Registered($user));

        Auth::login($user, true);
         
        return redirect()->route('homepage')->withSuccess('You have signed-in');
    }


    public function create(array $data)
    {
       
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'mobile' => $data['mobile'],
        'password' => Hash::make($data['password'])
      ]);
    }  

    public function updateprofile(Request $request){

     

        $user = Auth::user();

        if( isset($request->password )) {

            $request->validate([
            'password' => 'required|min:6'
        ]);

            $user->update(['password' => Hash::make($request->password)]);
        }

        if( isset($request->name )) {

            $request->validate([
            'name' => 'sometimes|required',
        ]);
            
            $user->update(['name'=> $request->name]);
        }

        Session::flash('success', 'Updated successfully');
        return back();
    }
}
