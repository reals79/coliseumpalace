<?php

namespace App;

use SleepingOwl\Admin\Traits\OrderableModel;

class ContentMain extends Content
{
    //
    use OrderableModel, \Dimsav\Translatable\Translatable;

    public $translationModel = 'App\ContentTranslation';
}
