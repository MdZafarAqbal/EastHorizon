<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Settings extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'settings';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['description', 'short_des', 'logo', 'photo', 'address', 'phone', 'email'];
}
