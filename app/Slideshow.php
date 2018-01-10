<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use SleepingOwl\Admin\Traits\OrderableModel;

class Slideshow extends Model
{
    use OrderableModel;

    //
    protected $fillable = [
        'image', 'title', 'descr', 'activated', 'order'
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
