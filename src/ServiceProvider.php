<?php

namespace Lykegenes\DatagridBuilder;

/**
 * @codeCoverageIgnore
 */
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $configPath = __DIR__.'/../config/config.php';
        $this->mergeConfigFrom($configPath, 'datagrid-builder');

        $this->registerDatagridHelper();

        $this->app->singleton('datagrid-builder', function ($app) {

            return new DatagridBuilder($app, $app['datagrid-helper']);
        });
    }

    protected function registerDatagridHelper()
    {
        $this->app->singleton('datagrid-helper', function ($app) {

            return new DatagridHelper($app['view'], $app['request'], $app['config']);
        });

        $this->app->alias('datagrid-helper', 'Lykegenes\DatagridBuilder\DatagridHelper');
    }

    public function boot()
    {
        $configPath = __DIR__.'/../config/config.php';
        $viewsPath = __DIR__.'/../views';
        $langPath = __DIR__.'/../lang';

        $this->loadViewsFrom($viewsPath, 'datagrid-builder');
        $this->loadTranslationsFrom($langPath, 'datagrid-builder');

        $this->publishes([$configPath => $this->getConfigPath()], 'config');
        $this->publishes([$viewsPath => $this->getViewsPath()], 'views');
        $this->publishes([$langPath => $this->getLangPath()], 'lang');
    }

    /**
     * @return string[]
     */
    public function provides()
    {
        return ['datagrid-builder'];
    }

    /**
     * Get the config path.
     *
     * @return string
     */
    protected function getConfigPath()
    {
        return config_path('datagrid-builder.php');
    }

    /**
     * Get the views path.
     *
     * @return string
     */
    protected function getViewsPath()
    {
        return base_path('resources/views/vendor/datagrid-builder');
    }

    /**
     * Get the lang path.
     *
     * @return string
     */
    protected function getLangPath()
    {
        return base_path('resources/lang/vendor/datagrid-builder');
    }
}
