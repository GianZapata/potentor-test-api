<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'second_name',
        'last_name',
        'second_last_name',
        'type',
        'age'
    ];

    protected $casts = [
        'age' => 'integer'
    ];

    public function records(): HasMany
    {
        return $this->hasMany(PatientRecord::class);
    }

}
