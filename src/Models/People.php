<?php

namespace AndreaOrtu\AdmProject\Models;

use AndreaOrtu\AdmProject\Database\factories\PeopleFactory;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    const SWAPI_API = 'https://swapi.dev/api/people';
    const PAGINATION = 15;

    protected $guarded = [];

    protected $with = ['planet'];

    protected $casts = [
        'films' => 'array',
        'species' => 'array',
        'starships' => 'array',
        'vehicles' => 'array'
    ];

    public function planet()
    {
        return $this->belongsTo(Planet::class);
    }

    protected static function newFactory()
    {
        return PeopleFactory::new();
    }
}
