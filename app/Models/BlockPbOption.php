<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockPbOption extends Model
{
    use HasFactory;

    public    $incrementing = false;
    public    $timestamps   = false;
    protected $fillable     = [
        'block_id',
        'pbOption_id',
    ];
}
