<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\District;
use App\Models\Division;


use App\Models\User;
use Auth;

class UsersController extends Controller
{

	// If user does not login, he can not go to the dashboard.For this reason we use middleware. We have default auth ->web.

	 public function __construct()
    {
        $this->middleware('auth');
    }


    public function dashboard(){

    	$user = Auth::user();

    	$divisions = Division::orderBY('priority','asc')->get();
        $districts = District::orderBY('name','asc')->get();

   return view('frontend.pages.users.dashboard', compact('user','divisions','districts'));

    }


    public function profile(){

        $user = Auth::user();

        $divisions = Division::orderBY('priority','asc')->get();
        $districts = District::orderBY('name','asc')->get();

        return view('frontend.pages.users.profile', compact('user','divisions','districts'));
    }

    public function updateProfile(Request $request){

        $user = Auth::user();

        $this->validate($request,[

            'first_name' =>'required|string|max:30',
            'last_name' =>'nullable|string|max:15',
            'username' =>'required|alpha_dash|max:100|unique:users,username,'.$user->id,
            'email' =>'required|string|email|max:100|unique:users,email,'.$user->id,
            'division_id' =>'required|numeric',
            'district_id' =>'required|numeric',
            'phone_no' =>'required|max:15|unique:users,phone_no,'.$user->id,
            'street_address' =>'required|max:100',

        ]);


        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone_no = $request->phone_no;
        $user->division_id = $request->division_id;
        $user->district_id = $request->district_id;
        $user->street_address = $request->street_address;
        $user->shipping_address = $request->shipping_address;
        
        if($request->password != NULL || $request->password != ""){
            $user->password = Hash::make($request->password);
        }

        $user->ip_address = request()->ip();

        $user->save();

        session()->flash('success','User profile has updated successfully!!');

        return back();
    }

     
}
