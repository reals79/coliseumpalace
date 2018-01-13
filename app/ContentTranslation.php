<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentTranslation extends Model
{
    //
    public $timestamps = false;
    protected $fillable = ['name', 'descr'];
    
}
