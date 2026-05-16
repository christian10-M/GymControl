<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@gym.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'age' => 25,
            'gender' => 'other',
        ]);

        User::create([
            'name' => 'Usuario Demo',
            'email' => 'user@gym.com',
            'password' => Hash::make('12345678'),
            'role' => 'user',
            'age' => 22,
            'gender' => 'female',
        ]);
    }
}