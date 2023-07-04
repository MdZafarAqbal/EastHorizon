<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'states';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name', 'country_id', 'status'];

  /**
   * Get the cities for the state.
   */
  public function cities()
  {
    return $this->hasMany(City::class, 'state_id');
  }

  /**
   * Get the country that owns the state.
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
