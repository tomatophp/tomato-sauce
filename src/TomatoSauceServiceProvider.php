<?php

namespace TomatoPHP\TomatoSauce;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

use TomatoPHP\TomatoPHP\Services\Menu\TomatoMenuRegister;
use TomatoPHP\TomatoSauce\Menus\ReportMenu;
use TomatoPHP\TomatoSauce\View\Components\ReportChartComponent;
use TomatoPHP\TomatoSauce\View\Components\ReportTableComponent;
use TomatoPHP\TomatoSauce\View\Components\ReportWidgetComponent;
use TomatoPHP\TomatoSauce\View\Components\TomatoSauceComponent;


class TomatoSauceServiceProvider extends ServiceProvider
{
    public function register(): void
    {

        //Register generate command
        $this->commands([
           \TomatoPHP\TomatoSauce\Console\TomatoSauceInstall::class,
        ]);

        //Register Config file
        $this->mergeConfigFrom(__DIR__.'/../config/tomato-sauce.php', 'tomato-sauce');

        //Publish Config
        $this->publishes([
           __DIR__.'/../config/tomato-sauce.php' => config_path('tomato-sauce.php'),
        ], 'tomato-sauce-config');

        //Register Migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        //Publish Migrations
        $this->publishes([
           __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'tomato-sauce-migrations');
        //Register views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tomato-sauce');

        //Publish Views
        $this->publishes([
           __DIR__.'/../resources/views' => resource_path('views/vendor/tomato-sauce'),
        ], 'tomato-sauce-views');

        //Register Langs
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'tomato-sauce');

        //Publish Lang
        $this->publishes([
           __DIR__.'/../resources/lang' => resource_path('lang/vendor/tomato-sauce'),
        ], 'tomato-sauce-lang');

        //Register Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        TomatoMenuRegister::registerMenu(ReportMenu::class);

    }

    public function boot(): void
    {
        Blade::component('tomato-sauce', TomatoSauceComponent::class);
        Blade::component('report-table', ReportTableComponent::class);
        Blade::component('report-widget', ReportWidgetComponent::class);
        Blade::component('report-chart', ReportChartComponent::class);
    }
}
