<?php

return [
    /**
     * Track user login.
     *
     * Set to false to disable this feature.
     */
    'track_login'           => true,

    /**
     * Track user logout.
     *
     * Set to false to disable this feature.
     */
    'track_logout'          => true,

    /**
     * Where to store logs
     *
     * \Aginev\LoginActivity\Handlers\EloquentHandler::class - In database
     * \Aginev\LoginActivity\Handlers\LogHandler::class      - In laravel log files
     */
    'log'                   => \Aginev\LoginActivity\Handlers\EloquentHandler::class,

    /**
     * Number of latest logs to be returned
     */
    'number_of_latest_logs' => 100,
];