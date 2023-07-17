<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */



    public function run()
    {
        User::create([
            'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'role'     => 'admin',
                'address' => 'Kikuyu',
                'status' => 'active',
        ]);

        User::create([
            'name' => 'Doctor',
                'email' => 'doctor@gmail.com',
                'password' => Hash::make('12345678'),
                'role'     => 'doctor',
                'address' => 'Thika',
                'status' => 'Disabled',
        ]);

        User::create([
            'name' => 'Parent',
                'email' => 'parent@gmail.com',
                'password' => Hash::make('12345678'),
                'role'     => 'parent',
                'address' => 'Juja',
                'status' => 'Disabled',
        ]);



        // Add more users if necessary
    }
}
