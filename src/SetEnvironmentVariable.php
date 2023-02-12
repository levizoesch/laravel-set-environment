<?php
namespace LeviZoesch\LaravelSetEnvironment;

use Illuminate\Console\Command;

class SetEnvironmentVariable extends Command
{
    protected $signature = 'env:set {key} {value}';
    protected $description = 'Set an environment variable';

    public function handle(): void
    {
        $key = $this->argument('key');
        $value = $this->argument('value');

        putenv("$key=$value");

        $this->info("Environment variable [$key] set to [$value]");
    }
}
