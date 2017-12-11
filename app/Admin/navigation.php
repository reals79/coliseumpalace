<?php

use SleepingOwl\Admin\Navigation\Page;

// Default check access logic
// AdminNavigation::setAccessLogic(function(Page $page) {
// 	   return auth()->user()->isSuperAdmin();
// });
//
// AdminNavigation::addPage(\App\User::class)->setTitle('test')->setPages(function(Page $page) {
// 	  $page
//		  ->addPage()
//	  	  ->setTitle('Dashboard')
//		  ->setUrl(route('admin.dashboard'))
//		  ->setPriority(100);
//
//	  $page->addPage(\App\User::class);
// });
//
// // or
//
// AdminSection::addMenuPage(\App\User::class)

return [
    [
        'title' => 'Dashboard',
        'icon'  => 'fa fa-dashboard',
        'url'   => route('admin.dashboard'),
        'priority' => 0,
    ],

    [
        'title' => 'Разделы меню',
        'icon'  => 'fa fa-bars',
        'model' => \App\Content::class,
        'priority' => 1,
    ],

    [
        'title' => 'Контент',
        'icon'  => 'fa fa-newspaper-o',
        'pages' => [
            [
                'title' => 'Главная страница',
                'icon'  => 'fa fa-file-text-o',
                'model' => \App\ContentMain::class,
                'priority' => 0,
            ],

            [
                'title' => 'Слайдшоу',
                'icon'  => 'fa fa-picture-o',
                'model' => \App\Slideshow::class,
                'priority' => 1,
            ],

            [
                'title' => 'Фотогалерея',
                'icon'  => 'fa fa-camera',
                'model' => \App\Gallery::class,
                'priority' => 2,
            ],

            [
                'title' => 'Видеогалерея',
                'icon'  => 'fa fa-video-camera',
                'model' => \App\Video::class,
                'priority' => 3,
            ],
            [
                'title' => 'Контакты',
                'icon'  => 'fa fa-address-card-o',
                'model' => \App\Contact::class,
                'priority' => 4,
            ],
        ],
        'priority' => 2,
    ],

    [
        'title' => 'Квартиры',
        'icon'  => 'fa fa-building-o',
        'pages' => [
            [
                'title' => 'Здания',
                'model' => \App\Building::class,
                'priority' => 0,
            ],

            [
                'title' => 'Типы квартир',
                'model' => \App\ApartmentType::class,
                'priority' => 1,
            ],

            [
                'title' => 'Квартиры',
                'model' => \App\Apartment::class,
                'priority' => 2,
            ],
        ],
        'priority' => 3,
    ],

    [
        'title' => 'Настройки калькулятора',
        'icon'  => 'fa fa-cog',
        'model' => \App\Settings::class,
        'priority' => 10,
    ],

    [
        'title' => 'Клиенты',
        'icon'  => 'fa fa-users',
        'model' => \App\User::class,
        'priority' => 10,
    ],

    // Examples
    // [
    //    'title' => 'Content',
    //    'pages' => [
    //
    //        \App\User::class,
    //
    //        // or
    //
    //        (new Page(\App\User::class))
    //            ->setPriority(100)
    //            ->setIcon('fa fa-user')
    //            ->setUrl('users')
    //            ->setAccessLogic(function (Page $page) {
    //                return auth()->user()->isSuperAdmin();
    //            }),
    //
    //        // or
    //
    //        new Page([
    //            'title'    => 'News',
    //            'priority' => 200,
    //            'model'    => \App\News::class
    //        ]),
    //
    //        // or
    //        (new Page(/* ... */))->setPages(function (Page $page) {
    //            $page->addPage([
    //                'title'    => 'Blog',
    //                'priority' => 100,
    //                'model'    => \App\Blog::class
	//		      ));
    //
	//		      $page->addPage(\App\Blog::class);
    //	      }),
    //
    //        // or
    //
    //        [
    //            'title'       => 'News',
    //            'priority'    => 300,
    //            'accessLogic' => function ($page) {
    //                return $page->isActive();
    //		      },
    //            'pages'       => [
    //
    //                // ...
    //
    //            ]
    //        ]
    //    ]
    // ]
];