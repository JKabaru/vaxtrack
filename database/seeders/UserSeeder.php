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
                'address' => 'Kikuyu',
                'status' => 'active',
        ]);

        User::create([
            'name' => 'Doctor',
                'email' => 'doctor@gmail.com',
                'password' => Hash::make('12345678'),
                'address' => 'Thika',
                'status' => 'Disabled',
        ]);

        User::create([
            'name' => 'Parent',
                'email' => 'parent@gmail.com',
                'password' => Hash::make('12345678'),
                'address' => 'Juja',
                'status' => 'Disabled',
        ]);



        // Add more users if necessary
    }
}
