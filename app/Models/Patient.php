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

    protected $appends = [
        'full_name',
    ];

    public function getFullNameAttribute(): string
    {
        return "{$this->name} {$this->second_name} {$this->last_name} {$this->second_last_name}";
    }

    public function records(): HasMany
    {
        return $this->hasMany(PatientRecord::class);
    }


}
