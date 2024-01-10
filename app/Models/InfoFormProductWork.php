<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoFormProductWork extends Model
{
    use HasFactory;

    protected $fillable = [
        'infoFormProduct_id',
        'title',
        'status',
        'user_id',
        'worker',
    ];
    public function infoFormProduct()
    {
        return $this->hasOne(InfoFormProducts::class, 'id', 'infoFormProduct_id');
    }
    public function worker()
    {
        return $this->hasOne(User::class, 'id', 'worker');
    }
}
