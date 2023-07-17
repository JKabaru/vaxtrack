<?php

namespace Database\Seeders;
use App\Models\AgeRange;

use Illuminate\Database\Seeder;

class AgeRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   
    public function run()
    {
        $ageRanges = [
            [
                'StartAge' => 0,
                'EndAge' => 1,
                'Description' => 'Newborn',
            ],
            [
                'StartAge' => 2,
                'EndAge' => 6,
                'Description' => 'Infant',
            ],
            [
                'StartAge' => 7,
                'EndAge' => 12,
                'Description' => 'Toddler',
            ],
            // Add more age ranges as needed
        ];

        foreach ($ageRanges as $ageRange) {
            AgeRange::create($ageRange);
        }
    }
}
