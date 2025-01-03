<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// AnswerSessionモデル: 回答セッションを管理する
class AnswerSession extends Model
{
    // 一括割り当て可能な属性を定義
    protected $fillable = [
        'user_id',       // セッションに紐づくユーザーのID
        'category_id',   // セッションに紐づくカテゴリのID
    ];

    // Answerモデルとのリレーション: このセッションに関連する回答を取得する
    public function answers()
    {
        return $this->hasMany(Answer::class); // 1つのセッションが複数の回答を持つ
    }

    // Categoryモデルとのリレーション: このセッションに関連するカテゴリを取得する
    public function category()
    {
        return $this->belongsTo(Category::class); // 1つのセッションが1つのカテゴリに属する
    }

    // 特定の回答セッションを取得するメソッド
    public function getByAnswerSessionId(string $user_id, string $answer_session_id)
    {
        return $this->where([
            'user_id' => $user_id,                       // ユーザーIDでフィルタ
            'answer_session_id' => $answer_session_id,   // セッションIDでフィルタ
        ])->first(); // 最初の一致するレコードを返す
    }
}
