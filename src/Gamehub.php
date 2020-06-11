<?php

namespace SuperStation\Gamehub;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Str;

class Gamehub extends Facade
{
    /**
     * 建立遊戲API服務中心
     *
     * @param string $stationCode
     * @param array $config
     * @return mixed
     */
    public function vendor(string $stationCode, array $config = [])
    {
        return app()->makeWith("gamehub.{$stationCode}.driver", [
            'config' => $config
        ]);
    }

    /**
     * 建立遊戲注單抓取器服務中心
     *
     * @param string $stationCode
     * @param array $config
     * @return mixed
     */
    public function fetcher(string $stationCode, array $config = [])
    {
        $driver = app()->makeWith("gamehub.{$stationCode}.driver", [
            'config' => $config
        ]);

        return app()->makeWith("gamehub.{$stationCode}.fetcher", [
             'driver' => $driver
        ]);
    }

    /**
     * 建立遊戲注單轉換器服務中心
     *
     * @param string $stationCode
     * @param array $config
     * @return
     */
    public function converter(string $stationCode, array $config = [])
    {
        $driver = app()->makeWith("gamehub.{$stationCode}.driver", [
            'config' => $config
        ]);

        return app()->makeWith("gamehub.{$stationCode}.converter", [
            'driver' => $driver
        ]);
    }

    /**
     * 建立路由註冊服務中心
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function routes()
    {
        foreach (app()->getBindings() as $alias => $con) {
            if (Str::of($alias)->is("gamehub.*.router")) {
                $router = app()->make($alias);
                $router->register();
            }
        }
    }
}