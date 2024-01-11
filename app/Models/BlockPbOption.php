<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockPbOption extends Model
{
    use HasFactory;
protected $primaryKey='pbOption_id';
    public    $incrementing = false;
    public    $timestamps   = false;
    protected $fillable     = [
        'block_id',
        'pbOption_id',
        'title',
        'connectionWay',
        'extraText',
        'sort',
    ];
}
