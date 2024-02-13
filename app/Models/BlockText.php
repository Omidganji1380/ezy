<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockText extends Model
{
    use HasFactory;

    protected $fillable = [
        'block_id',
        'text',
        'textSize',
        'textAlign',
        'textColor',
    ];

    public function block()
    {
        return $this->hasOne(Block::class, 'id', 'block_id');
    }
}
