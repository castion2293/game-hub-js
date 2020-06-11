<?php

namespace SuperStation\Gamehub\Contracts;

interface ReceiverContract
{
    /**
     * 取得玩家帳戶
     *
     * @param string $account
     * @param array $options
     * @return ReceiverContract
     */
    public function getPlayerAccount(string $account, array $options = []): ReceiverContract;

    /**
     * 檢查玩家帳戶項目
     *
     * @param array $checkItems
     * @param array $options
     * @return ReceiverContract
     */
    public function checkPlayerAccount(array $checkItems, array $options = []): ReceiverContract;

    /**
     * 取得玩家帳戶餘額
     *
     * @return array
     */
    public function getBalance(): array;

    /**
     * 修改玩家帳戶餘額
     *
     * @param float $amount
     * @param array $options
     * @return array
     */
    public function changeBalance(float $amount, array $options = []): ReceiverContract;
}