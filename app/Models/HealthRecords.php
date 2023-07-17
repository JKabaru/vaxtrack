<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthRecords extends Model
{
    use HasFactory;

    protected $primaryKey = 'RecordID';

    protected $fillable = [
        'InfantID',
        'Date',
        'MedicalCondition',
        'Diagnosis',
        'Notes',
    ];

    // Relationship with Infant model (assuming Many-to-One)
    public function infant()
    {
        return $this->belongsTo(Infant::class, 'infant_id');
    }
}
