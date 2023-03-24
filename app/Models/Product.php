<?php

namespace App\Models;

use App\Http\Traits\FilterByUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use FilterByUser;
    protected $fillable = ['name','price','sale_price','stock','stock_alert','status','owner_id'];
    public function SaleProduct(){
        return $this->hasMany('App\Models\Sale');
    }

    public function PurchaseProduct(){
        return $this->hasMany('App\Models\Purchase');
    }
    public function ProductionProduct(){
        return $this->hasMany('App\Models\ProductionHistory');
    }
}
