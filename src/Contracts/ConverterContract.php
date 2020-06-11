<?php

namespace SuperStation\Gamehub\Contracts;

interface ConverterContract
{
    /**
     * 從MongoDB 撈取原生注單
     *
     * @param string $fromTime
     * @param string $toTime
     * @return ConverterContract
     */
    public function getRawTicketsFromNoSQL(string $fromTime = '', string $toTime = ''): ConverterContract;

    /**
     * 注單轉換
     *
     * @param array $rawTickets (單一錢包 注單資訊使用回戳方式 就帶入這裡)
     * @return ConverterContract
     */
    public function convert(array $rawTickets = []): ConverterContract;

    /**
     * 存整合注單至MySQL
     *
     * @return ConverterContract
     */
    public function saveIntoDatabase(): ConverterContract;

    /**
     * 回傳遊戲整合注單結果
     *
     * @return array
     */
    public function report(): array;

    /**
     * 回傳注單的投注內容及開牌結果
     *
     * @param string $uuid
     * @return array
     */
    public function gameResult(string $uuid): array;
}