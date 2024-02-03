<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Block extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'sort',
    ];

    public function pbOption(): BelongsToMany
    {
        return $this->belongsToMany(pbOption::class,'block_pb_options','block_id','pbOption_id')->withPivot('id');
    }

    public function blockOption()
    {
        return $this->hasOne(BlockOption::class);
    }
    public function banner()
    {
        return $this->hasMany(blockBanner::class,'block_id','id');
    }
}
