<?php

namespace App;

use SleepingOwl\Admin\Traits\OrderableModel;

class ContentCommercial extends Content
{
    //
    use OrderableModel;

    public $translationModel = 'App\ContentTranslation';
}
