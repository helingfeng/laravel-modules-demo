<?php
namespace LaravelModulesDemo\Backend\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class TestProvider extends ServiceProvider
{
    protected $namespace = 'LaravelModulesDemo\Backend\Controllers';


    /**
     * Boot the provider.
     */
    public function boot()
    {
        Route::group([
            'middleware' => ['web'],
            'namespace' => $this->namespace,
        ], function ($router) {
            $router->get('/test/plugin', 'IndexController@index');
        });

        $this->loadViewsFrom(__DIR__ . '/../../Frontend/views', 'test-plugin');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../Frontend/assets' => public_path('test_plugin/assets')
            ], 'file-manage-assets');
        }

    }

}