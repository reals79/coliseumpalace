<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Rate extends Model
{
    //
    protected $fillable = [
        'num_code', 'char_code', 'nominal', 'name', 'value',
    ];
    protected $appends = ['char_code_short'];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function scopeCurrentRates($query)
    {
    	$from = Carbon::now()->startOfDay();
    	$to = Carbon::now()->endOfDay();
    	return $query->whereBetween('created_at', [$from, $to]);
    }

    public function scopeRatesAt($query, $date_at = null)
    {
    	if (!$date_at) $date_at = Carbon::now()->format('d.m.Y');

    	$dt = Carbon::createFromFormat('d.m.Y', $date_at);
    	$from = $dt->startOfDay();
    	$dt = Carbon::createFromFormat('d.m.Y', $date_at);
    	$to = $dt->endOfDay();
    	
    	return $query->whereBetween('created_at', [$from, $to]);
    }

    public function getCharCodeShortAttribute()
    {
    	return strtolower(substr($this->char_code, 0, 2));
    }

}
