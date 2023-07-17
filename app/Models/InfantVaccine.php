<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfantVaccine extends Model
{
    use HasFactory;

    protected $table = 'infant_vaccine';

    protected $fillable = [
        'infant_id',
        'vaccine_id',
        'administration_date',
        'dosage',
        'completed',
        'next_due_date',
    ];

    public $timestamps = true;

    /**
     * Get the infant associated with the vaccine record.
     */
    public function infant()
    {
        return $this->belongsTo(Infant::class);
    }

    /**
     * Get the vaccine associated with the vaccine record.
     */
    public function vaccine()
    {
        return $this->belongsTo(VaccineType::class);
    }
    
    // Add any other custom methods or query scopes as needed
}
