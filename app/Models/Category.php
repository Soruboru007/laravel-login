<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Categoryモデル: カテゴリデータを管理する
class Category extends Model
{
    // 一括割り当て可能な属性を定義
    protected $fillable = [
        'category_name', // カテゴリ名
    ];

    // Questionモデルとのリレーション: このカテゴリに属する質問を取得する
    public function questions()
    {
        return $this->hasMany(Question::class); // 1つのカテゴリに複数の質問が紐づく
    }

    // AnswerSessionモデルとのリレーション: このカテゴリに属する回答セッションを取得する
    public function answerSessions()
    {
        return $this->hasMany(AnswerSession::class); // 1つのカテゴリに複数の回答セッションが紐づく
    }

    // ユーザーIDとカテゴリIDで回答セッションを取得するカスタムメソッド
    public function getAnswerSessionsByUserIdAndCategoryId(string $user_id, string $category_id)
    {
        return $this
            ->answerSessions() // このカテゴリに関連する回答セッションを取得
            ->where([
                'user_id' => $user_id,       // ユーザーIDでフィルタ
                'category_id' => $category_id, // カテゴリIDでフィルタ
            ])
            ->orderBy('created_at') // 作成日時で並び替え
            ->get(); // 結果をコレクションで返す
    }
}
