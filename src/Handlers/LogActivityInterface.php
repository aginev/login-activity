<?php

namespace Aginev\LoginActivity\Handlers;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;

interface LogActivityInterface
{

    /**
     * Log login event
     *
     * @param Login $login
     * @return mixed
     */
    public function login(Login $login);

    /**
     * Log logout event
     *
     * @param Logout $logout
     * @return mixed
     */
    public function logout(Logout $logout);

    /**
     * Clean old logs.
     *
     * @param int $offset Offset in days
     *
     * @return bool
     */
    public function cleanLog($offset);
}