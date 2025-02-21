<?php

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Builder;

trait FilterByUser
{
    public static function boot()
    {
        parent::boot();

        self::addGlobalScope(function (Builder $builder) {

            $role = 'vendor';
            if (isset(auth()->user()->user_type)) {
                $role = auth()->user()->user_type;
            }

            if ($role == 'vendor') {
                $builder->where('owner_id', auth()->id());
            } elseif ($role == 'admin') {
                // It'll show all record
            }
        });
    }
}
