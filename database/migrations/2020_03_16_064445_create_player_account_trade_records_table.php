<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerAccountTradeRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_account_trade_records', function (Blueprint $table) {
            // [PK] 資料識別碼
            $table->unsignedBigInteger('id')
                ->comment('[PK] 資料識別碼');

            // 玩家識別碼
            $table->string('player_username', 30)
                ->comment('玩家識別碼');

            // 交易序號
            $table->string('serial_no', 40)
                ->comment('交易序號');

            // 交易原因
            $table->enum('reason', ['deposit', 'withdraw', 'to_wallet', 'from_wallet', 'to_game', 'from_game'])
                ->comment('交易原因(deposit:儲值,withdraw:出金,to_wallet:轉到遊戲錢包,from_wallet:從遊戲錢包轉入,to_game:單錢包遊戲扣款,from_game:單錢包遊戲入款)');

            // 狀態
            $table->enum('status', ['pending', 'completed', 'fail'])
                ->comment('狀態(pending:未完成,completed:完成,fail:失敗)');

            // 交易前帳戶餘額
            $table->decimal('before_balance', 18, 4)
                ->comment('交易前帳戶餘額');

            // 交易後帳戶餘額
            $table->decimal('after_balance', 18, 4)
                ->nullable()
                ->comment('交易後帳戶餘額');

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

            // 請求參數
            $table->json('request')
                ->nullable()
                ->comment('請求參數');

            // 回應內容
            $table->json('response')
                ->nullable()
                ->comment('回應內容');

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
        Schema::dropIfExists('player_account_trade_records');
    }
}
