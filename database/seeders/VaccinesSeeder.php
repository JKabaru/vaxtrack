<?php

namespace Database\Seeders;
use App\Models\VaccineType;

use App\Models\AgeRange;
use App\Models\Country;

use Illuminate\Database\Seeder;

class VaccinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Retrieve age ranges and countries from the database
        $ageRanges = AgeRange::all();
        $countries = Country::all();



        $vaccines = [
            [
                'name' => 'Hepatitis B',
                'dose_number' => 'Birth or within the first few months',
                'age_range_id' => $ageRanges->random()->id,
                'description' => '',
                'side_effects' => '',
                'storage_requirements' => '',
                'country_id' => $countries->random()->id,
            ],
            [
                'name' => 'Rotavirus',
                'dose_number' => '2 or 3 doses starting at 2 months',
                'age_range_id' => $ageRanges->random()->id,
                'description' => '',
                'side_effects' => '',
                'storage_requirements' => '',
                'country_id' => $countries->random()->id,
            ],
            [
                'name' => 'DTaP (Diphtheria, Tetanus, and Pertussis)',
                'dose_number' => '2, 4, and 6 months',
                'age_range_id' => $ageRanges->random()->id,
                'description' => '',
                'side_effects' => '',
                'storage_requirements' => '',
                'country_id' => $countries->random()->id,
            ],
            [
                'name' => 'Hib (Haemophilus influenzae type b)',
                'dose_number' => '2, 4, and 6 months',
                'age_range_id' => $ageRanges->random()->id,
                'description' => '',
                'side_effects' => '',
                'storage_requirements' => '',
                'country_id' => $countries->random()->id,
            ],
            [
                'name' => 'PCV13 (Pneumococcal Conjugate Vaccine)',
                'dose_number' => '2, 4, and 6 months, with a final dose between 12 and 15 months',
                'age_range_id' => $ageRanges->random()->id,
                'description' => '',
                'side_effects' => '',
                'storage_requirements' => '',
                'country_id' => $countries->random()->id,
            ],
            [
                'name' => 'IPV (Inactivated Polio Vaccine)',
                'dose_number' => '2, 4, and 6 to 18 months',
                'age_range_id' => $ageRanges->random()->id,
                'description' => '',
                'side_effects' => '',
                'storage_requirements' => '',
                'country_id' => $countries->random()->id,
            ],
            [
                'name' => 'Influenza (Flu)',
                'dose_number' => 'Annual vaccination starting at 6 months',
                'age_range_id' => $ageRanges->random()->id,
                'description' => '',
                'side_effects' => '',
                'storage_requirements' => '',
                'country_id' => $countries->random()->id,
            ],
            [
                'name' => 'MMR (Measles, Mumps, and Rubella)',
                'dose_number' => 'Between 12 and 15 months',
                'age_range_id' => $ageRanges->random()->id,
                'description' => '',
                'side_effects' => '',
                'storage_requirements' => '',
                'country_id' => $countries->random()->id,
            ],
            [
                'name' => 'Varicella (Chickenpox)',
                'dose_number' => 'Between 12 and 15 months',
                'age_range_id' => $ageRanges->random()->id,
                'description' => '',
                'side_effects' => '',
                'storage_requirements' => '',
                'country_id' => $countries->random()->id,
            ],
            [
                'name' => 'Hepatitis A',
                'dose_number' => 'Two-dose series: first dose between 12 and 23 months, second dose 6 to 18 months after the first',
                'age_range_id' =>$ageRanges->random()->id,
                'description' => '',
                'side_effects' => '',
                'storage_requirements' => '',
                'country_id' => $countries->random()->id,
            ],
        ];

        foreach ($vaccines as $vaccine) {
            VaccineType::create($vaccine);
        }
    }
}




    

