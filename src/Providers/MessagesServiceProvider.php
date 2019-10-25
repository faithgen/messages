<?php

namespace FaithGen\Messages\Providers;

use FaithGen\Messages\Models\Message;
use FaithGen\Messages\Observers\MessageObserver;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class MessagesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/faithgen-messages.php', 'faithgen-messages');

        $this->registerRoutes();

        if ($this->app->runningInConsole()) {
            if (config('faithgen-sdk.source')) {
                $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

                $this->publishes([
                    __DIR__ . '/../database/migrations/' => database_path('migrations')
                ], 'faithgen-messages-migrations');

                $this->publishes([
                    __DIR__ . '/../config/faithgen-messages.php' => config_path('faithgen-messages.php')
                ], 'faithgen-messages-config');
            }
        }

        Message::observe(MessageObserver::class);
    }

    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/messages.php');
            if (config('faithgen-sdk.source'))
                $this->loadRoutesFrom(__DIR__ . '/../routes/source.php');
        });
    }

    private function routeConfiguration()
    {
        return [
            'prefix' => config('faithgen-messages.prefix'),
            'namespace' => "FaithGen\Messages\Http\Controllers",
            'middleware' => config('faithgen-messages.middlewares'),
        ];
    }


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
