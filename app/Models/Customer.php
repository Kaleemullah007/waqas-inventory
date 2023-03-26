<?php

namespace App\Models;

use App\Http\Traits\FilterByUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{

    use HasFactory,FilterByUser
    ;
    protected $table = 'users';
    public function customerSale():HasMany
    {
        return $this->hasMany('App\Models\Sale','user_id','id');

    }
}
