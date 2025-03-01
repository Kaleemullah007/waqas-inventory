<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'sale_id',
        'product_name',
        'qty',
        'cost_price',
        'sale_price',
    ];
}
