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

    /**
     * Get all logs
     *
     * @return mixed
     */
    public function getLogs();

    /**
     * Get getLatest logs
     *
     * @param null $limit
     * @return mixed
     */
    public function getLatestLogs($limit = null);

    /**
     * Get login logs
     *
     * @return mixed
     */
    public function getLoginLogs();

    /**
     * Get getLatest login logs
     *
     * @param null $limit
     * @return mixed
     */
    public function getLatestLoginLogs($limit = null);

    /**
     * Get logout logs
     *
     * @return mixed
     */
    public function getLogoutLogs();

    /**
     * Get getLatest logout logs
     *
     * @param null $limit
     * @return mixed
     */
    public function getLatestLogoutLogs($limit = null);
}