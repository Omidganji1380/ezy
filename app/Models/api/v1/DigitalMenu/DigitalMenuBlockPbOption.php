<?php

namespace App\Models\api\v1\digitalMenu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DigitalMenuBlockPbOption extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'digitalMenuBlock_id',
        'pbOption_id',
        'title',
        'connectionWay',
        'extraText',
        'sort',
    ];
}
