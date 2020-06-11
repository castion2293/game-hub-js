<?php

namespace SuperStation\Gamehub;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use SuperStation\Gamehub\Contracts\VendorProviderContract;

abstract class VendorProviderAbstract extends ServiceProvider implements VendorProviderContract, DeferrableProvider
{
    protected $defer = false;

    /**
     * 預先載入的 providers
     *
     * 注意： 必需實作 DeferrableProvider 介面
     *       而 $defer = true 作法將於 5.9 版後棄用
     *
     * @return array
     */
    public function provides()
    {
        return ['gamehub'];
    }

    /**
     * 註冊遊戲套件驅動器
     */
    public function register()
    {
        parent::register();

        // 註冊驅動器
        if (class_exists($this->getVendorDriver())) {
            $this->app->singleton(
                "gamehub.{$this->getVendorCode()}.driver",
                $this->getVendorDriver()
            );
        }

        // 註冊抓取器
        if (class_exists($this->getVendorFetcher())) {
            $this->app->singleton(
                "gamehub.{$this->getVendorCode()}.fetcher",
                $this->getVendorFetcher()
            );
        }

        // 註冊轉換器
        if (class_exists($this->getVendorConverter())) {
            $this->app->singleton(
                "gamehub.{$this->getVendorCode()}.converter",
                $this->getVendorConverter()
            );
        }

        // 註冊路由器
        if (class_exists($this->getVendorRouter())) {
            $this->app->singleton(
                "gamehub.{$this->getVendorCode()}.router",
                $this->getVendorRouter()
            );
        }

        // 註冊接受器
        if (class_exists($this->getVendorReceiver())) {
            $this->app->singleton(
                "gamehub.{$this->getVendorCode()}.receiver",
                $this->getVendorReceiver()
            );
        }
    }
}