<?php
namespace JanDolata\TranslationsEditor;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class TranslationsEditorServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // use this if your package has views
        if(config('TranslationsEditor.useDefault'))
            $this->loadViewsFrom(realpath(__DIR__.'/resources/views'), 'TranslationsEditor');

        // use this if your package has lang files
        // $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'TranslationsEditor');

        // use this if your package has routes
        if(config('TranslationsEditor.useDefault'))
            $this->setupRoutes($this->app->router);

        // use this if your package needs a config file
        $this->publishes([
                __DIR__.'/config/config.php' => config_path('TranslationsEditor.php'),
        ]);

        // use the vendor configuration file as fallback
        $this->mergeConfigFrom(
            __DIR__.'/config/config.php', 'TranslationsEditor'
        );
    }
    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'JanDolata\TranslationsEditor\Http\Controllers'], function($router)
        {
            require __DIR__.'/Http/routes.php';
        });
    }
    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerTranslationsEditor();

        // use this if your package has a config file
        config([
                'config/TranslationsEditor.php',
        ]);
    }
    private function registerTranslationsEditor()
    {
        $this->app->bind('TranslationsEditor',function($app){
            return new TranslationsEditor($app);
        });
    }
}
