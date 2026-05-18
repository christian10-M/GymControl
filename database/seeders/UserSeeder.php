<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Membership;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        $admin = User::create([

            'name' => 'Administrador Principal',

            'email' => 'admin@gym.com',

            'password' => Hash::make('12345678'),

            'role' => 'admin',

            'access_key' => 'ADMIN001',

            'curp' => 'AADM950101HSPXRNA1',

            'age' => 28,

            'gender' => 'other',

        ]);

        /*
        |--------------------------------------------------------------------------
        | USER 1
        |--------------------------------------------------------------------------
        */

        $user1 = User::create([

            'name' => 'Leslie Anais',

            'email' => 'leslie@gym.com',

            // usuarios normales NO necesitan password
            'password' => null,

            'role' => 'user',

            'access_key' => 'GYM001',

            'curp' => 'LESA010101MSPRNSA1',

            'age' => 22,

            'gender' => 'female',

        ]);

        Membership::create([

            'user_id' => $user1->id,

            'start_date' => Carbon::now(),

            'end_date' => Carbon::now()->addMonth(),

            'type' => 'mensual',

            'status' => 'active',

        ]);

        /*
        |--------------------------------------------------------------------------
        | USER 2
        |--------------------------------------------------------------------------
        */

        $user2 = User::create([

            'name' => 'Carlos Mendoza',

            'email' => 'carlos@gym.com',

            'password' => null,

            'role' => 'user',

            'access_key' => 'GYM002',

            'curp' => 'CAMM990202HSPRNRA2',

            'age' => 25,

            'gender' => 'male',

        ]);

        Membership::create([

            'user_id' => $user2->id,

            'start_date' => Carbon::now(),

            'end_date' => Carbon::now()->addMonths(3),

            'type' => 'trimestral',

            'status' => 'active',

        ]);

        /*
        |--------------------------------------------------------------------------
        | USER 3 EXPIRED
        |--------------------------------------------------------------------------
        */

        $user3 = User::create([

            'name' => 'Ana Torres',

            'email' => 'ana@gym.com',

            'password' => null,

            'role' => 'user',

            'access_key' => 'GYM003',

            'curp' => 'AATR980303MSPRNRA3',

            'age' => 27,

            'gender' => 'female',

        ]);

        Membership::create([

            'user_id' => $user3->id,

            'start_date' => Carbon::now()->subMonths(2),

            'end_date' => Carbon::now()->subDays(2),

            'type' => 'mensual',

            'status' => 'expired',

        ]);
    }
}