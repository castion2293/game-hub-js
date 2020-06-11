<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_accounts', function (Blueprint $table) {
            // [PK] 資料識別碼
            $table->unsignedBigInteger('id')
                ->comment('[PK] 資料識別碼');

            // 玩家識別碼
            $table->string('player_username', 30)
                ->comment('玩家識別碼');

            // 玩家錢包帳戶帳號
            $table->char('account', 15)
                ->comment('玩家錢包帳戶帳號');

            // 玩家錢包帳戶密碼
            $table->char('password', 15)
                ->comment('玩家錢包帳戶密碼');

            // 狀態
            $table->enum('status', ['active', 'freezing'])
                ->comment('狀態');

            // 餘額
            $table->decimal('balance', 18, 4)->default(0)
                ->comment('餘額');

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

            $table->index('account');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_accounts');
    }
}
