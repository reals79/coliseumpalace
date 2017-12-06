<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Traits\OrderableModel;

class Building extends Model
{
    //
    use OrderableModel;

    public $timestamps = false;

    public function apartments()
    {
    	return $this->hasMany(Apartment::class);
    }
    
}