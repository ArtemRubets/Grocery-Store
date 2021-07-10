<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('management', function (){

            $role = session('user_role');
            $condition = false;

            if ($role == 'admin' || $role == 'manager') $condition = true;

            return $condition;
        });

        Blade::directive('currentroute', function ($routeName){
            return "<?php echo Illuminate\Support\Facades\Route::currentRouteNamed($routeName) ? 'class=\"active\"' : '' ?>";
        });
    }
}
