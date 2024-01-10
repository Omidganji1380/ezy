<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'img',
        'text',
        'category_id',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'visit',
        'status',
        'slug',
        'title_en',
        'slug_en',
        'img_en',
        'text_en',
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
