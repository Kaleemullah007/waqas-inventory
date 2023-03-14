<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function SaleProduct(){
        return $this->hasMany('App\Models\Sale');
    }

    public function PurchaseProduct(){
        return $this->hasMany('App\Models\Purchase');
    }
}
