<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarPartCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function parentCategory()
    {
        return $this->belongsTo(CarPartCategory::class, 'parent_id');
    }

    public function childrenCategory()
    {
        return $this->hasMany(CarPartCategory::class, 'parent_id');
    }
}
