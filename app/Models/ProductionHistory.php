<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'qty',
        'wastage_qty',
        'is_production',
        'is_wastage',
        'owner_id',
        'product_id',
        'purchase_id'
    ];
}
