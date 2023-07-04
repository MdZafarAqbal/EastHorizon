<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Redirect;
use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Session;
use Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('guest')->except('logout');
    }

  // Login
  public function login(Request $request){
    return view('frontend.pages.login')->with('checkout', $request->checkout);
  }
    
  public function loginSubmit(Request $request) {
    $this->validate($request, [
      'email' => 'required|email:strict,dns|exists:users',
      'password' => 'required'
    ]);

    if ($request->remember)
      $remember = true;
    else
      $remember = false;

    if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
      $cart_items = Session::get('cart');

      foreach($cart_items as $item) {
        $already_cart = CartItem::where(['user_id' => Auth()->user()->id, 'product_id' => $item->product_id])->first();
        $order = Order::where('user_id', Auth()->user()->id)->first();
        $discount = 0;
  
        if ($already_cart) {
          $quantity = $item->quantity;
          $total = $item->price * $quantity;
          $subtotal = $total / 1.05;
          $tax = $total - $subtotal;
          $already_cart->quantity += $quantity;
          $already_cart->total += $total + $already_cart->discount;
  
          if(! $order) {
            $discount += $already_cart->total / 10;
            $already_cart->total -= $discount;
          }
          
          $already_cart->discount = $discount;
          $already_cart->subtotal += $subtotal;
          $already_cart->tax += $tax;
          $already_cart->save();
  
        } else {
          $carts = CartItem::where('user_id', Auth()->user()->id)->get();
          $discount = 0;
  
          $cart = new CartItem;
          $cart->user_id = Auth()->user()->id;
          $cart->product_id = $item->product_id;
          $cart->price = $item->price;
          $cart->quantity = $item->quantity;
          $cart->total = $item->price * $item->quantity;
          $cart->subtotal = $cart->total / 1.05;
          $cart->tax = $cart->total - $cart->subtotal;          
          if(!$order) {
            $discount += $cart->total / 10;
            $cart->total -= $cart->total / 10;
          }
  
          $cart->discount = $discount;
          $cart->save();
        }
      }

      Session::pull('cart');
      Session::pull('id');
      Session::put('user', $request->email);
      if($request->checkout == 1)
        return redirect()->route('checkout');
      return redirect()->route('home');
    } else {
      return redirect()->back()->with('error','Incorrect password. Please try again!');
    }
  }

  public function user_exists(Request $request) {
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
