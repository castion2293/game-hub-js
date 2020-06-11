<?php

namespace SuperStation\Gamehub\Abstracts;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use SuperStation\Gamehub\Contracts\DriverContract;
use SuperStation\Gamehub\Events\StationWalletTradeEvent;

abstract class DriverAbstract implements DriverContract
{
    /**
     * 遊戲站呼叫器的相關設定
     *
     * @var array
     */
    protected $config = [];

    /**
     * DriverAbstract constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * 結果轉換成統一回應格式
     *
     * @param Response $response
     * @param array $arrayData
     * @return array
     */
    protected function responseFormatter(Response $response, array $arrayData): array
    {
        return [
            'http_code' => $response->status(),
            'http_headers' => $response->headers(),
            'http_contents' => $response->json(),
            'response' => $arrayData,
        ];
    }

    /**
     * 約定不足加密區塊長度填充字元
     *
     * @param string $text
     * @param string $chrPad
     * @param int $blockSize
     * @return string
     */
    protected function pkCs5Pad(string $text, string $chrPad = '', int $blockSize = 8)
    {
        $pad = $blockSize - (strlen($text) % $blockSize);
        $chrPad = strlen($chrPad) ? $chrPad : chr($pad);
        return $text . str_repeat($chrPad, $pad);
    }

    /**
     * 回傳遊戲館的時區
     *
     * @return mixed
     */
    public function getStationTimeZone()
    {
        return Arr::get($this->config, 'timezone');
    }

    /**
     * 回傳營運站代碼
     *
     * @return mixed
     */
    public function getSiteCode()
    {
        return Arr::get($this->config, 'site_code');
    }

    /**
     * 回傳營運站在該遊戲館裡使用的幣別
     *
     * @return mixed
     */
    public function getCurrency()
    {
        return Arr::get($this->config, 'currency');
    }

    /**
     * 回傳佔成設定深度
     *
     * @return mixed
     */
    public function getAllotmentDepth()
    {
        return Arr::get($this->config, 'allotment_depth');
    }

    /**
     * 回傳 回戳網域
     *
     * @return mixed
     */
    public function getDomain()
    {
        return Arr::get($this->config, 'domain');
    }
}

