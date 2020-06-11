<?php

namespace SuperStation\Gamehub\Contracts;

/**
 * 遊戲注單服務中心介面
 *
 * Interface ReporterContract
 * @package SuperStation\Gamehub\Contracts
 */
interface FetcherContract
{
    /**
     * 設定手動撈單時間區間
     *
     * @param string $fromTime
     * @param string $toTime
     * @return FetcherContract
     */
    public function setTimeSpan(string $fromTime = '', string $toTime = ''): FetcherContract;

    /**
     * 設定自動撈單時間區間
     *
     * @return FetcherContract
     */
    public function autoFetchTimeSpan(): FetcherContract;

    /**
     * 設定玩家資料 如果撈單方式是以會員為單位
     *
     * @param array $wallet
     * @return FetcherContract
     */
    public function setPlayerParams(array $wallet = []): FetcherContract;

    /**
     * 撈取遊戲原生注單
     *
     * @return FetcherContract
     */
    public function capture(): FetcherContract;

    /**
     * 比對這次原生注單與上一次撈取到的注單狀態
     *
     * @return FetcherContract
     */
    public function compare(): FetcherContract;

    /**
     * 存原生注單至MongoDB
     *
     * @param bool $isConverted (true: 手動撈單 直接做轉換, false: 自動撈單)
     * @param array $rawTickets (單一錢包 注單資訊使用回戳方式 就帶入這裡)
     * @return FetcherContract
     */
    public function saveIntoNoSQL(bool $isConverted = false, array $rawTickets = []): FetcherContract;

    /**
     * 回傳遊戲原生注單結果
     *
     * @return array
     */
    public function report(): array;
}