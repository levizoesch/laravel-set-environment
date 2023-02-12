<?php
namespace levizoesch\laravelsetenvironment;

use Illuminate\Console\Command;

class SetEnvironmentVariable extends Command
{
    protected $signature = 'env:set {key} {value}';
    protected $description = 'Set an environment variable';

    public function handle(): void
    {
        $key = $this->argument('key');
        $value = $this->argument('value');

        $env[$key] = $value;
        $this->setEnvValues($env);
        $this->info("Environment variable [$key] set to [$value]");
    }
    
    private function setEnvValues(array $values): bool
    {
        $envFilePath = app()->environmentFilePath();

        $envFileContents = file_get_contents($envFilePath);

        if (!$envFileContents) {
            $this->error('Could not read `.env` file!');

            return false;
        }

        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {
                if ($this->isEnvKeySet($envKey, $envFileContents)) {
                    $envFileContents = preg_replace("/^{$envKey}=.*?[\s$]/m", "{$envKey}={$envValue}\n", $envFileContents);

                    $this->info("Updated {$envKey} with new value in your `.env` file.");
                } else {
                    $envFileContents .= "{$envKey}={$envValue}\n";

                    $this->info("Added {$envKey} to your `.env` file.");
                }
            }
        }

        if (!file_put_contents($envFilePath, $envFileContents)) {
            $this->error('Updating the `.env` file failed!');

            return false;
        }

        return true;
    }
    
    private function isEnvKeySet(string $envKey, ?string $envFileContents = null): bool
    {
        $envFileContents = $envFileContents ?? file_get_contents(app()->environmentFilePath());

        return (bool)preg_match("/^{$envKey}=.*?[\s$]/m", $envFileContents);
    }
}
