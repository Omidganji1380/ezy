<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class pbOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'icon',
        'color',
        'for',
        'sort',
        'title_en',
        'icon_en',
        'color_en',
        'for_en',
    ];

    public function block(): BelongsToMany
    {
        return $this->belongsToMany(Block::class, 'block_pb_options', 'pbOption_id', 'block_id');
    }
}
