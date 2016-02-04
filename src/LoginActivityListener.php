<?php

namespace Aginev\LoginActivity;

use Illuminate\Events\Dispatcher;

class LoginActivityListener
{

    /**
     * Handle user login events.
     * @param $event
     */
    public function onUserLogin($event)
    {
        LoginActivityFacade::login($event);
    }

    /**
     * Handle user logout events.
     * @param $event
     */
    public function onUserLogout($event)
    {
        LoginActivityFacade::logout($event);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Dispatcher $events
     */
    public function subscribe($events)
    {
        if (config('login-activity.track_login', false)) {
            $events->listen(
                \Illuminate\Auth\Events\Login::class,
                'Aginev\LoginActivity\LoginActivityListener@onUserLogin'
            );
        }

        if (config('login-activity.track_logout', false)) {
            $events->listen(
                \Illuminate\Auth\Events\Logout::class,
                'Aginev\LoginActivity\LoginActivityListener@onUserLogout'
            );
        }
    }
}