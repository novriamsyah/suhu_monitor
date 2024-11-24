<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'roles' => 'SUPER',
        ]);

        User::factory()->create([
            'name' => 'Admin Kabupaten',
            'email' => 'adminkabupaten@gmail.com',
            'roles' => 'ADMINKAB',
        ]);

        User::factory()->create([
            'name' => 'Admin OPD',
            'email' => 'adminopd@gmail.com',
            'roles' => 'ADMINOPD',
        ]);
    }
}
