<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class News extends Model
{
    //
    use \Dimsav\Translatable\Translatable;

    protected $fillable = [
        'images', 'when_at', 'promo', 'activated'
    ];
    public $translatedAttributes = ['title', 'descr'];

    protected $dates = [
        'when_at',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('activated', function(Builder $builder) {
        	$builder->orderBy('when_at', 'desc');
            if (!\Request::is('admin/*')) $builder->whereActivated(1);
        });
    }

    public function scopePromo($query)
    {
        return $query->where('promo', 1);
    }

    public function getImagesAttribute($value)
    {
        return preg_split('/,/', $value, -1, PREG_SPLIT_NO_EMPTY);
    }

    public function setImagesAttribute($images)
    {
        $this->attributes['images'] = implode(',', $images);
    }

}
