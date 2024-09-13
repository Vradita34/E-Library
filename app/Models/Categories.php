<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function book() : HasMany
    {
        return $this->hasMany(Books::class);
    }
}
