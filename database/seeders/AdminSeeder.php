<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'logo' => 'default.png',
            'name' => 'Amin Emenu',
            'username' => 'admin',
            'email' => 'admin@emenu.com',
            'password' => bcrypt('Admin123'),
            'role' => 'admin'
        ]);
    }
}
