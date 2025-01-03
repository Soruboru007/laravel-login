<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Questionモデル: 質問データを管理する
class Question extends Model
{
    // 一括割り当て可能な属性を定義
    protected $fillable = ['category_id', 'question', 'answer', 'options'];
    // このモデルで一括割り当て可能な属性（データベースのカラム）を指定します。

    // 'options' 属性を配列としてキャストする
    protected $casts = [
        'options' => 'array', // JSON形式のフィールドを自動的に配列に変換
    ];

    /**
     * Categoryモデルとのリレーションを定義
     * この質問がどのカテゴリに属するかを表します。
     */
    public function category()
    {
        return $this->belongsTo(Category::class); // 質問は1つのカテゴリに属します
    }

    /**
     * Answerモデルとのリレーションを定義
     * この質問に関連する回答を取得します。
     */
    public function answers()
    {
        return $this->hasMany(Answer::class); // 質問には複数の回答が関連付けられます
    }
}
