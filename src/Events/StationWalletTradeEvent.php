<?php

namespace SuperStation\Gamehub\Events;

class StationWalletTradeEvent
{
    /**
     * 錢包紀錄識別碼
     *
     * @var
     */
    public $stationWalletTradeRecordId = '';

    /**
     * station_wallet_trade_records 欄位名稱
     *
     * @var string
     */
    public $columnName = '';

    /**
     * station_wallet_trade_records 欄位內容
     *
     * @var string
     */
    public $text = '';

    /**
     * StationWalletTradeEvent constructor.
     * @param string $stationWalletTradeRecordId
     * @param string $columnName
     * @param string $text
     */
    public function __construct(string $stationWalletTradeRecordId, string $columnName, string $text)
    {
        $this->stationWalletTradeRecordId = $stationWalletTradeRecordId;
        $this->columnName = $columnName;
        $this->text = $text;
    }
}