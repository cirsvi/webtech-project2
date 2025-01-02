<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Painting extends Model
{
    use HasFactory;
    protected $fillable =[
      'title',
      'artist_id',
      'description',
      'year',
    ];

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }
}
