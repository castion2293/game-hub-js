<?php

namespace SuperStation\Gamehub\Traits;

use Illuminate\Support\Arr;
use SuperStation\Gamehub\Events\PlayerAccountTradeEvent;
use SuperStation\Gamehub\Events\StationWalletTradeEvent;

trait EventTrait
{
    public static $create = 'insert';
    public static $update = 'update';

    /**
     * 交易狀態
     */
    public static $pending = 'pending';
    public static $completed = 'completed';
    public static $fail = 'fail';

    /**
     * 交易原因
     */
    public static $toGame = 'to_game';
    public static $fromGame = 'from_game';

    /**
     * 交易動作
     */
    public static $transfer = 'transfer';
    public static $rollback = 'rollback';

    /**
     * 觸發錢包交易紀錄事件
     *
     * @param string $columnName
     * @param null $params
     * @param array $options
     */
    protected function fireStationWalletTradeEvent(string $columnName, $params = null, array $options = [])
    {
        $stationWalletTradeRecordId = Arr::get($options, 'station_wallet_trade_record_id');

        // 如果 options 內容沒有錢包紀錄id 就無法找到紀錄資料 所以就無法寫紀錄
        if (empty($stationWalletTradeRecordId)) {
            return;
        }

        $text = json_encode($params, JSON_UNESCAPED_UNICODE);

        event(new StationWalletTradeEvent($stationWalletTradeRecordId, $columnName, $text));
    }

    /**
     * 觸發玩家帳戶交易紀錄事件
     *
     * @param array $params
     * @param array $options
     */
    protected function firePlayerAccountTradeEvent($params = [], array $options = [])
    {
        $amount = Arr::get($params, 'amount');

        event(
            new PlayerAccountTradeEvent(
                [
                    'action' => Arr::get($params, 'action'),
                    'serial_no' => Arr::get($params, 'serial_no'),
                    'account' => Arr::get($params, 'account'),
                    'reason' => ($amount < 0) ? EventTrait::$toGame : EventTrait::$fromGame,
                    'status' => Arr::get($params, 'status'),
                    'before_balance' => Arr::get($params, 'before_balance'),
                    'after_balance' => Arr::get($params, 'after_balance'),
                    'amount' => $amount,
                    'remark' => Arr::get($params, 'remark'),
                    'request' => json_encode(Arr::get($params, 'request', ''), JSON_UNESCAPED_UNICODE),
                    'response' => json_encode(Arr::get($params, 'response', ''), JSON_UNESCAPED_UNICODE),
                ]
            )
        );
    }
}