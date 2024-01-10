<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'blockTitle',
        'blockWidth',
        'blockBorder',
        'blockVisibility',
        'option1',
        'option2',
        'option3',
        'option4',
        'option5',
        'block_id',
    ];
}
