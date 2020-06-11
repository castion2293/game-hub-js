<?php

namespace SuperStation\Gamehub\Contracts;

interface RouterContract
{
    /**
     * 註冊路由
     */
    public function register(): void;
}