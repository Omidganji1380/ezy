<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'topTitle',
        'formTopTitle',
        'infoTopTitle',
        'position',
        'status',
        'title',
        'subtitle',
        'icon',
        'name',
        'email',
        'phone',
        'text',
    ];
}
