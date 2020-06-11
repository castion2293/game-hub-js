<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStationWalletTradeRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('station_wallet_trade_records', function (Blueprint $table) {
            // [PK] 資料識別碼
            $table->unsignedBigInteger('id')
                ->comment('[PK] 資料識別碼');

            // 玩家識別碼
            $table->string('player_username', 30)
                ->comment('玩家識別碼');

            // 錢包帳號
            $table->char('account', 15)
                ->comment('錢包帳號');

            // 遊戲館
            $table->string('station', 30)
                ->comment('遊戲館');

            // 交易序號
            $table->string('serial_no', 40)
                ->comment('交易序號');

            // 交易原因
            $table->enum('reason', ['to_wallet', 'from_wallet', 'sync'])
                ->comment('交易原因(to_wallet:轉入遊戲錢包,from_wallet:轉出遊戲錢包,sync:同步)');

            // 狀態
            $table->enum('status', ['pending', 'completed', 'fail'])
                ->comment('狀態(pending:未完成,completed:完成,fail:失敗)');

            // 交易前錢包餘額
            $table->decimal('before_balance', 18, 4)
                ->comment('交易前錢包餘額');

            // 交易後錢包餘額
            $table->decimal('after_balance', 18, 4)
                ->nullable()
                ->comment('交易後錢包餘額');

            // 交易變動量
            $table->decimal('amount', 18, 4)
                ->comment('交易變動量');

            // 操作者識別碼
            $table->string('handler', 30)
                ->nullable()
                ->comment('操作者識別碼');

            // 備註
            $table->string('remark')
                ->nullable()
                ->comment('備註');

            // 第一次API動做的請求參數 (儲值，出金，同步)
            $table->json('normal_request')
                ->nullable()
                ->comment('第一次API動做的請求參數 (儲值，出金，同步)');

            // 第一次API動做的回應內容 (儲值，出金，同步)
            $table->json('normal_response')
                ->nullable()
                ->comment('第一次API動做的回應內容 (儲值，出金，同步)');

            // 第二次檢查流水號的API請求參數 (儲值，出金)
            $table->json('transfer_check_request')
                ->nullable()
                ->comment('第二次檢查流水號的API請求參數 (儲值，出金)');

            // 第二次檢查流水號的API回應內容 (儲值，出金)
            $table->json('transfer_check_response')
                ->nullable()
                ->comment('第二次檢查流水號的API回應內容 (儲值，出金)');

            // 錯誤失敗原因
            $table->json('fail_reason')
                ->nullable()
                ->comment('錯誤失敗原因');

            // 營運佔代碼
            $table->char('site_code', 10)
                ->comment('營運佔代碼');

            // 建立時間
            $table->datetime('created_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'))
                ->comment('建立時間');

            // 最後更新
            $table->datetime('updated_at')
                ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))
                ->comment('最後更新');

            // === 索引 ===
            // 指定主鍵索引
            $table->primary(['id']);

            $table->index('serial_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('station_wallet_trade_records');
    }
}
