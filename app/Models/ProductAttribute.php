<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CartItem;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ProductAttribute extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'product_attributes';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['flu', 'product_id', 'form_id', 'sku', 'size', 'price', 'discount', 'stock', 'status'];
  
  /**
   * Get the product that owns the attribute.
   */
  public function product()
  {
    return $this->belongsTo(Product::class, 'product_id');
  }
  
  /**
   * Get the form that owns the attribute.
   */
  public function form()
  {
    return $this->belongsTo(Form::class, 'form_id');
  }

  /**
   * The model's default values for attributes.
   *
   * @var array
   */
  protected $attributes = [
    'status' => 'active', 
    'form_id' => 'NULL'
  ];
}

