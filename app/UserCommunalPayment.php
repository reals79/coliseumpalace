<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCommunalPayment extends Model
{
    //
    protected $fillable = [
        'user_id', 'period_at', 'block', 'document',
    ];

    protected $dates = [
        'period_at',
        'created_at',
        'updated_at',
    ];

    public function scopeByPeriod($query, $period)
    {
        return $query->where('period_at', $period);
    }
    
    public function scopeByBlock($query, $block)
    {
        return $query->where('block', $block);
    }

}
