<?php

namespace FaithGen\Messages\Providers;

use FaithGen\Messages\Models\Message;
use FaithGen\Messages\Observers\MessageObserver;
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
        if ($this->app->runningInConsole()) {
            if (config('faithgen-sdk.source')) {
                $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

                $this->publishes([
                    __DIR__ . '/../database/migrations/' => database_path('migrations')
                ], 'faithgen-messages-migrations');
            }
        }

        Message::observe(MessageObserver::class);
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
