<?php

namespace App\Providers;

// In a service provider, e.g., AppServiceProvider.php

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Filesystem\Filesystem;
use App\View\Composers\AppComposer;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('files', function ($app) {
            return new Filesystem;
        });
    }

    public function boot()
    {
        View::composer('layouts.app', AppComposer::class);
    }
}
