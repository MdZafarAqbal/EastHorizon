<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class Banner extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'banners';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name', 'slug', 'photo_mobile', 'photo_tablet', 'photo_desktop', 'status'];

  /**
   * The model's default values for attributes.
   *
   * @var array
   */
  protected $attributes = [
    'status' => 'active'
  ];
}
