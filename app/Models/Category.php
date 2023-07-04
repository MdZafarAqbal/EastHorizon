<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\ProductsAttribute;

class Category extends Model

{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'categories';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name', 'slug', 'status'];

  /**
   * Get the subcategories for the category.
   */
  public function subcat()
  {
    return $this->hasMany(SubCategory::class, 'parent_id');
  }


  /**
   * The products that belong to the category.
  */
  public function products()
  {
    return $this->belongsToMany(Product::class, 'product_categories', 'cat_id', 'product_id');
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