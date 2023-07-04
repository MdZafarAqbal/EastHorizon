<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Redirect;
use Session;

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

  /**
   * Where to redirect users after registration.
   *
   * @var string
   */
  protected $redirectTo = 'verify-email';

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
   * Validate user register request.
   * create user in database.
   * request email verification.
   *
   * @param  \Illuminate\Http\Request $request
  */

  public function register_submit(Request $request) {
    $this->validate($request, [
      'cust_type' => 'required|string',
    ]);
    
    if($request['cust_type'] == 'individual') {
      $this->validate($request, [
        'fname' => 'required|regex:/^[a-zA-Z ].{3,}$/',
        'lname' => 'required|regex:/^[a-zA-Z ].{3,}$/'
      ]);
    } else {
      $this->validate($request, [
        'cname' => 'required|string|min:3',
        'trn_no' => 'required|min_digits:15'
      ]);
    }
    
    $this->validate($request, [
      'email' => 'required|email:strict,dns|unique:users',
      'password' => 'required|confirmed|regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[<>\{\}";:.,~!?@#$%^=&*\[\]\(\)¿§«»ω⊙¤°℃℉€¥£¢¡®©_\-+\^]).{8,}$/'
    ]);
    
    $user = User::create([
      'fname' => $request->fname,
      'lname' => $request->lname,
      'cname' => $request->cname,
      'trn_no' => $request->trn_no,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]); 
    
    if($user){
      Session::put('user', $request->email);
      Auth::attempt(['email' => $request->email, 'password' => $request->password]);
      event(new Registered($user, $request->password));
      return redirect()->route('verification.email')->with('success', 'Thankyou for registration. Please verify your email.');
    }

    else{
      return back()->with('error', 'Something went wrong. Please try again!');
    }
  }

  public function already_user(Request $request) {
    if($request->email) {
      $user = User::where('email', $request->email)->first();
      if($user) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
}
