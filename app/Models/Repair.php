<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;
    protected $table = 'repairs';

    protected $fillable = [
        'user_name',
        'mobile_no',
        'product_name',
        'serial_no',
        'imei_no',
        'problem',
        'photo',
        'charge',
    ];
}
