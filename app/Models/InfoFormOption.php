<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoFormOption extends Model
{
    use HasFactory;

    public    $timestamps   = false;
    protected $fillable     = [
        'infoForm_id',
        'title',
        'text',
    ];

    public function infoForm()
    {
        return $this->hasOne(InfoForm::class,'id','infoForm_id');
    }
}
