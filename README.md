# Track user login activity in Laravel 5
This package will subscribe for login and logout events and will log data into database or log files.

## Features
- Composer installable
- PSR4 auto loading
- Track user login
- Track user logout
- Write logs in database or log files
- Command for cleaning logs

## Requires
Build only for Laravel Framework 5 only!

## Installation
In terminal
```sh
composer require aginev/login-activity:1.0.*
```

Add Service Provider to your config/app.php like so
```php
// config/app.php

'providers' => [
    '...',
    Aginev\LoginActivity\LoginActivityServiceProvider::class,
];
```

Publish migrations
```sh
php artisan vendor:publish --provider="Aginev\LoginActivity\LoginActivityServiceProvider" --tag="migrations"
php artisan migrate
```

Optionally you can add login activity command and you will be able to clean your logs.
```php
// app/Console/Kernel.php

protected $commands = [
    '...',
    \Aginev\LoginActivity\Commands\LoginActivityClean::class,
];
```

Optionally publish config
```sh
php artisan vendor:publish --provider="Aginev\LoginActivity\LoginActivityServiceProvider" --tag="config"
```

## Usage

Get logs
```php
$logs = LoginActivity::getLogs()->get();
```

Get latest logs
```php
$logs = LoginActivity::getLatestLogs(100); // number of logs to get or leave empty if you want to use the config value
```

Get login logs
```php
$logs = LoginActivity::getLoginLogs()->get();
```

Get latest login logs
```php
$logs = LoginActivity::getLatestLoginLogs(100); // number of logs to get or leave empty if you want to use the config value
```

Get logout logs
```php
$logs = LoginActivity::getLogoutLogs()->get();
```

Get latest logout logs
```php
$logs = LoginActivity::getLatestLogoutLogs(100); // number of logs to get or leave empty if you want to use the config value
```

Clean log
```php
$logs = LoginActivity::cleanLog(30); // Offset in days
```

Clean the log from terminal
```sh
php artisan login-activity:clean
```

## Custom handler implmentations
1. Implement \Aginev\LoginActivity\Handlers\LogActivityInterface in your custom handler. 
2. Place custom handler as value in login-activity.log config

## Credits
https://github.com/spatie/activitylog

## License
MIT - http://opensource.org/licenses/MIT
