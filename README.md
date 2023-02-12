# LaravelSetEnvironment
A simple command to set a Laravel env variable, and value.

Composer command
```composer
composer require levizoesch/laravelsetenvironment
```

add command to your `app\Console\Kernal.php`

```php
    protected $commands = [
        SetEnvironmentVariable::class
    ];
```
