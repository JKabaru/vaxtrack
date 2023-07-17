<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevelopmentMilestones extends Model
{
    use HasFactory;

    protected $primaryKey = 'MilestoneID';

    protected $fillable = [
        'InfantID',
        'MilestoneType',
        'DateAchieved',
    ];

    // Relationship with Infant model (assuming Many-to-One)
    public function infant()
    {
        return $this->belongsTo(Infant::class, 'infant_id');
    }
}
