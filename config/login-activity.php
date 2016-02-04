<?php

return [
    /**
     * Track user login.
     *
     * Set to false to disable this feature.
     */
    'track_login'  => true,

    /**
     * Track user logout.
     *
     * Set to false to disable this feature.
     */
    'track_logout' => true,

    /**
     * Where to store logs
     *
     * eloquent - In database
     * log      - In laravel log files
     */
    'log'          => 'eloquent'
];