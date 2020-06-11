<?php

namespace SuperStation\Gamehub;

use Illuminate\Support\ServiceProvider;

class GamehubServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // 合併套件migration
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    public function register()
    {
        parent::register();

        $this->app->singleton('gamehub', Gamehub::class);
    }
}