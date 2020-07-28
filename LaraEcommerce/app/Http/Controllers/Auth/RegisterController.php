<?php
/*
namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\District;
use App\Models\Division;
use App\Notifications\VerifyRegistration;
*/

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Models\District;
use App\Models\Division;
use App\Notifications\VerifyRegistration;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


     /**
     * override the method
     * display registration forom
     * @param  void view
     * @return \Illuminate\Foundation\Auth\RegistersUsers;
     */

    public function showRegistrationForm()
    {
        $divisions = Division::orderBY('priority','asc')->get();
        $districts = District::orderBY('name','asc')->get();

        return view('auth.register',compact('divisions','districts'));
    }

protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' =>'required|string|max:30',
            'last_name' => 'nullable|string|max:15',            
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'division_id' =>'required|numeric',
            'district_id' =>'required|numeric',
            'phone_no' => 'required|max:11|unique:users',
            'street_address' => 'required|max:100',
        ]);

    }

    public function validation(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' =>'required|email|max:100|unique:users',
            'password'=> 'required|min:6|confirmed',
            'phone_no' =>'required|min:11|max:11|unique:users',
            'division_id'=> 'required|numeric',
            'district_id'=>'required|numeric',
            'street_address'=>'required|max:100',
        ]);
    
        
    }
   

    /*
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     
     protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' =>'required|string|max:30',
            'last_name' => 'nullable|string|max:15',            
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'division_id' =>'required|numeric',
            'district_id' =>'required|numeric',
            'phone_no' => 'required|max:11|unique:users',
            'street_address' => 'required|max:100',
        ]);

    })
    
    Validation aivabeo kora jabe
    */
/*
    public function validation(Request $request)
{
    $this->validate($request, [
        'first_name' => 'required|string|max:30',
        'last_name' => 'required|string|max:15',
        'email' =>'required|email|max:100|unique:users',
        'password'=> 'required|string|min:6|confirmed',
        'phone_no' =>'required|max:11|unique:users',
        'division_id'=> 'required|numeric',
        'district_id'=>'required|numeric',
        'street_address'=>'required|max:100',
    ]);

    
}

*/


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
/*
    public function register(Request $request)
    {
        //$this->validator($request->all());
        $this->validation($request);

        $user =  User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => str_slug($request->first_name.$request->last_name),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'phone_no' => $request->phone_no,
            'street_address' => $request->street_address,
            'ip_address' => request()->ip(),
            'remember_token' => str_random(50),
            'status' => 0,
        ]);

        $user->notify(new VerifyRegistration($user));
        session()->flash('success','A confirmation mail has sent to you...Please check and confirm your registration');
        return redirect('/');
    }
*/
    /* we can do this by using this method also 

protected function register(Request $request)
    {
        $this->validation($request);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => str_slug($request->first_name.$request->last_name),
            'phone_no' => $request->phone_no,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'street_address'=> $request->street_address,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'ip_address' => request()->ip(),           
            'remember_token' => str_random(50),
            'status' => 0,
            
        ]);
        $user->notify(new VerifyRegistration($user));
        session()->flash('success','A confirmation email has sent to you...Please check and confirm your email');
        return redirect('/');
    }
/*
     protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' =>$data['last_name'],
            'username' => str_slug($data['first_name'].$data['last_name']),
            'phone_no' => $data['phone_no'],
            'email' => $data['email'],            
            'password' => Hash::make($data['password']),
            'street_address'=> $data['street_address'],
            'division_id' => $data['division_id'],
            'district_id' => $data['district_id'],
            'ip_address' => request()->ip(),
            'remember_token' => str_random(50),
            'status' => 0,             

        ]);
        $user->notify(new VerifyRegistration($user));
        session()->flash('success','A confirmation email has sent to you...Please check and confirm your email');
        
        return redirect('/');
    } */
}
