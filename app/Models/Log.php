<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'comment',
        'user_id',
        'model_id',
        'text',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
