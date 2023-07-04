<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
class ProductReview extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'product_reviews';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['user_id', 'product_id', 'rating', 'review', 'status'];
  
  /**
   * Get the product that owns the review.
   */
  public function product()
  {
    return $this->belongsTo(Product::class, 'product_id');
  }
  
  /**
   * Get the user that owns the review.
   */
  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  /**
   * The model's default values for attributes.
   *
   * @var array
   */
  protected $attributes = [
    'status' => 'active'
  ];
}
