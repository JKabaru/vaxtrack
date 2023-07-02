<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            // Admin
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'status' => 'active',
            ]
        ]);

        DB::table('users')->insert([
            // Admin
            [
                'name' => 'Parent',
                'email' => 'parent@gmail.com',
                'password' => Hash::make('12345678'),
                'address' => 'Juja',
                'status' => 'Disabled',
            ]
        ]);


        DB::table('users')->insert([
            // Admin
            [
                'name' => 'Doctor',
                'email' => 'doctor@gmail.com',
                'password' => Hash::make('12345678'),
                'address' => 'Thika',
                'status' => 'Disabled',
            ]
        ]);



    }
}
