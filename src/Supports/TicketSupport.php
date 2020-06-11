<?php

namespace SuperStation\Gamehub\Supports;

use Illuminate\Support\Arr;
use SuperStation\Gamehub\Facades\Gamehub;

class TicketSupport
{
    /**
     * 手動撈單的 function 整合
     * 供super console專案 UnitedTicketFetchCommand使用
     *
     * @param string $station
     * @param string $startTime
     * @param string $endTime
     * @param array $config
     * @param array $wallet
     * @return mixed
     */
    public static function manualFetchAndConvertTickets(
        string $station,
        string $startTime,
        string $endTime,
        array $config,
        array $wallet = []
    ) {
        $fetcher = Gamehub::fetcher($station, $config);
        $converter = Gamehub::converter('dream_game', $config);

        // 手動戳注單API 並撈回注單
        $rawTickets = $fetcher->setPlayerParams($wallet)
            ->setTimeSpan($startTime, $endTime)
            ->capture()
            ->saveIntoNoSQL(true)
            ->report();

        // 注單轉換並存入MySQL
        $unitedTickets = $converter
            ->convert(Arr::get($rawTickets, 'raw_tickets'))
            ->saveIntoDatabase()
            ->report();

        return $unitedTickets;
    }

    /**
     * 自動撈單 function 整合
     * 供super console專案 FetchTicketsJob 使用
     *
     * @param string $station
     * @param array $config
     * @param array $wallet
     * @return mixed
     */
    public static function autoFetchTickets(string $station, array $config, array $wallet = [])
    {
        $fetcher = Gamehub::fetcher($station, $config);

        $rawTickets = $fetcher->setPlayerParams($wallet)
            ->autoFetchTimeSpan()
            ->capture()
            ->compare()
            ->saveIntoNoSQL()
            ->report();

        return $rawTickets;
    }

    /**
     * 自動轉單 function 整合
     * 供super console專案 ConvertTicketsJob 使用
     *
     * @param string $station
     * @param array $config
     * @return mixed
     */
    public static function autoConvertTickets(string $station, array $config)
    {
        $converter = Gamehub::converter($station, $config);

        $unitedTickets = $converter
            ->getRawTicketsFromNoSQL()
            ->convert()
            ->saveIntoDatabase()
            ->report();

        return $unitedTickets;
    }

    /**
     * 回傳注單的投注內容及開牌結果
     * 供SCP API使用
     *
     * @param string $station
     * @param array $config
     * @param string $ticketId
     * @return mixed
     */
    public static function getGameResult(string $station, array $config, string $ticketId)
    {
        $converter = Gamehub::converter($station, $config);

        $gameResult = $converter->gameResult($ticketId);

        return $gameResult;
    }
}