<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgeRange extends Model
{
    use HasFactory;

    

    protected $fillable = [
        'StartAge',
        'EndAge',
        'Description',
    ];

    // Relationship with Vaccine model (assuming One-to-Many)
    public function vaccines()
    {
        return $this->hasMany(Vaccine::class, 'age_range_id');
    }
    
}
