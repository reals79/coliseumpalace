<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    //
    use \Dimsav\Translatable\Translatable;
    
    public $translatedAttributes = ['name'];

}
