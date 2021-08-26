<?php

namespace AndreaOrtu\AdmProject\Models;

use AndreaOrtu\AdmProject\Database\factories\PlanetFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planet extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'residents' => 'array',
        'films' => 'array'
    ];

    protected static function newFactory()
    {
        return PlanetFactory::new();
    }
}
