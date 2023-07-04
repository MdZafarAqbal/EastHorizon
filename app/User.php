<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable implements MustVerifyEmail
{
  use Notifiable;
  use HasRoles;

  /**
   * The table associated with the model.
   *
   * @var string
  */
  protected $table = 'users';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   *
   * 
   */
  protected $fillable = ['fname', 'lname', 'cname', 'trn_no', 'email', 'password','role', 'status'];
  
  /**
   * Get the cart items for the user.
   */
  public function cart_items()
  {
    return $this->hasMany(CartItem::class, 'user_id');
  }
  
  /**
   * Get the messages for the user.
   */
  public function messages()
  {
    return $this->hasMany(Message::class, 'user_id');
  }
  
  /**
   * Get the orders for the user.
   */
  public function orders()
  {
    return $this->hasMany(Order::class, 'user_id');
  }

  /**
   * Get the product reviews for the user.
   */
  public function user_reviews()
  {
    return $this->hasMany(ProductReview::class, 'user_id');
  }

  /**
   * Get the wishlists for the user.
   */
  public function wishlists()
  {
    return $this->hasMany(Wishlist::class, 'user_id');
  }


  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
  */
  protected $hidden = ['password', 'remember_token'];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
  */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  /**
   * The model's default values for attributes.
   *
   * @var array
   */
  protected $attributes = [
    'status' => 'active'
  ];
}
