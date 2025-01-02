<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ResultController extends Controller
{
    // 指定されたカテゴリの結果を取得する
    public function getResults(string $category_id)
    {
        $user = Auth::user(); // 現在認証されているユーザーを取得

        // カテゴリIDに基づいてカテゴリを取得
        $category = Category::find($category_id);

        // カテゴリが見つからない場合、404エラーを返す
        if (! $category) {
            abort(404, 'カテゴリが見つかりません');
        }

        // 現在のユーザーとカテゴリIDに基づいて回答セッションを取得
        $answerSessions = $category->getAnswerSessionsByUserIdAndCategoryId($user->id, $category_id);

        $results = []; // 結果を格納する配列

        // 各回答セッションごとに結果を処理
        foreach ($answerSessions as $answerSession) {
            // 回答セッションに紐づく回答をすべて取得
            $answers = Answer::where('answer_session_id', $answerSession->id)->get();

            // デバッグ用に回答をログに出力
            Log::info($answers->all());

            $totalAnswers = 0; // 総回答数
            $totalCorrectAnswers = 0; // 正解数
            foreach ($answers as $answer) {
                if ($answer->is_correct) { // 回答が正解の場合、正解数を増やす
                    $totalCorrectAnswers++;
                }
                $totalAnswers++; // 回答数をカウント
            }

            // 結果データを配列に追加
            $results[] = [
                'category_name' => $answerSession->category->category_name, // カテゴリ名
                'total_answers' => $totalAnswers, // 総回答数
                'total_correct_answers' => $totalCorrectAnswers, // 正解数
                'correct_answer_rate' => round(($totalCorrectAnswers / $totalAnswers) * 100, 0), // 正解率（パーセントで丸める）
                'datetime' => $answerSession->created_at, // 回答セッションの作成日時
            ];
        }

        // ユーザー情報、カテゴリ情報、結果データをビューに渡して表示
        return view('home.results', compact('user', 'category', 'results'));
    }
}
