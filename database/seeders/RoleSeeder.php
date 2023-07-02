<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        Role::create([
            'name' => 'Admin',
        ]);

        Role::create([
            'name' => 'Doctor',
        ]);

        Role::create([
            'name' => 'Parent',
        ]);

        Role::create([
            'name' => 'user',
        ]);

        // Add more roles if necessary
    }
}
