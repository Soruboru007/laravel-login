<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\AnswerSession;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function saveAnswers(Request $request, string $category_id)
    {
        $user = Auth::user();

        // カテゴリIDが渡されていない場合、エラーを返す
        if (! $category_id) {
            return response()->json(['error' => 'Category ID is required'], 400);
        }

        // 新しい回答セッションを作成する
        $session = AnswerSession::create([
            'user_id' => $user->id, // 現在ログインしているユーザーのIDを関連付ける
            'category_id' => $category_id, // 対応するカテゴリIDを関連付ける
            'session_id' => uniqid('session_', true), // 一意のセッション識別子を生成する
        ]);
        $session->save();

        // リクエストからすべてのデータを取得
        $formAnswers = $request->all();

        // カテゴリIDとトークンを除去し、回答データのみを残す
        unset($formAnswers['category_id']);
        unset($formAnswers['_token']);

        // クエリ文字列内の各質問と回答のペアを処理する
        foreach ($formAnswers as $questionId => $answerValue) {
            // 質問が存在するかを検証する
            $question = Question::find($questionId);
            if (! $question) {
                continue; // 無効な質問IDをスキップする
            }

            // 回答が正しいかどうかをチェックする
            $isCorrect = $question->answer === $answerValue;

            // 回答を保存する
            $answer = Answer::create([
                'question_id' => $questionId, // 回答が属する質問ID
                'answer_session_id' => $session->id, // 回答セッションIDを関連付ける
                'answer' => $answerValue, // ユーザーが入力した回答
                'is_correct' => $isCorrect, // 正解かどうかのフラグ
            ]);
            $answer->save();
        }

        // 結果表示ページへリダイレクト
        return redirect()->route('get-results', ['category_id' => $category_id]);
    }
}
