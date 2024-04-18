<?php

namespace App\Models\api\v1\digitalMenu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DigitalMenuBlock extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'digitalMenu_id',
        'sort',
    ];
}
