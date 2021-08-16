<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Youtube;

class YoutubeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('youtube',function(){
            return new Youtube();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
