<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockPbOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'block_id',
        'pbOption_id',
        'title',
        'connectionWay',
        'extraText',
        'sort',
    ];

    public function pbOption()
    {
        return $this->hasOne(pbOption::class,'id','pbOption_id');
    }

    public function block()
    {
        return $this->hasOne(Block::class,'id','block_id');
    }
}
