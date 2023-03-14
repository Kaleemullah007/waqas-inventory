<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\ModuleFeature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Module::factory()
       ->count(5)
       ->hasModuleFeatures(ModuleFeature::factory()->count(3))
       ->create();
    }
}
