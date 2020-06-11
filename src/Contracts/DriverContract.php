<?php

namespace SuperStation\Gamehub\Contracts;

/**
 * 遊戲驅動器介面
 *
 * Interface DriverContract
 * @package SuperStation\Gamehub\Contracts
 */
interface DriverContract
{
    /**
     * 建立帳號
     *
     * @param array $wallet
     * @param array $options
     * @return array
     */
    public function createAccount(array $wallet, array $options = []): array;

    /**
     * 取得登入通行證 / 連結
     *
     * @param array $wallet
     * @param array $options
     * @return array
     */
    public function passport(array $wallet, array $options = []): array ;

    /**
     * 取得餘額
     *
     * @param array $wallet
     * @param array $options
     * @return array
     */
    public function balance(array $wallet, array $options = []): array;

    /**
     * 儲值點數
     *
     * @param array $wallet
     * @param float $amount
     * @param string $serialNo
     * @param array $options
     * @return array
     */
    public function deposit(array $wallet, float $amount, string $serialNo, array $options = []): array;

    /**
     * 回收點數
     *
     * @param array $wallet
     * @param float $amount
     * @param string $serialNo
     * @param array $options
     * @return array
     */
    public function withdraw(array $wallet, float $amount, string $serialNo, array $options = []): array;


    /**
     * 檢查交易流水號
     *
     * @param array $wallet
     * @param string $serialNo
     * @param array $options
     * @return array
     */
    public function checkTransfer(array $wallet, string $serialNo, array $options = []): array;

    /**
     * 修改限紅
     *
     * @param array $wallet
     * @param $betLimit
     * @param array $options
     * @return array
     */
    public function updateLimit(array $wallet, $betLimit, array $options = []): array;

    /**
     * 撈取注單
     *
     * @param array $params
     * @return array
     */
    public function fetchTickets(array $params = []): array;
}