<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Notification extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'notifications';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['type', 'notifiable', 'data', 'read_at'];
  
  /**
   * Get the user that owns the message.
   */
  public function user()
  {
    return $this->belongsTo(User::class, 'user_id');
  }
}

