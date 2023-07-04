<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'payments';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['order_id', 'charge_id', 'account_no', 'method', 'status', 'subtotal', 'tax', 'shipping', 'discount', 'cancelled', 'returned', 'refund', 'total'];
  
  /**
   * Get the order that owns the payment.
   */
  public function order()
  {
    return $this->belongsTo(Order::class, 'order_id');
  }
  
  /**
   * The model's default values for attributes.
   *
   * @var array
   */
  protected $attributes = [
    'method' => 'cod',
    'status' => 'unpaid',
  ];
}
