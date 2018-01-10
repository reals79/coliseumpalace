<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    //

    protected $casts = [
        'bedrooms' => 'array',
        'bathrooms' => 'array',
    ];

    public function building()
    {
    	return $this->belongsTo(Building::class);
    }

    public function apartmentType()
    {
    	return $this->belongsTo(ApartmentType::class);
    }

}
