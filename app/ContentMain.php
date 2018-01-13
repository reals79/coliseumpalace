<?php

namespace App;

use SleepingOwl\Admin\Traits\OrderableModel;

class ContentMain extends Content
{
    //
    use OrderableModel;

    public $translationModel = 'App\ContentTranslation';
}
