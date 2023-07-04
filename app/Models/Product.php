<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
  */
  protected $table = 'products';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   *
   * 
   */
  protected $fillable = ['plu', 'name', 'slug', 'model_no' ,'description', 'photo','price', 'promotion', 'status'];
  
  /**
   * Get the cart items for the product.
   */
  public function cart_items()
  {
    return $this->hasMany(CartItem::class, 'product_id');
  }

  /**
   * Get the order items for the product.
   */
  public function order_items()
  {
    return $this->hasMany(OrderItem::class, 'product_id');
  }

  /**
   * Get the product images for the product.
   */
  public function images()
  {
    return $this->hasMany(ProductImage::class, 'product_id');
  }
  
  /**
   * Get the product attributes for the product.
   */
  public function attrs()
  {
    return $this->hasMany(ProductAttribute::class, 'product_id');
  }

  /**
   * Get the product reviews for the product.
   */
  public function reviews()
  {
    return $this->hasMany(ProductReview::class, 'product_id');
  }
  
  /**
   * Get the wishlists for the product.
   */
  public function wishlists()
  {
    return $this->hasMany(Wishlist::class, 'product_id');
  }

  /**
   * The brands that belong to the product.
  */
  public function brands()
  {
    return $this->belongsToMany(Brand::class, 'product_brands', 'product_id', 'brand_id');
  }
  
  /**
   * The categories that belong to the product.
  */
  public function categories()
  {
    return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'cat_id');
  }

  /**
   * The subcategories that belong to the product.
  */
  public function subcat()
  {
    return $this->belongsToMany(SubCategory::class, 'product_categories', 'product_id', 'subcat_id');
  }

  
}
?>