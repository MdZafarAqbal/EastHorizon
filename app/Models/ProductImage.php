<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'product_images';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name', 'product_id', 'status'];
  
  /**
   * Get the product that owns the image.
   */
  public function product()
  {
    return $this->belongsTo(Product::class, 'product_id');
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
