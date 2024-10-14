<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // まず、NULL値を持つpercentageを0に更新
        DB::table('post_comments')->whereNull('percentage')->update(['percentage' => 0]);

        Schema::table('post_comments', function (Blueprint $table) {
            // percentageを必須にし、commentをnullableに変更
            $table->integer('percentage')->nullable(false)->change();
            $table->text('comment')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_comments', function (Blueprint $table) {
            // 元の状態に戻すための処理
            $table->integer('percentage')->nullable()->change();
            $table->text('comment')->nullable(false)->change();
        });
    }
};
