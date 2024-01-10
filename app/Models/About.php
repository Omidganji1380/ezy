<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'topTitle',
        'infoTopTitle',
        'resume',
        'resumeButton',
        'infoTitle',
        'infoLocation',
        'infoText',
        'infoImg',
        'videoTitle',
        'videoImg',
        'videoLink',
        'midTopTitle',
        'midTitle',
        'midSubtitle',
        'midDesc',
        'midImg',
        'skillTopTitle',
        'skillTitle',
        'skillPercentage',
        'bottomTopTitle',
        'bottomTitle',
        'bottomSubtitle',
        'bottomText',
    ];
}
