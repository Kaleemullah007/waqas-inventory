<?php

namespace App\Models;

use App\Http\Traits\FilterByUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    use FilterByUser;
    protected $fillable = ['sale_price','price','product_id','user_id','qty','owner_id'];
}
