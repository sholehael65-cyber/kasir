<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::create([
            'name' => 'Administrator',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('kasir123'),
            'no_whatsapp' => '0867363',
            'role' => 'kasir'
        ]);

        // Buat akun user
        User::create([
            'name' => 'user',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('owner123'),
            'no_whatsapp' => '08372872',
            'role' => 'owner'
        ]);  
    }
}
