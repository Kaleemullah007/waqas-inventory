<?php

namespace App\Models;

use App\Http\Traits\FilterByUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    use FilterByUser;
    protected $fillable = ['sale_price','product_id','user_id','qty','owner_id','total','paid_amount','remaining_amount','payment_method','payment_status'];
}
