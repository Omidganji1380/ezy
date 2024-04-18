<?php

namespace App\Models\api\v1\digitalMenu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DigitalMenuBlockOption extends Model
{
    use HasFactory, SoftDeletes;

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
        'digitalMenuBlock_id',
    ];
}
