<?php

Meta::addCss('admin', asset('css/admin.css'));
Meta::addJs('admin', asset('js/admin.js'), ['admin-default']);
Meta::addJs('loading-overlay', 'https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.5/dist/loadingoverlay.min.js', ['admin-default']);

 /*PackageManager::load('admin-default')
    ->css('admin', public_path('css/admin.css'));*/
