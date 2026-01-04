<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'holes_count',
        'par',
        'slope',
        'rating',
        'hole_pars',
    ];

    protected $casts = [
        'hole_pars' => 'array',
    ];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}