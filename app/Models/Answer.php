<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Answerモデル: 回答に関するデータを管理する
class Answer extends Model
{
    // 一括割り当て可能な属性を定義
    protected $fillable = [
        'question_id',        // 回答が紐づいている質問のID
        'answer_session_id',  // 回答が紐づいているセッションのID
        'answer',             // ユーザーが選択または入力した回答
        'is_correct',         // 回答が正解かどうかのフラグ（boolean）
    ];
}
