<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;  // ✅ Wajib ada

class VehicleCategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('vehicle_categories')->insert([
            ['name' => 'Mobil Pribadi', 'price' => 50000],
            ['name' => 'Mobil Barang', 'price' => 70000],
            ['name' => 'Truck', 'price' => 100000],
        ]);
    }
}
