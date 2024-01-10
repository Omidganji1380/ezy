<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'img',
        'link',
        'status',
        'category_id',
    ];

    public function category()
    {
        return $this->hasOne(Category::class,'id','category_id');
    }
}
