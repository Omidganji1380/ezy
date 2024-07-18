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

    protected static function boot() {
        parent::boot();

        static::retrieved(function ($model) {
            $model->loadAllRelations();
        });
    }

    public function loadAllRelations() {
        $relations = $this->getAllRelations();
        $this->load($relations);
    }

    public function getAllRelations() {
        return [
            'pbOption',
            'blockOption',
            'banner',
            'fair',
            'menu',
            'text',
            'video',
        ];
    }

    public function pbOption(): BelongsToMany {
        return $this->belongsToMany(pbOption::class, 'block_pb_options', 'block_id', 'pbOption_id')
                    ->withPivot([
                                    'id',
                                    'sort',
                                    'title',
                                    'connectionWay',
                                    'extraText',
                                ])
                    ->orderBy('block_pb_options.sort');
    }

    public function blockOption() {
        return $this->hasOne(BlockOption::class);
    }

    public function banner() {
        return $this->hasMany(blockBanner::class, 'block_id', 'id');
    }

    public function fair() {
        return $this->hasMany(FairBlock::class, 'block_id', 'id');
    }

    public function menu() {
        return $this->hasMany(MenuBlock::class, 'block_id', 'id');
    }

    public function text() {
        return $this->hasMany(BlockText::class, 'block_id', 'id');
    }

    public function video() {
        return $this->hasMany(BlockVideo::class, 'block_id', 'id');
    }
}
