<?php

namespace Vadiasov\TracksAdmin;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class TracksServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
//        $router->aliasMiddleware('tracks-admin', \Vadiasov\TracksAdmin\Middleware\TracksMiddleware::class);
    
        $this->publishes([
//            __DIR__ . '/Config/tracksAdmin.php' => config_path('tracksAdmin.php'),
//            __DIR__ . '/Translations'            => resource_path('lang/vendor/tracks-admin'),
//            __DIR__ . '/Views'                   => resource_path('views/vendor/tracks-admin'),
        ]);
//        $this->publishes([__DIR__ . '/Assets' => public_path('vendor/tracks-admin'),], 'tracks_admin_assets');
    
        $this->loadRoutesFrom(__DIR__ . '/Routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/Translations', 'tracks-admin');
        $this->loadViewsFrom(__DIR__ . '/Views', 'tracks-admin');
    
//        if ($this->app->runningInConsole()) {
//            $this->commands([
//                \Vadiasov\TracksAdmin\Commands\TracksAdminCommand::class,
//            ]);
//        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->mergeConfigFrom(
//            __DIR__ . '/Config/tracksAdmin.php', 'tracksAdmin'
//        );
        $this->app->make('Vadiasov\TracksAdmin\Requests\TrackRequest');
        $this->app->make('Vadiasov\TracksAdmin\Controllers\TracksController');
    }
}
