<?php

namespace App\Http\Controllers;
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Http\Request;
use NunoMaduro\Collision\Provider;
use App\Models\CartItem;
use App\Models\Product;
use DB;
class PaypalController extends Controller
{
    public function payment()
    {
        $cart = CartItem::where('user_id',auth()->user()->id)->where('order_id',null)->get()->toArray();
      //  \Stripe\Stripe::setApiKey('sk_test_51LjzKRJe1uNOXrEYe7FfdpR4FroSl4AU0pUQZhvAmgkCYVkXn9adzZKCHUXwkxfLECcEcowI8oHhhTigQpwN3nva00HjVkJmVV');
        $data = [];
        
        // return $cart;
        $data['items'] = array_map(function ($item) use($cart) {
            $name=Product::where('id',$item['product_id'])->pluck('name');
            return [
                // 'paypalToken' => $paypalToken,
                'name' =>$name ,
                'price' => $item['price'],
                'currency' => 'AED',
                'desc'  => 'Thank you for using paypal',
                'qty' => $item['quantity']
            ];
        }, $cart);
        
        $data['invoice_id'] ='HRD-'.strtoupper(uniqid());
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        
        $total = 0;
        foreach($data['items'] as $item) {
            $total += $item['price']*$item['qty'];
        }

        $data['total'] = $total;
        
        CartItem::where('user_id', auth()->user()->id)->where('order_id', null)->update(['order_id' => session()->get('id')]);

        // return session()->get('id');
        $provider = new ExpressCheckout;
  
        $response = $provider->setExpressCheckout($data);
    //    echo "<pre>"; print_r($response); die();
        return redirect()->back();
    }
   
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        dd('Your payment is canceled. You can create cancel page here.');
    }
  
    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);
        // return $response;
  
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            request()->session()->flash('success','You successfully pay from Paypal! Thank You');
            session()->forget('cart');
            return redirect()->route('home');
        }
  
        request()->session()->flash('error','Something went wrong please try again!!!');
        return redirect()->back();
    }
}
