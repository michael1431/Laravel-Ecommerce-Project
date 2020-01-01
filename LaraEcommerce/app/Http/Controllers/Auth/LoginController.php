<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Notifications\VerifyRegistration;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    


    public function login(Request $request){
        // if we want to chekc anything then type dd('something');

        // check the validation

         $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Find user by this email

         $user = User::where('email', $request->email)->first();
         
         if($user->status == 1){
            // If email and password are right

            if(Auth::guard('web')->attempt(['email'=>$request->email,'password'=>$request->password], $request->remember)){
                // Then login him
                // Intended function ta login hoar por index page e patiye dibe
                return redirect()->intended(route('index'));
            }else{
                // Password or email bhul dile msg show korbe
                session()->flash('sticky_error','Invalid Email or Password!!');
              return back();
            }

         }else{
            // Jodi status 1 na hoi, then send him a token again

            if(!is_null($user)){

         $user->notify(new VerifyRegistration($user));
         session()->flash('success','A New confirmation mail has sent to you...Please check and confirm your registration');
          return redirect('/');

            }else{
                // jodi user er account na takhe tahole takhe register page e patai dibo

              session()->flash('sticky_error','Please register first');
              return redirect()->route('register');
            }


         }
    }

    public function userLogout(Request $request)
    {


        $this->guard()->logout();

        // we can do this by using this code also
       // Auth::guard('web')->logout();


       //return $this->loggedOut($request) ?: redirect('/admin/login');

        return redirect()->route('login');
    }
}
