<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStationWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('station_wallets', function (Blueprint $table) {
            // [PK] 資料識別碼
            $table->unsignedBigInteger('id')
                ->comment('[PK] 資料識別碼');

            // 玩家識別碼
            $table->string('player_username', 30)
                ->comment('玩家識別碼');

            // 錢包帳號
            $table->char('account', 15)
                ->comment('錢包帳號');

            // 錢包密碼
            $table->char('password', 15)
                ->comment('錢包密碼');

            // 遊戲館
            $table->string('station', 30)
                ->comment('遊戲館');

            // 狀態
            $table->enum('status', ['active', 'freezing'])
                ->comment('狀態');

            // 是否開通
            $table->boolean('is_activated')
                ->comment('是否開通');

            // 餘額
            $table->decimal('balance', 18, 4)->default(0)
                ->comment('餘額');

            // 最後同步時間
            $table->dateTime('last_sync_at')
                ->nullable()
                ->comment('最後同步時間');

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

            $table->unique(['account', 'station'], 'account_station_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('station_wallets');
    }
}
