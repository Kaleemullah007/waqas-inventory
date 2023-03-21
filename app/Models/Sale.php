<?php

namespace App\Models;

use App\Http\Traits\FilterByUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    use HasFactory;
    use FilterByUser;
    protected $fillable = ['sale_price','product_id','user_id','qty','owner_id','total','paid_amount','discount','remaining_amount','payment_method','payment_status'];


    public function Customer():BelongsTo
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }


    public function Product():BelongsTo
    {
        return $this->belongsTo('App\Models\Product','product_id','id');
    }

}
