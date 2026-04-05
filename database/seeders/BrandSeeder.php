<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\MotorModel;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $yamaha = Brand::create(['name' => 'Yamaha']);
        $honda = Brand::create(['name' => 'Honda']);

        MotorModel::insert([
            ['brand_id' => $yamaha->id, 'name' => 'NMAX'],
            ['brand_id' => $yamaha->id, 'name' => 'XMAX'],
            ['brand_id' => $honda->id, 'name' => 'Vario'],
            ['brand_id' => $honda->id, 'name' => 'Beat'],
        ]);
    }
}