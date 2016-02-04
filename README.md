# Track user login activity in Laravel 5

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
// app//Console/Kernel.php

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
This package will subscribe for login and logout events and will log data into database or log files.

### Get latest logs (available only if )

## Credits
https://github.com/spatie/activitylog

## License
MIT - http://opensource.org/licenses/MIT
