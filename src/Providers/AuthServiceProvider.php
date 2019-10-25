<?php

namespace FaithGen\Messages\Providers;

use FaithGen\Messages\Policies\MessagePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //messages gates
        Gate::define('message.create', [MessagePolicy::class, 'create']);
        Gate::define('message.update', [MessagePolicy::class, 'update']);
        Gate::define('message.delete', [MessagePolicy::class, 'delete']);
        Gate::define('message.view', [MessagePolicy::class, 'view']);
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
