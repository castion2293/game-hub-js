<?php

namespace SuperStation\Gamehub\Abstracts;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use SuperStation\Gamehub\Contracts\DriverContract;
use Symfony\Component\Console\Output\ConsoleOutput;

class ConverterAbstract
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
     * 整合後的注單
     *
     * @var array
     */
    protected $unitedTickets = [];

    /**
     * ConverterAbstract constructor.
     * @param DriverContract $driver
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct(DriverContract $driver)
    {
        $this->driver = $driver;
        $this->consoleOutput = new ConsoleOutput();
    }

    /**
     * 回戳 {SCP域名}/tree_allotments 尋找注單的節點樹及輸贏佔成
     *
     * @param array $unitedTickets
     * @return array
     */
    protected function findTreeAllotment(array $unitedTickets): array
    {
        $allotmentDepth = $this->driver->getAllotmentDepth();

        $treeAllotmentData = collect($this->unitedTickets)->mapWithKeys(function ($unitedTicket) use ($allotmentDepth) {
            if ($allotmentDepth === 'station') {
                return [
                    Arr::get($unitedTicket, 'id') => [
                        'player_username' => Arr::get($unitedTicket, 'player_username'),
                        'station' => Arr::get($unitedTicket, 'station'),
                    ],
                ];
            }

            return [
                Arr::get($unitedTicket, 'id') => [
                    'player_username' => Arr::get($unitedTicket, 'player_username'),
                    'station' => Arr::get($unitedTicket, 'station'),
                    'game_scope' => Arr::get($unitedTicket, 'game_scope')
                ],
            ];
        })->toArray();

        $response = Http::post($this->driver->getDomain() . '/tree_allotments', [
            'tickets' => $treeAllotmentData,
        ]);

        return Arr::get($response->json(), 'tree_allotments');
    }
}