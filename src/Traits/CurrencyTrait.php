<?php

namespace SuperStation\Gamehub\Traits;

use Illuminate\Support\Arr;

trait CurrencyTrait
{
    /**
     * 特殊幣別比率轉換
     *
     * @param string $action
     * @param string $currency
     * @param array $rate
     * @param $amount
     * @return float|int
     * @throws \Exception
     */
    protected function currencyTransformer(string $action, string $currency, array $rate, $amount)
    {
        $multipleActions = [
            'balance', // 取得餘額
            'convert', // 轉換注單
        ];

        $divideActions = [
            'deposit', // 轉入點數
            'withdraw' // 轉出點數
        ];

        // 該幣別不需做轉換
        $isNotInRateCurrency = (empty($currency)) || (!array_key_exists($currency, $rate));
        if ($isNotInRateCurrency) {
            return $amount;
        }

        // "乘" 上幣別對應比例
        if (in_array($action, $multipleActions)) {
            return $amount * Arr::get($rate, $currency);
        }

        // "除" 上幣別對應比例
        if (in_array($action, $divideActions)) {
            return $amount / Arr::get($rate, $currency);
        }

        throw new \Exception('特殊幣別比率轉換 currencyTransformer() 找不到提供的對應方法');
    }
}