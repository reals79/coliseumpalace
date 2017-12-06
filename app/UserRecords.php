<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRecords extends Model
{
    //

    protected $fillable = [
        'user_id', 'number_period', 'pay_at', 'amount_leasing', 'amount_leasing_period', 'amount_stavka', 'amount_fine', 'amount_sold', 'amount_pay',
    ];

}
