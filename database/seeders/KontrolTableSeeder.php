<?php

namespace Database\Seeders;

use App\Models\Kontrol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KontrolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kontrol::create(['status' => 'OFF']);
    }
}
