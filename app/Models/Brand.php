<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'country',

    ];

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
    use HasFactory;
}
