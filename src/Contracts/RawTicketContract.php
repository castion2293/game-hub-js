<?php

namespace SuperStation\Gamehub\Contracts;

/**
 * 原生注單介面
 *
 * Interface rawTicketContract
 * @package SuperStation\Gamehub\Contracts
 */
interface RawTicketContract
{
    /**
     * 取得唯一的識別碼
     */
    public function getUuidAttribute();

    /**
     * 取得原生注單各欄位串接起來的雜揍狀態，供比對使用
     */
    public function getMd5HashAttribute();
}