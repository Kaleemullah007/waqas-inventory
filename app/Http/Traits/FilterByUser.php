<?php
namespace App\Http\Traits;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait FilterByUser{


    public  static function boot(){
       parent::boot();


        self::addGlobalScope(function(Builder $builder){

            $role = 'vendor';
            if(isset(auth()->user()->user_type)){
                $role = auth()->user()->user_type;
            }

            if ($role == 'vendor') {
                $builder->where('owner_id', auth()->id());
            }

            else if ($role == 'admin'){
                // It'll show all record
            }
        });
    }

}
