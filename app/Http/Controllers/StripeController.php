<?php

namespace App\Http\Controllers;
use DB;
use Helper;
use Stripe;
use Session;
use App\Models\Order;

use Illuminate\Http\Request;

class StripeController extends Controller {
  public function payment(Request $request) {
    Stripe\Stripe::setApiKey(env('STRIPE_SECRET', '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'));

    $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET', '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'));
    try {
      $token = $stripe->tokens->create([
        'card' => [
          'number' => $request->account_no,
          'name' => $request->name,
          'exp_month' => $request->expiry_month,
          'exp_year' => $request->expiry_year,
          'cvc' => $request->cvv_cvc
        ],
      ]);
      
      $payment = $stripe->charges->create ([
        "amount" => $request->total * 100,
        "currency" => "aed",
        "source" => $token,
        "metadata" => ["name" => $request->account_name, "order_id" => $request->order_id],
        "description" => "Online Payment"
      ]);

      $message = "Your payment was successful";

      return [$payment, $message];
    } catch(\Stripe\Exception\CardException $e) {
      $message = "Card Error: {$e->getError()->message}";
    } catch (\Stripe\Exception\RateLimitException $e) {
      $message = "RateLimit Error: {$e->getError()->message}";
    } catch (\Stripe\Exception\InvalidRequestException $e) {
      $message = "Invalid Request: {$e->getError()->message}";
    } catch (\Stripe\Exception\AuthenticationException $e) {
      $message = "Authentication Error: {$e->getError()->message}";
    } catch (\Stripe\Exception\ApiConnectionException $e) {
      $message = "Connection Error: {$e->getError()->message}";
    } catch (\Stripe\Exception\ApiErrorException $e) {
      $message = "API Error: {$e->getError()->message}";
    } catch (Exception $e) {
      $message = $e->getError()->message;
    }
    
    return [null, $message];
  }

  public function refund(Request $request) {
    Stripe\Stripe::setApiKey(env('STRIPE_SECRET', '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'));

    $order = Order::with('payment')->find($request->id);
    
    if($order->payment->refund < $request->refund)
      return back()->with('error', 'Invalid refund amount.');

    $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET', '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'));
    
    try {
      $refund = $stripe->refunds->create([
        'charge' => $order->payment->charge_id,
        'amount' => $request->refund * 100
      ]);

      
      if($refund->status == 'succeeded') {
        $order->payment->refund -= $request->refund;
        $order->payment->save();
      }
      
      $message = "Your refund was successful. Refund amount will show in your account within 7 to 15 days.";
      return back()->with('success', $message);

    } catch(\Stripe\Exception\CardException $e) {
      $message = "Card Error: {$e->getError()->message}";
    } catch (\Stripe\Exception\RateLimitException $e) {
      $message = "RateLimit Error: {$e->getError()->message}";
    } catch (\Stripe\Exception\InvalidRequestException $e) {
      $message = "Invalid Request: {$e->getError()->message}";
    } catch (\Stripe\Exception\AuthenticationException $e) {
      $message = "Authentication Error: {$e->getError()->message}";
    } catch (\Stripe\Exception\ApiConnectionException $e) {
      $message = "Connection Error: {$e->getError()->message}";
    } catch (\Stripe\Exception\ApiErrorException $e) {
      $message = "API Error: {$e->getError()->message}";
    } catch (Exception $e) {
      $message = $e->getError()->message;
    }
    
    return back()->with('error', $message);
  }
}
