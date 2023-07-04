<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;
    protected $table = 'sellers';
    protected $fillable = [
        'seller_name',
        'mobile_no',
        'product_name',
        'serial_no',
        'imei_no',
        'qty',
        'price',
        'total',
    ];
}
