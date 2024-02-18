<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileTheme extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'premium',
        'background_image_id',
        'background_color',
        'texts_color',
        'block_text_color',
        'block_background_color',
        'block_border_color',
    ];

    public function backgroundImage()
    {
        return $this->hasOne(ProfileBackgroundImage::class, 'id', 'background_image_id');
    }
}
