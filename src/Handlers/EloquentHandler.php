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
}