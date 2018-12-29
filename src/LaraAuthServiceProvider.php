<?php
/**
 * Created by PhpStorm.
 * User: jouleslabs
 * Date: 29/12/18
 * Time: 8:46 AM
 */
namespace Rakib\LaraAuth;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;

class LaraAuthServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Artisan::call('storage:link');
        $this->loadRoutesFrom(__DIR__ . '/Route/web.php');


        //publish everything
        $this->publishes([
            __DIR__.'/Views' => resource_path('views/'),
        ]);

        $this->publishes([
            __DIR__.'/Database/Migrations' => database_path('migrations/'),
        ]);

        $this->publishes([
           __DIR__.'/Models' => app_path('/'),
        ]);

        $this->publishes([
           __DIR__.'/Http/Controllers' => app_path('/Http/Controllers'),
           __DIR__.'/Http/Requests'     => app_path('/Http/Requests')
        ]);

        $this->publishes([
            __DIR__.'/Repositories' => app_path('/Repositories'),
            __DIR__.'/Services'     => app_path('/Services')
        ]);

        $this->publishes([
            __DIR__.'/Public' => storage_path('/app/public/'),
        ]);
    }

    public function register()
    {

    }
}
