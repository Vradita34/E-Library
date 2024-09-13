<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Books extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'category_id',
        'synopsis',
        'read_duration',
        'cover',
        'release_date',
        'file',
    ];

    public function category() : BelongsTo
    {
        return $this->belongsTo(Categories::class);
    }

    public function permission(): HasMany
    {
        return $this->hasMany(Permission::class,'book_id');
    }

    public function scopeMostPopularBook($query)
    {
        return $query->withCount('permission')->orderBy('permission_count','desc');
    }
}
