<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use View;
use App\Content;
use App\Contact;
use App\ApartmentType;

class AppServiceProvider extends ServiceProvider
{
    protected $widgets = [
        \App\Admin\Widgets\DashboardBlock::class,
        \App\Admin\Widgets\NavigationUserBlock::class,
        \App\Admin\Widgets\NavigationLangBlock::class
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $widgetsRegistry = $this->app[\SleepingOwl\Admin\Contracts\Widgets\WidgetsRegistryInterface::class];
        foreach ($this->widgets as $widget) {
            $widgetsRegistry->registerWidget($widget);
        }
        
        //
        View::composer('*', function($view) {
            $main_menu = Content::where(['content_id' => 0, 'footer' => 0])->orderBy('order', 'asc')->get();
            $main_menu_footer = Content::where(['content_id' => 0, 'footer' => 1])->orderBy('order', 'asc')->get();
            $contacts_footer = Contact::where(['content_id' => -3])->first();
            $apartment_types = ApartmentType::all();
            $view->with(compact('main_menu', 'main_menu_footer', 'contacts_footer', 'apartment_types'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
