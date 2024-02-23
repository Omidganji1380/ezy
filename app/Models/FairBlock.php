<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FairBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'block_id',
        'title',
        'number',
        'link',
        'img',
        'description',
    ];

    public function block()
    {
        return $this->hasOne(Block::class, 'id', 'block_id');
    }
}
