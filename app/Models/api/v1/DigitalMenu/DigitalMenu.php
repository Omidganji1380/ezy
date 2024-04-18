<?php

namespace App\Models\api\v1\DigitalMenu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DigitalMenu extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'link',
        'image',
        'cover',
        'image_border',
        'cover_border',
        'title',
        'subtitle',
        'background',
        'buttons_cover',
        'buttons_title_color',
        'buttons_icons_color',
        'buttons_border_color',
        'table_count',
        'table_count',
        'scroll_id',
        'template_id',
        'user_id',
    ];
}
