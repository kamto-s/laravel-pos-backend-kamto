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

       User::factory(20)->create();

       User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'roles' => 'ADMIN',
            'phone' => '082199240262',
            'password'=> Hash::make('pwdpwd11'),
        ]);

        User::create([
            'name' => 'Staff',
            'email' => 'staff@gmail.com',
            'email_verified_at' => now(),
            'roles' => 'STAFF',
            'phone' => '082199240262',
            'password'=> Hash::make('pwdpwd11'),
        ]);

    }
}
