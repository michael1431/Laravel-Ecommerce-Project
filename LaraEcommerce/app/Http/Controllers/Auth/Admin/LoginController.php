<?php

namespace App\Http\Controllers\Auth\Admin;

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
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /*

    protected function guard()
    {
    return Auth::guard('admin');
    }


    */



    //Admin login form

    public function showLoginForm()
    {
        return view('auth.admin.login');
    }


    public function login(Request $request){

        // check the validation

         $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required',
        ]);

    
            if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password], $request->remember)){
                // Then login him
                // Intended function ta login hoar por index page e patiye dibe
                return redirect()->intended(route('admin.index'));
            }else{
                // Password or email bhul dile msg show korbe
                session()->flash('sticky_error','Invalid Email or Password!!');
              return back();
            }

}


   public function logout(Request $request)
    {


      Auth::guard('admin')->logout();
      // $this->guard()->logout();

       //return $this->loggedOut($request) ?: redirect('/admin/login');

        return redirect()->route('admin.login');
    }


}
