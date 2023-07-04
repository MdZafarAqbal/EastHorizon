<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class City extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'cities';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name', 'state_id', 'country_id', 'status'];

  /**
   * Get the orders for the city.
   */
  public function orders()
  {
    return $this->hasMany(Order::class, 'city_id');
  }
  
  /**
   * Get the shippings for the city.
   */
  public function shippings()
  {
    return $this->hasMany(Shipping::class, 'city_id');
  }

  /**
   * Get the state that owns the city.
   */
  public function state()
  {
    return $this->belongsTo(State::class, 'state_id');
  }
  
  /**
   * Get the country that owns the city.
   */
  public function country()
  {
    return $this->belongsTo(Country::class, 'country_id');
  }

  /**
   * The model's default values for attributes.
   *
   * @var array
   */
  protected $attributes = [
    'status' => 'inactive'
  ];
}