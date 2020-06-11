<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitedTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('united_tickets');

        Schema::create('united_tickets', function (Blueprint $table) {
            // [PK] 資料識別碼
            $table->uuid('id')
                ->comment('資料識別碼');

            // 原生注單編號
            $table->string('bet_number')
                ->comment('[UK]原生注單編號');

            // 玩家識別碼
            $table->string('player_username', 30)
                ->comment('玩家識別碼');

            // 玩家錢包帳戶帳號
            $table->char('account', 15)
                ->comment('玩家錢包帳戶帳號');

            // 遊戲館名稱
            $table->string('station', 30)
                ->comment('遊戲館名稱');

            // 遊戲名稱
            $table->string('game_scope', 30)
                ->comment('類型');

            // 實際投注
            $table->decimal('raw_bet', 18, 4)
                ->comment('實際投注');

            // 有效投注
            $table->decimal('valid_bet', 18, 4)
                ->comment('有效投注');

            // 洗碼量
            $table->decimal('rolling', 18, 4)
                ->comment('洗碼量');

            // 輸贏結果
            $table->decimal('winnings', 18, 4)
                ->comment('輸贏結果');

            // 會員退水
            $table->decimal('rebate', 18, 4)->default(0)
                ->comment('會員退水');

            // 是否無效
            $table->boolean('is_invalid')->default(false)
                ->comment('是否無效 true:無效，false:正常');

            // 投注時間
            $table->datetime('bet_at')
                ->comment('投注時間');

            // 結算狀態
            $table->boolean('is_payout')
                ->comment('結算狀態 true:已結算，false:未結算');

            // 派彩時間
            $table->datetime('payout_at')->nullable()->default(null)
                ->comment('結算時間');

            // 祖先節點樹
            $table->string('tree_path')
                ->comment('祖先節點樹');

            // 輸贏佔成
            $table->string('allotment_path')
                ->comment('輸贏佔成');

            // 營運站代碼
            $table->char('site_code', 5)
                ->comment('營運站代碼');

            // 建立時間
            $table->datetime('created_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'))
                ->comment('建立時間');

            // 最後更新
            $table->datetime('updated_at')
                ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))
                ->comment('最後更新');

            // === 索引 ===
            // 指定主鍵
            $table->primary(['id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('united_tickets');
    }
}
