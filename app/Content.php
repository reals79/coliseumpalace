<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use SleepingOwl\Admin\Traits\OrderableModel;

class Content extends Model
{
    use OrderableModel, \Dimsav\Translatable\Translatable;

    protected $table = 'contents';

    //
    protected $fillable = [
        'content_id', 'images', 'activated', 'order', 'on_mainpage', 'footer'
    ];
    public $translatedAttributes = ['name', 'descr'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('activated', function(Builder $builder) {
            $builder->orderBy('order', 'asc');
            if (!\Request::is('admin/*')) $builder->whereActivated(1);
        });
    }

    public function submenus()
    {
        return $this->hasMany(Content::class);
    }

    public function scopeWithSubmenus($query, $contentId)
    {
        //$query->whereHas('submenus', function ($q) use ($contentId) {
        return $query->where('content_id', $contentId);
        //});
    }

    public function parent()
    {
        return $this->hasOne(Content::class, 'id', 'content_id');
    }

    public function getImagesAttribute($value)
    {
        return preg_split('/\|/', $value, -1, PREG_SPLIT_NO_EMPTY);
    }

    public function setImagesAttribute($images)
    {
        $this->attributes['images'] = implode('|', $images);
    }
    
}
