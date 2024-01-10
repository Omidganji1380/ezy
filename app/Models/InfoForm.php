<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
    ];

    public function infoOptions()
    {
        return $this->hasMany(InfoFormOption::class, 'infoForm_id', 'id');
    }
    public function infoProducts()
    {
        return $this->hasMany(InfoFormProducts::class, 'infoForm_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function logs()
    {
        return $this->hasMany(Log::class, 'user_id','id');
    }
}
