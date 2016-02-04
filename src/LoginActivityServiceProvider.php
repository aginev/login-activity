<?php

namespace Aginev\LoginActivity;

use Illuminate\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use Aginev\LoginActivity\Exceptions\LoginActivityException;

class LoginActivityServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerHandlerBinding();

        $this->app->bind('Aginev\LoginActivity', function ($app) {
            return new LoginActivity($app->make(Handlers\LogActivityInterface::class));
        });

        // Add alias for LoginActivityFacade
        $this->app->alias('LoginActivity', LoginActivityFacade::class);
    }

    /**
     * Bootstrap the application services.
     * @param Dispatcher $dispatcher
     */
    public function boot(Dispatcher $dispatcher)
    {
        // Merge config
        $this->mergeConfigFrom(base_path('vendor/aginev/login-activity/config/login-activity.php'), 'login-activity');
        // Publish config
        $this->publishes([
            base_path('vendor/aginev/login-activity/config/login-activity.php') => config_path('login-activity.php'),
        ], 'config');

        // Publish migrations
        $this->publishes([
            base_path('vendor/aginev/login-activity/migrations/create_user_login_activities_table.php') => database_path('/migrations/' . date('Y_m_d_His', time()) . '_create_user_login_activities_table.php'),
        ], 'migrations');

        // Register event subscriber
        $dispatcher->subscribe(LoginActivityListener::class);
    }

    /**
     * Register handler binding based on config log value
     *
     * @throws LoginActivityException
     */
    private function registerHandlerBinding() {
        $handler = ucfirst(config('login-activity.log', 'eloquent'));

        if (!in_array($handler, ['Eloquent', 'Log'])) {
            throw new LoginActivityException('Invalid log type!');
        }

        $this->app->bind(Handlers\LogActivityInterface::class, '\Aginev\LoginActivity\Handlers\\' . $handler . 'Handler');
    }
}