<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use SleepingOwl\Admin\Traits\OrderableModel;

class Video extends Model
{
	use OrderableModel;

    //
    protected $fillable = [
        'name', 'path', 'path_external', 'activated', 'order'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('activated', function(Builder $builder) {
            $builder->orderBy('order', 'asc');
            if (!\Request::is('admin/*')) $builder->whereActivated(1);
        });
    }

}
