<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommercialAreaTranslation extends Model
{
    //
    public $timestamps = false;
    protected $fillable = ['name', 'descr'];
    
}
