<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoFormProducts extends Model
{
    use HasFactory;

    public    $timestamps = false;
    protected $fillable   = [
        'infoForm_id',
        'title',
        'qty',
    ];

    public function infoForm()
    {
        return $this->hasOne(InfoForm::class, 'id', 'infoForm_id');
    }

    public function infoFormFiles()
    {
        return $this->hasMany(InfoFormFile::class/*, 'id', 'infoFormProduct_id'*/);
    }

    public function infoFormProductWorks()
    {
        return $this->hasMany(InfoFormProductWork::class, 'infoFormProduct_id', 'id');
    }
}
