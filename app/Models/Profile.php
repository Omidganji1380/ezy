<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'link',
        'img',
        'title',
        'subtitle',
        'category_id',
        'user_id',
    ];

    public function category()
    {
        return $this->hasOne(ProfileCategory::class, 'id', 'category_id');
    }
    public function block()
    {
        return $this->hasMany(Block::class, 'profile_id', 'id');
    }
}
