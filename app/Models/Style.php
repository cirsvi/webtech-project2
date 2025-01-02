<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Style extends Model
{
    Use HasFactory;
    protected $fillable = ['name'];
}
