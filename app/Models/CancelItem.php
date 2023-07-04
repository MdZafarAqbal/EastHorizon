<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelItem extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'cancel_items';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['order_id', 'product_id', 'form', 'size', 'price', 'quantity', 'discount', 'total', 'reason'];
  
  /**
   * Get the order that owns the order item.
   */
  public function order()
  {
    return $this->belongsTo(Order::class, 'order_id');
  }

  /**
   * Get the product that owns the order item.
   */
  public function product()
  {
    return $this->belongsTo(Product::class, 'product_id');
  }
}
