<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientRecord extends Model
{
    use HasFactory;


    protected $fillable = [
        'patient_id',
        'name',
        'blood_type',
        'birth_date',
        'ph',
    ];

    protected $casts = [
        'birth_date' => 'date'
    ];

    public function patient(): BelongsTo {
        return $this->belongsTo(Patient::class);
    }

}
