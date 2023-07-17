<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VaccineType extends Model
{
    use HasFactory;
    protected $table = 'vaccines';

    protected $guarded = [];

        public static function getAllVaccines()
    {
        $vaccines = DB::table('vaccines')
            ->select('name','dose_number', 'id')
            ->get();

        return $vaccines;
    }

    

    // Relationship with Country model (assuming One-to-One or One-to-Many)
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    // Relationship with AgeRange model (assuming Many-to-One)
    public function ageRange()
    {
        return $this->belongsTo(AgeRange::class, 'age_range_id');


    }
     
    public function vaccineAge()
    {
        return $this->belongsTo(AgeRange::class, 'age_range_id');


    }




}
