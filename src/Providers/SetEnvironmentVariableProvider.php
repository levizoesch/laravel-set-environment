namespace App\Providers;

 

use Illuminate\Support\ServiceProvider;

 

class SetEnvironmentVariableProvider extends ServiceProvider

{

    public function boot()

    {

        $this->publishes([

            __DIR__.'/example/translations' =>

            resource_path('lang/vendor/example')

        ], 'translations');
       

    }

}
