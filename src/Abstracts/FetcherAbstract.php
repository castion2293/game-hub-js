<?php

namespace SuperStation\Gamehub\Abstracts;

use SuperStation\Gamehub\Contracts\DriverContract;
use Symfony\Component\Console\Output\ConsoleOutput;

abstract class FetcherAbstract
{
    /**
     * 遊戲服務中心
     *
     * @var DriverContract
     */
    protected $driver;

    /**
     * @var ConsoleOutput
     */
    protected $consoleOutput;

    /**
     * 收集抓到的原始注單
     *
     * @var array
     */
    protected $rawTickets = [];

    /**
     * 撈單開始時間
     *
     * @var
     */
    protected $captureBegin;

    /**
     * 一般參數
     *
     * @var array
     */
    protected $formParams = [];

    /**
     * FetcherAbstract constructor.
     * @param DriverContract $driver
     */
    public function __construct(DriverContract $driver)
    {
        $this->driver = $driver;
        $this->consoleOutput = new ConsoleOutput();
    }

    /**
     * 撈單開始執行並取得開始時間
     *
     * @param string $station
     * @param string $startTime
     * @param string $endTime
     */
    protected function captureBegin(string $station, string $startTime, string $endTime)
    {
        $this->captureBegin = microtime();

        $this->consoleOutput->writeln(
            join(PHP_EOL, [
                "=====================================",
                "  原生注單抓取程序啟動                  ",
                "-------------------------------------",
                "　　遊戲站: {$station}                 ",
                "　  開始時間: {$startTime}",
                "　  結束時間: {$endTime}",
                ""
            ]));
    }

    /**
     * 撈單結束執行並取得花費時間
     */
    protected function captureEnd()
    {
        $this->consoleOutput->writeln(
            join(
                PHP_EOL,
                [
                    "--",
                    "　共花費 " . $this->microTimeDiff($this->captureBegin, microtime()) . ' 秒',
                    "=====================================",
                    '',
                ]
            )
        );
    }

    /**
     * 輔助函式: 取得兩個時間的毫秒差
     *
     * @param $start
     * @param null $end
     * @return float
     */
    private function microTimeDiff($start, $end = null)
    {
        if (!$end) {
            $end = microtime();
        }
        list($start_usec, $start_sec) = explode(" ", $start);
        list($end_usec, $end_sec) = explode(" ", $end);
        $diff_sec = intval($end_sec) - intval($start_sec);
        $diff_usec = floatval($end_usec) - floatval($start_usec);
        return floatval($diff_sec) + $diff_usec;
    }
}