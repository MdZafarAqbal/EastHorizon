<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Brand extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'brands';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name', 'slug', 'status'];

  /**
   * The products that belong to the brand.
  */
  public function products()
  {
    return $this->belongsToMany(Product::class, 'product_brands', 'brand_id', 'product_id');
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
