<?php
namespace LeviZoesch\LaravelSetEnvironment\Providers;

 

use Illuminate\Support\ServiceProvider;

 

class SetEnvironmentVariableProvider extends ServiceProvider

{

    public function boot()

    {

        $this->publishes([

            __DIR__.'/src' =>

            resource_path('app/Console/Commands/')

        ], 'commands');
       

    }

}
