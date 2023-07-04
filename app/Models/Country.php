<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'countries';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name', 'capital', 'iso_code', 'lang', 'currency', 'currency_name', 'currency_symbol', 'calling_code', 'tld', 'flag_icon', 'region', 'time_zone', 'date_format', 'status'];

  /**
   * Get the states for the country.
   */
  public function states()
  {
    return $this->hasMany(State::class, 'country_id');
  }
  
  /**
   * Get the cities for the country.
   */
  public function cities()
  {
    return $this->hasMany(City::class, 'country_id');
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
