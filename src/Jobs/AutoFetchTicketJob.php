<?php

namespace SuperStation\Gamehub\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use SuperStation\Gamehub\Supports\TicketSupport;

class AutoFetchTicketJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * 遊戲站識別碼
     *
     * @var string
     */
    public $station;

    /**
     * 環境配置參數
     *
     * @var array
     */
    public $config = [];

    /**
     * AutoFetchTicketJob constructor.
     * @param string $station
     * @param array $config
     */
    public function __construct(string $station, array $config)
    {
        $this->station = $station;
        $this->config = $config;
    }

    /**
     * @return void
     */
    public function handle()
    {
        TicketSupport::autoFetchTickets($this->station, $this->config);
    }
}