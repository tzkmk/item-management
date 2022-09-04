<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 
        if(\App::environment(['production'])){
            \URL::forceScheme('https');
        }

        // ページネーションリンクをhttps対応（.env APP_ENV=localでない場合https化）
        if (!$this->app->environment('local')) {
            $this->app['request']->server->set('HTTPS', 'on');
        }
    }
}