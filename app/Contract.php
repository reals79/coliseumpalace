<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    //
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'number', 'created_at', 'total_amount_leasing', 'total_amount_leasing_period', 'total_amount_stavka', 'total_amount_fine', 'total_amount_pay', 'total_amount_sold', 'total_amount_debt'
    ];

    protected $dates = [
        'created_at',
    ];

    public function records()
    {
        return $this->hasMany(UserRecords::class);
    }

}
