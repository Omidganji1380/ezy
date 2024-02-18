<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileFont extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'language',
        'woff',
        'woff2',
        'eot',
        'premium',
    ];
}
