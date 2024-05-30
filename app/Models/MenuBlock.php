<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'block_id',
        'title',
        'price',
        'description',
        'img',
        'sort',
    ];
    public function block()
    {
        return $this->hasOne(Block::class, 'id', 'block_id');
    }
}
