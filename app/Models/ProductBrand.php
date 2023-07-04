<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBrand extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'product_brands';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['product_id', 'brand_id'];
}

