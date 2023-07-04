<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{
  public function order_mail($email, $pdf) {
    $data = [];
    Mail::send('emails.orders.confirmation', $data, function($message)use($email, $pdf) {
      $message->to($email)->subject('Order Confirmation');

      $message->attachData($pdf, 'order_details.pdf');         
    });

    Mail::send('emails.orders.confirmation', $data, function($message)use($data, $pdf) {
      $message->to("admin@East Horizon.ae")->subject('Order Confirmation');

      $message->attachData($pdf, 'order_details.pdf');         
    });
  }

  public function cancel_mail($email, $otp) {
    Mail::send('frontend.order.cancel-mail', $data, function($message)use($email, $pdf) {
      $message->to($email)->subject('Order Cancel Confirmation');

      $message->attachData($pdf, 'order_details.pdf');         
    });

    Mail::send('frontend.order.mail', $data, function($message)use($data, $pdf) {
      $message->to("admin@East Horizon.ae")->subject($data["title"]);

      $message->attachData($pdf, 'order_details.pdf');         
    });
  }
}
