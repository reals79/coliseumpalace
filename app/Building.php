<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Traits\OrderableModel;

class Building extends Model
{
    //
    use OrderableModel, \Dimsav\Translatable\Translatable;

    public $timestamps = false;
    public $translatedAttributes = ['name'];

    public function apartments()
    {
    	return $this->hasMany(Apartment::class);
    }
    
}
