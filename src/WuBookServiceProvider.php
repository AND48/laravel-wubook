<?php

/*
 * This file is part of Laravel WuBook.
 *
 * (c) Filippo Galante <filippo.galante@b-ground.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AND48\LaravelWubook;

use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

/**
 * This is the WuBook service provider class.
 *
 * @author Filippo Galante <filippo.galante@b-ground.com>
 */
class WuBookServiceProvider extends ServiceProvider
{

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            // Export the migration
            if (! class_exists('CreateWubookConfigsTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_wubook_configs_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_wubook_configs_table.php'),
                ], 'migrations');
            }

        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('wubook', function($app) {
            return new WuBookManager();
        });
    }
}
