<?php

namespace Aginev\LoginActivity\Handlers;

use Aginev\LoginActivity\Models\UserLoginActivity;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Request;

class EloquentHandler implements LogActivityInterface
{

    /**
     * Log login event
     *
     * @param Login $login
     * @return mixed
     */
    public function login(Login $login)
    {
        $this->createActivity($login->user->id, __FUNCTION__, $login->remember);
    }

    /**
     * Log logout event
     *
     * @param Logout $logout
     * @return mixed
     */
    public function logout(Logout $logout)
    {
        if ($logout->user) {
            $this->createActivity($logout->user->id, __FUNCTION__);
        }
    }

    /**
     * Clean old logs.
     *
     * @param int $offset Offset in days
     *
     * @return bool
     */
    public function cleanLog($offset = 30)
    {
        $past = Carbon::now()->subDays($offset);

        UserLoginActivity::where('created_at', '<=', $past)->delete();

        return true;
    }

    /**
     * Get all logs
     *
     * @return UserLoginActivity
     */
    public function getLogs() {
        return new UserLoginActivity();
    }

    /**
     * Get latest logs
     *
     * @param null $limit
     * @return mixed
     */
    public function latestLogs($limit = null) {
        return UserLoginActivity::take($this->setLimit($limit))->get();
    }


    /**
     * Get login logs
     *
     * @return mixed
     */
    public function getLoginLogs() {
        return UserLoginActivity::where('event', '=', 'login');
    }

    /**
     * Get latest login logs
     *
     * @param null $limit
     * @return mixed
     */
    public function latestLoginLogs($limit = null) {
        return UserLoginActivity::where('event', '=', 'login')->take($this->setLimit($limit))->get();
    }

    /**
     * Get logout logs
     *
     * @return mixed
     */
    public function getLogoutLogs() {
        return UserLoginActivity::where('event', '=', 'logout');
    }

    /**
     * Get latest logout logs
     *
     * @param null $limit
     * @return mixed
     */
    public function latestLogoutLogs($limit = null) {
        return UserLoginActivity::where('event', '=', 'logout')->take($this->setLimit($limit))->get();
    }

    /**
     * Create user login activity
     *
     * @param $user_id
     * @param $event_name
     * @param bool $remember
     * @return UserLoginActivity
     */
    protected function createActivity($user_id, $event_name, $remember = false)
    {
        $activity = new UserLoginActivity();
        $activity->user_id = $user_id;
        $activity->remember = $remember;
        $activity->ip_address = Request::ip();
        $activity->event = $event_name;
        $activity->save();

        return $activity;
    }

    /**
     * Setup logs query limit
     *
     * @param null $limit
     * @return mixed|null
     */
    protected function setLimit($limit = null) {
        if (!$limit) {
            $limit = config('login-activity.number_of_latest_logs', 100);
        }

        return $limit;
    }
}