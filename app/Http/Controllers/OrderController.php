<?php

namespace App\Http\Controllers;

use App\Mail\OrderCancel;
use App\Mail\OrderReturn;
use App\Models\CancelItem;
use App\Models\CartItem;
use App\Models\City;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\ReturnItem;
use App\Models\Shipping;
use App\Notifications\StatusNotification;
use App\User;
use Auth;
use Carbon\Carbon;
use Hash;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mail;
use Notification;
use PDF;
use Session;

class OrderController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $orders = Order::orderBy('id', 'DESC')->paginate(10);
    return view('admin_panel.order.index')->with('orders',$orders);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $order = Order::find($id);
    return view('admin_panel.order.show')->with('order', $order);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $order = Order::find($id);
    return view('admin_panel.order.edit')->with('order',$order);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    $current_date=Carbon::now()->toDateString();
    $order=Order::with('shipping', 'payment')->where('id', $id)->get()[0];
    
    if($request->shipping_status == 'processed')
      $order->shipping->processed = $current_date;
    
    if($request->shipping_status == 'shipped')
      $order->shipping->shipped = $current_date;
    
    if($request->shipping_status == 'delivered') 
      $order->shipping->delivered = $current_date;

    $order->status = $request->order_status;
    $order->payment->status = $request->payment_status;
    $order->shipping->status = $request->shipping_status;

    $order->save();
    $order->shipping->save();
    $order->payment->save();
      
    return redirect()->route('order.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $order=Order::find($id);
    if($order){
      $status=$order->delete();
      if($status){
        request()->session()->flash('success','Order Successfully deleted');
      }
      else{
        request()->session()->flash('error','Order can not deleted');
      }
      return redirect()->route('order.index');
    }
    else{
      request()->session()->flash('error','Order can not found');
      return redirect()->back();
    }
  }

  /**
   * Store a newly created order in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function place_order(Request $request) {
    $current_month = Carbon::now()->month;
    $current_year = Carbon::now()->year;
    $current_date = Carbon::now()->toDateString();

    $this->validate($request, [
      'cust_type' => 'required|string'
    ]);
    
    if($request['cust_type'] == 'individual') {
      $this->validate($request, [
        'fname' => 'required|regex: /^[a-zA-Z ].{2,}$/',
        'lname' => 'required|regex: /^[a-zA-Z ].{2,}$/'
      ]);
    } else {
      $this->validate($request, [
        'cname' => 'required|string',
        'trn_no' => 'required|regex: /^(\d *){15}$/'
      ]);
    }
    
    $this->validate($request, [
      'email' => 'required|email:strict,dns',
      'address'=>'required|string',
      'landmark'=>'nullable|string',
      'country'=>'required|numeric',
      'state'=>'required|numeric',
      'city' => 'required|numeric',
      'phone' => [
        'required',
        'regex: /^(?:50|52|54|55|56|58|1|2|3|4|6|7|8|9)( *\d *){7}$/'
      ],
      'altphone' => [
        'nullable',
        'regex: /^(?:50|52|54|55|56|58|1|2|3|4|6|7|8|9)( *\d *){7}$/'
      ]
    ]);
    
    if($request['shipping_option'] == 'different') {
      $this->validate($request, [
        'shipping_fname' => 'required|regex: /^[a-zA-Z ].{2,}$/',
        'shipping_lname' => 'required|regex: /^[a-zA-Z ].{2,}$/',
        'shipping_address'=>'required|string',
        'shipping_landmark'=>'nullable|string',
        'shipping_country' => 'required|numeric',
        'shipping_state' => 'required|numeric',
        'shipping_city' => 'required|numeric',
        'shipping_phone' => [
          'required',
          'regex: /^(?:50|52|54|55|56|58|1|2|3|4|6|7|8|9)( *\d *){7}$/'
        ],
        'shipping_altphone' => [
          'nullable',
          'regex: /^(?:50|52|54|55|56|58|1|2|3|4|6|7|8|9)( *\d *){7}$/'
        ]
      ]);
    }
    
    if($request['pay_mthd'] == 'op') {
      $this->validate($request, [
        'account_no' => [
          'required',
          'regex: /^(?:4(\d *){12}(?:(\d *){3})?|(?:5[1-5](\d *){2}|222[1-9]|22[3-9](\d *)|2[3-6](\d *){2}|27[01](\d *)|2720)(\d *){12})$/'
        ],
        'account_name' => 'required|regex: /^[a-zA-Z ].{2,}$/',
        'cvv_cvc' => 'required|regex: /(?!000)\d{3}/',
        'expiry_month' => 'required|regex: /(?!00)\d{2}/',
        'expiry_year' => 'required|regex: /(?!0000)\d{4}/|gte:' . $current_year . '|lte: ' . ($current_year+5) . ''
      ]);
    }
    
    if($request['expiry_year'] == $current_year) {
      $this->validate($request, [
        'expiry_month' => 'gte:' . $current_month . ''
      ]);
    }
    
    if(Auth::check()) {
      if(empty(CartItem::where('user_id', Auth()->user()->id)->get()))
        return back()->with('error', 'Your cart is empty. Add items to cart for checkout.');
    }
    else { 
      if(empty(Session::get('cart')))
        return back()->with('error', 'Your cart is empty. Add items to cart for checkout.');
    }
    
    $order = new Order();
    $order->order_no = 'HC-' . $this->generateUniqueCode();
    if(Auth::check())
      $order->user_id = $request->user()->id;
    $order->fname = $request->fname;
    $order->lname = $request->lname;
    $order->cname = $request->cname;
    $order->trn_no = $request->trn_no;
    $order->email = $request->email;
    $order->phone = $request->phone;
    $order->altphone = $request->altphone;
    $order->address = $request->address;
    $order->city_id = $request->city;
    $order->landmark = $request->landmark;
    $order->save();

    $subtotal = Helper::CartAmount();
    $tax = Helper::totalCartTax();
    $discount = Helper::total_discount();
    $total = Helper::totalCartAmount();
    
    if($total > 100)
      $shipping = 0;
    else {
      $shipping = City::where('id', $request->city)->pluck('shipping')->first();
      $total += $shipping;
    }
    
    $payment = new Payment();
    $payment->order_id = $order->id;
    $payment->account_name = $request->account_name;
    $payment->method = $request->pay_mthd;
    $payment->subtotal = $subtotal;
    $payment->tax = $tax;
    $payment->shipping = $shipping;
    $payment->discount = $discount;
    $payment->total = $total;
    
    if($request['pay_mthd'] == 'op') {
      $req = new Request;
      $req->account_no = $request->account_no;
      $req->name = $request->account_name;
      $req->expiry_month = $request->expiry_month;
      $req->expiry_year = $request->expiry_year;
      $req->cvv_cvc = $request->cvv_cvc;
      $req->total = $total;
      $req->account_name = $request->account_name;
      $req->order_id = $order->id;

      $response = (new StripeController)->payment($req);
      $pay = $response[0];
      $message = $response[1];

      if($pay) {
        $payment->charge_id = $pay->id;
        $payment->account_no = $pay->source->last4;
        if($pay->status == 'succeeded') {
          $payment->status = 'paid';
        }
      } else {
        $order->delete();
        return back()->with('error', $message);
      }
    }

    $payment->save();
    
    $shippings = new Shipping();
    $shippings->order_id = $order->id;
    if($request->shipping_option == 'different') {
      $shippings->fname = $request->shipping_fname;
      $shippings->lname = $request->shipping_lname;
      $shippings->phone = $request->shipping_phone;
      $shippings->altphone = $request->shipping_altphone;
      $shippings->address = $request->shipping_address;
      $shippings->city_id = $request->shipping_city;
      $shippings->landmark = $request->shipping_landmark;
    } else {
      $shippings->fname = $request->fname;
      $shippings->lname = $request->lname;
      $shippings->cname = $request->cname;
      $shippings->trn_no = $request->trn_no;
      $shippings->phone = $request->phone;
      $shippings->altphone = $request->altphone;
      $shippings->address = $request->address;
      $shippings->city_id = $request->city;
      $shippings->landmark = $request->landmark;
    }
    $shippings->ordered = $current_date;
    $shippings->save();
    
    if(Auth::check()) {
      $carts = CartItem::where('user_id', Auth::user()->id)->get();
    } else {
      $carts = Session::get('cart');
    }
      
    foreach($carts as $cart) {
      $order_item = new OrderItem;
      $order_item->order_id = $order->id;
      $order_item->product_id = $cart->product_id;
      $order_item->price = $cart->price;
      $order_item->quantity = $cart->quantity;
      $order_item->subtotal = $cart->subtotal;
      $order_item->tax = $cart->tax;
      if(Auth::check()) {
        $order_item->discount = $cart->discount;
        $order->save();
      }
      $order_item->total = $cart->total;
      $order_item->save();
    }

    if(Auth::check()) {  
      CartItem::where('user_id', Auth::user()->id)->delete();
    } else {
      Session::pull('cart');
      Session::pull('id');
    }
    
    // Notification::send(Auth()->user(), new StatusNotification('Order Placed'));
    $re = new Request;
    $re->id = $order->id;

    $sale_pdf = $this->sale_invoice($re);  
    (new MailController)->order_mail($request->email, $sale_pdf);

    return back()->with(['order_success' => true, 'order_no' => $order->order_no]);
  }

  public function user_orders (Request $request) {
    if(Auth::check()) {
      $orders = Order::with('payment')->where('user_id', Auth()->user()->id)->orderBy('created_at', 'desc')->get();
      
      if(count($orders) == 0) {
        $orders = false;
      }
    } else {
      $orders = false;
    }
    
    return view('frontend.pages.orders')->with('orders', $orders);
  }

  public function order_detail (Request $request) {
    if(!$request->order_no) {
      return back()->with('error', 'Invalid order no');
    }

    $order = Order::with('payment', 'shipping')->where('order_no', $request->order_no)->first();

    if($order) {
      $shipping = $order->shipping;
      $cancel = false;
      $return = false;
      $date = Carbon::now()->subDays(15)->toDateString();
      
      if($shipping->status == 'ordered' && $shipping->shipped == null ) {
        $cancel = true;
      }

      if ($order->status == 'completed') {
        if($shipping->delivered > $date) {
          $return = true;
        }
      }
    }
    else {
      return back()->with('error', 'Invalid order no');
      $cancel = false;
      $return = false;
      $order = false;
    }

    return view('frontend.pages.order-detail')->with(['order' => $order, 'return' => $return, 'cancel' => $cancel]);
  }

  public function track_order(Request $request) {
    $order = Order::with('shipping')->where('order_no', $request->order_no)->first();

    return view('frontend.pages.order-track')->with('order', $order);
  }

  public function action_view(Request $request) {
    $order = Order::with('order_items')->where('order_no', $request->order_no)->first();
    $cancel = false;
    $return = false;

    if($request->cancel) {
      $cancel = true;
    }

    if($request->return) {
      $return = true;
    }

    return view('frontend.pages.order-action')->with(['order' => $order, 'cancel' => $cancel, 'return' => $return]);
  }

  // Email confirmation for cancel items
  public function action_email(Request $request) {
    $code = random_int(100000, 999999);
    $hash = Hash::make($code);
    Session::put('code', $hash);
    $order = Order::findOrFail($request->id);
    
    if($request->action == 'cancel') {
      Mail::to($order->email)->send(new OrderCancel($order, $code));
    }
    elseif($request->action == 'return') {
      Mail::to($order->email)->send(new OrderReturn($order, $code));
    }
  }

  // Cancel order items
  public function cancel_order(Request $request) {
    $order = Order::with('payment', 'order_items', 'shipping.city')->where('id', $request->id)->first();
    
    if(Hash::check($request->otp, Session::get('code'))) {
      if($request->all == 1) {
        $order->status = 'cancelled';
        foreach($order->order_items as $item) {
          $properties = collect($item->toArray())->only(['order_id', 'product_id', 'price', 'quantity', 'discount', 'total'])->all();
          
          $cancel = new CancelItem;
          $cancel->fill($properties);
          $cancel->reason = $request->reason;
          
          $order->payment->cancelled += $cancel->total;
          $order->payment->subtotal -= $item->subtotal;
          $order->payment->tax -= $item->tax;
          $order->payment->discount -= $item->discount;
          $order->payment->total = $order->payment->subtotal + $order->payment->tax - $order->payment->discount;
          
          $cancel->save();
          $item->delete();
        }
        
        $order->save();
      } else {
        foreach($request->items as $id) {
          $item = $order->order_items->where('id', $id)->first();
          $properties = collect($item->toArray())->only(['order_id', 'product_id', 'price', 'quantity', 'discount', 'total'])->all();
          
          $cancel = new CancelItem;
          $cancel->fill($properties);
          $cancel->reason = $request->reason;
          
          $order->payment->cancelled += $cancel->total;
          $order->payment->subtotal -= $item->subtotal;
          $order->payment->tax -= $item->tax;
          $order->payment->discount -= $item->discount;
          $order->payment->total = $order->payment->subtotal + $order->payment->tax - $order->payment->discount;
          
          $cancel->save();
          $item->delete();
        }
      }
      
      if($order->payment->total > 0 && $order->payment->total < 100) {
        $order->payment->shipping = $order->shipping->city->shipping;
      } else {
        $order->payment->shipping = 0;
      }

      if($order->payment->status == 'paid') {
        $refund = $order->payment->cancelled - $order->payment->shipping;
        $order->payment->refund = $refund;
      }

      $order->payment->total += $order->payment->shipping;
      $order->payment->save();
      return back()->with('success', 'item cancelled successfully');
    } else {
      return back()->with('error', 'Incorrect OTP');
    }
  }

  // Return order items
  public function return_order(Request $request) {
    $order = Order::with('payment', 'order_items', 'shipping.city')->where('id', $request->id)->first();

    if($request->all == 1) {
      $order->status = 'returned';
      foreach($order->order_items as $item) {
        $properties = collect($item->toArray())->only(['order_id', 'product_id', 'price', 'quantity', 'discount', 'total'])->all();

        $return = new ReturnItem;
        $return->fill($properties);
        $return->reason = $request->reason;

        $order->payment->returned += $return->total;
        $order->payment->subtotal -= $item->subtotal;
        $order->payment->tax -= $item->tax;
        $order->payment->discount -= $item->discount;
        $order->payment->shipping = $order->shipping->city->shipping;
        $order->payment->total = $order->payment->subtotal + $order->payment->tax - $order->payment->discount;

        $return->save();
        $item->delete();
      }

      $order->save();
    } else {
      foreach($request->items as $id) {
        $item = $order->order_items->where('id', $id)->first();
        $properties = collect($item->toArray())->only(['order_id', 'product_id', 'price', 'quantity', 'discount', 'total'])->all();

        $return = new ReturnItem;
        $return->fill($properties);
        $return->reason = $request->reason;

        $order->payment->returned += $return->total;
        $order->payment->subtotal -= $item->subtotal;
        $order->payment->tax -= $item->tax;
        $order->payment->discount -= $item->discount;
        $order->payment->total = $order->payment->subtotal + $order->payment->tax - $order->payment->discount;
        
        $return->save();
        $item->delete();
      }
    }

    if($order->payment->total >= 0 && $order->payment->total < 100) {
      $order->payment->shipping = $order->shipping->city->shipping;
    } else {
      $order->payment->shipping = 0;
    }

    if($order->payment->status == 'paid') {
      $refund = $order->payment->returned - $order->payment->shipping;
      $order->payment->refund = $refund;
    }

    $order->payment->total += $order->payment->shipping;
    $order->payment->save();
  }

  // Sale invoice generate
  public function sale_invoice(Request $request) {
    $order = Order::with('order_items', 'payment', 'shipping')->where('id', $request->id)->first();
    $file_name = $order->order_no.'-'.$order->fname.'.pdf';
    
    $pdf = PDF::loadview('frontend.order.sale-invoice', compact('order'));

    if($request->download == 1) {
      return $pdf->download($file_name);
    }
    
    return $pdf->output();
  }

  // Tax invoice generate
  public function tax_invoice(Request $request) {
    $order = Order::with('order_items', 'payment', 'shipping')->where('id', $request->id)->get()[0];
    $file_name = $order->order_no.'-'.$order->fname.'.pdf';
    
    $pdf = PDF::loadview('frontend.order.tax-invoice', compact('order'));

    if($request) {
      if($request->download == 1)
        return $pdf->download($file_name);
    }
    
    return $pdf->output();
  }

  /**
   * Generate unique code for orders
   *
   * @return response()
   */
  public function generateUniqueCode()
  {
    do {
      $code = random_int(1000000, 9999999);
    } while (Order::where("order_no", $code)->first());

    return $code;
  } 

  // Income chart
  public function incomeChart(Request $request){
    $year=\Carbon\Carbon::now()->year;
    // dd($year);
    $items=Order::with(['order_items'])->whereYear('created_at',$year)->where('status','completed')->get()
        ->groupBy(function($d){
            return \Carbon\Carbon::parse($d->created_at)->format('m');
        });
        // dd($items);
    $result=[];
    foreach($items as $month=>$item_collections){
      //dd($items);
        foreach($item_collections as $item){
            $amount=$item->order_items->sum('total');
            $m=intval($month);
            isset($result[$m]) ? $result[$m] += $amount :$result[$m]=$amount;
        }
    }
    $data=[];
    for($i=1; $i <=12; $i++){
        $monthName=date('F', mktime(0,0,0,$i,1));
        $data[$monthName] = (!empty($result[$i]))? number_format((float)($result[$i]), 2, '.', '') : 0.0;
    }
    return $data;
  }
}
?>
