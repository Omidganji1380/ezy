<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blockBanner extends Model
{
    use HasFactory;

    protected $fillable = [
        'block_id',
        'image',
        'link',
        'title',
        'description',
        'button',
        'sort',
    ];

    public function block()
    {
        return $this->hasOne(Block::class);
    }
}
