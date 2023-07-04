<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buying extends Model
{
    use HasFactory;
    protected $table = 'buyings';
    protected $fillable = [
        'buying_name',
        'mobile_no',
        'product_name',
        'serial_no',
        'imei_no',
        'qty',
        'price',
        'total',
    ];
}
