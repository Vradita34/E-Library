<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'librarian_id',
        'status',
        'note',
        'expired_date',
    ];


    function user():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
    function librarian():BelongsTo
    {
        return $this->belongsTo(User::class,'librarian_id');
    }
    public function book(): BelongsTo
    {
        return $this->belongsTo(books::class,'book_id');
    }
}
