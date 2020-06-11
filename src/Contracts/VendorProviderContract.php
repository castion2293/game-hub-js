<?php

namespace SuperStation\Gamehub\Contracts;

/**
 * 遊戲服務器介面
 *
 * Interface VendorProviderContract
 * @package SuperStation\Gamehub\Contracts
 */
interface VendorProviderContract
{
    /**
     * 取得遊戲服務器的代碼
     *
     * @return string (格式必需為蛇型全小寫)
     */
    public function getVendorCode(): string;

    /**
     * 取得支援的「驅動器」類別名稱
     *
     * @return string
     */
    public function getVendorDriver(): string;

    /**
     * 取得支援的「抓取器」類別名稱
     *
     * @return string
     */
    public function getVendorFetcher(): string;

    /**
     * 取得支援的「轉換器」類別名稱
     *
     * @return string
     */
    public function getVendorConverter(): string;

    /**
     * 取得支援的「路由注冊器」類別名稱
     *
     * @return string
     */
    public function getVendorRouter(): string;

    /**
     * 取得支援的「接受器」類別名稱
     *
     * @return string
     */
    public function getVendorReceiver(): string;
}