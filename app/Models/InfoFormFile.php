<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoFormFile extends Model
{
    use HasFactory;

    public    $timestamps   = false;
    protected $fillable     = [
        'infoFormProduct_id',
        'file',
    ];
    public function infoFormProduct()
    {
        return $this->hasOne(InfoFormProducts::class, 'id', 'infoFormProduct_id');
    }
}
