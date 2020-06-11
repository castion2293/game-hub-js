<?php

namespace SuperStation\Gamehub\Abstracts;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use SuperStation\Gamehub\Contracts\ReceiverContract;
use SuperStation\Gamehub\Traits\EventTrait;

abstract class ReceiverAbstract implements ReceiverContract
{
    public static $AccountExist = 'isPlayerAccountNotFound';
    public static $AccountFreezing = 'isPlayerAccountFreezing';
    public static $BalanceEnough = 'isBalanceNotEnough';

    /**
     * 玩家帳號檢查的錯誤訊息
     *
     * @var array
     */
    public $accountCheckExceptions = [];

    public function __construct()
    {
        $this->accountCheckExceptions = [
            self::$AccountExist => '玩家帳戶找不到',
            self::$AccountFreezing => '玩家帳戶被凍結',
            self::$BalanceEnough => '帳戶餘額不足',
        ];
    }

    /**
     * 玩家帳戶
     *
     * @var
     */
    public $playerAccount;

    /**
     * 獲取玩家帳戶
     *
     * @param string $account
     * @param array $options
     * @return ReceiverContract
     */
    public function getPlayerAccount(string $account, array $options = []): ReceiverContract
    {
        $this->playerAccount = DB::table('player_accounts')
            ->select('id', 'account', 'balance', 'status')
            ->where('account', $account)
            ->first();

        return $this;
    }

    /**
     * 檢查玩家帳戶項目
     *
     * @param array $checkItems
     * @param array $options
     * @return ReceiverContract
     * @throws \Exception
     */
    public function checkPlayerAccount(array $checkItems, array $options = []): ReceiverContract
    {
        foreach ($checkItems as $checkItem) {
            if ($this->$checkItem($options)) {
                throw new \Exception(Arr::get($this->accountCheckExceptions, $checkItem));
            }
        }

        return $this;
    }

    /**
     * 取得玩家帳戶餘額
     *
     * @return array
     */
    public function getBalance(): array
    {
        return [
            'balance' => data_get($this->playerAccount, 'balance')
        ];
    }

    /**
     * 修改玩家帳戶餘額
     *
     * @param float $amount
     * @param array $options
     * @return array
     * @throws \Exception
     */
    public function changeBalance(float $amount, array $options = []): ReceiverContract
    {
        DB::table('player_accounts')
            ->lockForUpdate()
            ->where('id', data_get($this->playerAccount, 'id'))
            ->update([
                'balance' => DB::raw("balance + {$amount}")
             ]);

        return $this;
    }

    /**
     * 檢查玩家帳戶不存在
     *
     * @param array $options
     * @return bool
     */
    private function isPlayerAccountNotFound($options = []): bool
    {
        $account = data_get($this->playerAccount, 'account');

        return empty($account);
    }

    /**
     * 檢查玩家帳戶被凍結
     *
     * @param array $options
     * @return bool
     */
    private function isPlayerAccountFreezing($options = []): bool
    {
        return data_get($this->playerAccount, 'status') === 'freezing';
    }

    /**
     * 檢查玩家帳戶餘額是否足夠
     *
     * @param array $options
     * @return bool
     */
    private function isBalanceNotEnough($options = []): bool
    {
        $balance = data_get($this->playerAccount, 'balance');
        $amount = Arr::get($options, 'amount');

        return ($balance + $amount) < 0;
    }
}