<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

  

    protected $fillable = [
        'CountryName',
    ];

    // Relationship with Vaccine model (assuming One-to-Many)
    public function vaccines()
    {
        return $this->hasMany(Vaccine::class, 'country_id');
    }

   
}
