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
        'topTitle_en',
        'infoTopTitle_en',
        'resume_en',
        'resumeButton_en',
        'infoTitle_en',
        'infoLocation_en',
        'infoText_en',
        'videoTitle_en',
        'midTopTitle_en',
        'midTitle_en',
        'midSubtitle_en',
        'midDesc_en',
        'skillTopTitle_en',
        'skillTitle_en',
        'skillPercentage_en',
        'bottomTopTitle_en',
        'bottomTitle_en',
        'bottomSubtitle_en',
        'bottomText_en',
    ];
}
