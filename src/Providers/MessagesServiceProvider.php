<?php

namespace FaithGen\Messages\Providers;

use FaithGen\Messages\MessageService;
use FaithGen\Messages\Models\Message;
use FaithGen\Messages\Observers\MessageObserver;
use FaithGen\SDK\Traits\ConfigTrait;
use Illuminate\Support\ServiceProvider;

class MessagesServiceProvider extends ServiceProvider
{
    use ConfigTrait;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerRoutes(__DIR__.'/../../routes/messages.php', __DIR__.'/../../routes/source.php');

        $this->setUpSourceFiles(function () {
            $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

            $this->publishes([
                __DIR__.'/../../database/migrations/' => database_path('migrations'),
            ], 'faithgen-messages-migrations');
        });

        $this->publishes([
            __DIR__.'/../../config/faithgen-messages.php' => config_path('faithgen-messages.php'),
        ], 'faithgen-messages-config');

        Message::observe(MessageObserver::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/faithgen-messages.php', 'faithgen-messages');
        $this->app->singleton(MessageService::class);
    }

    /**
     * @return array
     */
    public function routeConfiguration(): array
    {
        return [
            'prefix' => config('faithgen-messages.prefix'),
            'middleware' => config('faithgen-messages.middlewares'),
        ];
    }
}
