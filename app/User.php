<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'idno', 'first_name', 'last_name', 'email', 'phone', 'contract', 'contract_at', 'activated', 'api_token', 'total_amount_leasing', 'total_amount_leasing_period', 'total_amount_stavka', 'total_amount_fine', 'total_amount_pay', 'total_amount_sold', 'total_amount_debt'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function records()
    {
        return $this->hasMany(UserRecords::class);
    }
    
}