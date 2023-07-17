<?php

namespace Database\Seeders;
use App\Models\Country;

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            [
                'CountryName' => 'United States',
            ],
            [
                'CountryName' => 'Canada',
            ],
            [
                'CountryName' => 'United Kingdom',
            ],
            [
                'CountryName' => 'Kenya',
            ],
            [
                'CountryName' => 'Uganda',
            ],
            [
                'CountryName' => 'Tanzania',
            ],
            // Add more countries as needed
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
