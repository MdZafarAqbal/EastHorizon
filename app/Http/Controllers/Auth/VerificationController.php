<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Email Verification Controller
  |--------------------------------------------------------------------------
  |
  | This controller is responsible for handling email verification for any
  | user that recently registered with the application. Emails may also
  | be re-sent if the user didn't receive the original email message.
  |
  */

  use VerifiesEmails;

  /**
   * Where to redirect users after verification.
   *
   * @var string
  */
  protected $redirectTo = '/home';

  /**
   * Create a new controller instance.
   *
   * @return void
  */
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('throttle:6,1');
    $this->middleware('not.verified');
    $this->middleware('signed')->only('emailVerification');
  }

  /**
   * Email Verification Handler.
   *
   *
   *
   * @return view
  */
  public function emailVerification(EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
  }

  /**
   * Resending a Verification Email.
   *
   *
   *
   * @return view
  */
  public function resendEmailVerification (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
  }
}
