<?php

namespace App\Models;

use App\Http\Traits\FilterByUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use FilterByUser;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'sale_price',
        'product_id',
        'user_id',
        'total_qty',
        'owner_id',
        'total',
        'paid_amount',
        'discount',
        'remaining_amount',
        'payment_method',
        'payment_status',
        'payment_due_date',
        'sub_total_cost',
        'cost_total',
        'sub_total',
        'due_date',
        'serial',
        'serial_number',
        'serial_series',
    ];

    protected $casts = ['due_date' => 'date'];

    public function Customer(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function Product(): BelongsTo
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

    public function Products(): HasMany
    {
        return $this->HasMany('App\Models\SaleProduct', 'sale_id', 'id');
    }

    public function saleProducts(): HasMany
    {
        return $this->hasMany(SaleProduct::class);
    }
    // protected function amount(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn($value) => $value / 100,
    //         set: fn($value) => $value * 100,
    //     );
    // }

}
