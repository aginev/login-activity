<?php

namespace Aginev\LoginActivity;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;

class LoginActivity
{

    protected $handler;

    public function __construct(Handlers\LogActivityInterface $handler)
    {
        $this->handler = $handler;
    }

    public function login(Login $event)
    {
        $this->handler->login($event);
    }

    public function logout(Logout $event)
    {
        $this->handler->logout($event);
    }

    public function cleanLog($offset = 30)
    {
        $this->handler->cleanLog($offset);
    }

}