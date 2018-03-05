<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsTranslation extends Model
{
    //
    public $timestamps = false;

    protected $fillable = ['title', 'descr'];

}
