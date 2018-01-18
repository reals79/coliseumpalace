<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommercialArea extends Model
{
    //
    use \Dimsav\Translatable\Translatable;

	public $translatedAttributes = ['name', 'descr'];

    public function building()
    {
    	return $this->belongsTo(Building::class);
    }

}
