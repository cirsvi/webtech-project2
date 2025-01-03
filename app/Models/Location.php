<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    Use HasFactory;
    protected $fillable = ['name'];

    public function paintings(): HasMany
    {
        return $this->hasMany(Painting::class);
    }
}
