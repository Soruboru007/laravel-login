<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * マイグレーションを実行します。
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id(); // 主キーとしてのIDカラムを作成
            $table->foreignId('category_id')
                ->constrained() // 'categories'テーブルの'id'カラムを自動的に参照する外部キーを設定
                ->onDelete('cascade'); // 関連するカテゴリが削除された場合、それに関連する質問も削除されるように設定
            $table->string('question'); // 質問内容を格納する文字列カラム
            $table->string('answer'); // 回答を格納する文字列カラム
            $table->json('options'); // 選択肢を格納するJSON形式のカラム
            $table->timestamps(); // 作成日時(created_at)と更新日時(updated_at)を格納するタイムスタンプカラム
        });
    }

    /**
     * マイグレーションをロールバックします。
     */
    public function down(): void
    {
        Schema::dropIfExists('questions'); // 'questions'テーブルを削除
    }
};
