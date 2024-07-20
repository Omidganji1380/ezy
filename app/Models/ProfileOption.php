<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'font_id',
        'background_image_id',
        'theme_id',
        'texts_color',
        'background_color',
        'block_background_color',
        'block_text_color',
        'block_border_color',
        'block_rounded',
    ];
    protected $appends  = ['background_image_url'];

    public function getBackgroundImageUrlAttribute() {
        if ($this->background_image_id) {
            return asset("storage/pb/bgImages/bgImage-{$this->background_image_id}/{$this->backgroundImage->img}");
        }
        return null;
    }

    public function profile() {
        return $this->belongsTo(Profile::class, 'id', 'profile_id');
    }

    public function font() {
        return $this->hasOne(ProfileFont::class, 'id', 'font_id');
    }

    public function backgroundImage() {
        return $this->hasOne(ProfileBackgroundImage::class, 'id', 'background_image_id');
    }

    public function theme() {
        return $this->hasOne(ProfileTheme::class, 'id', 'theme_id');
    }
}
