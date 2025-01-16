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
      'style_id',
      'location_id',
      'description',
      'year',
    ];

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    public function style(): BelongsTo
    {
        return $this->belongsTo(Style::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => intval($this->id),
            'title' => $this->title,
            'description' => $this->description,
            'artist' => $this->artist->name,
            'style' => ($this->style ? $this->style->name : ''),
            'location' => ($this->location ? $this->location->name : ''),
            'year' => intval($this->year),
            'image' => asset('images/' . $this->image),
        ];
    }
}
