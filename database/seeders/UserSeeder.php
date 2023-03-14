<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Stringable;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(1)
        // ->hasAttached(Role::factory()->count(1),([
        //     'created_at'=>now(),
        //     'updated_at'=>now()
        // ]))
        // ->create([
        //     'password'=>Hash::make(rand(1000000,10000000000))
        // ]);

        // User::factory()->count(1)

        // ->hasAttached(Role::factory()->count(1),[
        //     'created_at'=>now(),
        //     'updated_at'=>now(),
        //     'role_id'=>1
        // ])
        ->create([
            'email'=>'admin@rktech.com',
            'name'=>'Vendor',
            'user_type'=>'vendor'
    ]);
    }
}
