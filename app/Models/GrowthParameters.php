<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrowthParameters extends Model
{
    use HasFactory;

    protected $primaryKey = 'GrowthID';

    protected $fillable = [
        'InfantID',
        'Date',
        'Height',
        'Weight',
        'HeadCircumference',
    ];

    // Relationship with Infant model (assuming Many-to-One)
    public function infant()
    {
        return $this->belongsTo(Infant::class, 'infant_id');
    }
}
