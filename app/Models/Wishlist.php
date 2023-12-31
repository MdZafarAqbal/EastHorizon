<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Wishlist extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'wishlists';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['user_id','product_id'];
  
  /**
   * Get the user that owns the wishlist.
   */
  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  /**
   * Get the product that owns the wishlist.
   */
  public function product()
  {
    return $this->belongsTo(Product::class, 'product_id');
  }
}
