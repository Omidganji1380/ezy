<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone','code'
    ];
}
