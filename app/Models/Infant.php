<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'infants';
    protected $guarded = [];
    /**
     * Get the parent user associated with the infant.
     */
    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    /**
     * Get the doctor user associated with the infant.
     */
    

    /**
     * Get the vaccine associated with the infant.
     */
    public function vaccine()
    {
        return $this->belongsTo(VaccineType::class, 'vaccine_id' );
    }

    public function infantVaccines()
    {
        return $this->hasMany(InfantVaccine::class, 'infant_id');
    }
}
