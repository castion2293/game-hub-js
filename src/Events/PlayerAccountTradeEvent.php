<?php

namespace SuperStation\Gamehub\Events;

use Illuminate\Support\Arr;

class PlayerAccountTradeEvent
{
    /**
     * 交易紀錄資料庫動作
     *
     * @var mixed|string
     */
    public $action = '';

    /**
     * 交易流水號
     *
     * @var string
     */
    public $serialNo = '';

    /**
     * 玩家錢包帳戶帳號
     *
     * @var string
     */
    public $account = '';

    /**
     * 交易原因
     *
     * @var string
     */
    public $reason = '';

    /**
     *  交易狀態
     *
     * @var string
     */
    public $status = '';

    /**
     * 交易前餘額
     *
     * @var
     */
    public $beforeBalance;

    /**
     * 交易後餘額
     *
     * @var
     */
    public $afterBalance;

    /**
     * 交易量
     *
     * @var
     */
    public $amount;

    /**
     * 交易備註
     *
     * @var
     */
    public $remark;

    /**
     * 請求參數
     *
     * @var
     */
    public $request;

    /**
     * 回應內容
     *
     * @var
     */
    public $response;

    public function __construct(array $params = [])
    {
        $this->action = Arr::get($params, 'action');
        $this->serialNo = Arr::get($params, 'serial_no');
        $this->account = Arr::get($params, 'account');
        $this->reason = Arr::get($params, 'reason');
        $this->status = Arr::get($params, 'status');
        $this->beforeBalance = Arr::get($params, 'before_balance');
        $this->afterBalance = Arr::get($params, 'after_balance');
        $this->amount = Arr::get($params, 'amount');
        $this->remark = Arr::get($params, 'remark');
        $this->request = Arr::get($params, 'request');
        $this->response = Arr::get($params, 'response');
    }
}