<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\AnswerSession;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    // カテゴリ作成フォームを表示する
    public function showCreateCategoryForm()
    {
        $user = Auth::user(); // 現在認証されているユーザーを取得
        return view('home.create-category', compact('user')); // ユーザー情報をビューに渡す
    }

    // 新しいカテゴリを作成する
    public function createCategory(Request $request)
    {
        // リクエストデータをバリデーション
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories', // カテゴリ名はユニークかつ必須
        ]);

        // 新しいカテゴリを作成し保存
        $category = Category::create(['category_name' => $request->input('category_name')]);
        $category->save();

        // 成功メッセージを添えてカテゴリ作成ページにリダイレクト
        return redirect()->route('create-category')->with('success', 'カテゴリを作成しました。');
    }

    // ユーザーの回答を保存する
    public function saveAnswers(Request $request)
    {
        // クエリ文字列の全パラメータを取得
        $queryParams = $request->query();

        // クエリ文字列からカテゴリIDを取得（存在しない場合はnull）
        $categoryId = $queryParams['category_id'] ?? null;

        // カテゴリIDが存在しない場合、エラーメッセージを返す
        if (! $categoryId) {
            return response()->json(['error' => 'Category ID is required'], 400);
        }

        // 新しい回答セッションを作成
        $session = AnswerSession::create([
            'category_id' => $categoryId, // 対応するカテゴリIDを関連付け
            'session_id' => uniqid('session_', true), // 一意のセッション識別子を生成
        ]);
        $session->save();

        // クエリ文字列からカテゴリIDを削除し、回答データのみを残す
        unset($queryParams['category_id']);

        // クエリ文字列内の各質問と回答を処理する
        foreach ($queryParams as $questionId => $answerValue) {
            // 質問が存在するかを検証
            $question = Question::find($questionId);
            if (! $question) {
                continue; // 無効な質問IDはスキップ
            }

            // 回答が正しいかどうかを判定
            $isCorrect = $question->answer === $answerValue;

            // 回答を保存
            Answer::create([
                'question_id' => $questionId, // 質問ID
                'answer' => $answerValue, // ユーザーが入力した回答
                'is_correct' => $isCorrect, // 正解かどうかのフラグ
            ]);
        }

        // 結果表示ページへリダイレクト
        return redirect()->route('get-results', ['category_id' => $categoryId]);
    }

    // カテゴリごとの結果を取得する
    public function getResults(string $category_id)
    {
        $user = Auth::user(); // 現在認証されているユーザーを取得

        // カテゴリIDに基づいてカテゴリを取得
        $category = Category::find($category_id);

        // カテゴリが存在しない場合、404エラーを返す
        if (! $category) {
            abort(404, 'カテゴリが見つかりません');
        }

        // 現在のユーザーとカテゴリに紐づく回答セッションを取得
        $answerSessions = $category->getAnswerSessionsByUserIdAndCategoryId();

        $results = []; // 結果を格納する配列

        // 各回答セッションの結果を処理
        foreach ($answerSessions as $answerSession) {
            $answers = Answer::where('answer_session_id', $answerSession->id); // セッションに紐づく回答を取得

            $totalAnswers = 0; // 総回答数
            $totalCorrectAnswers = 0; // 正解数
            foreach ($answers as $answer) {
                if ($answer->is_correct) {
                    $totalCorrectAnswers++; // 正解数をカウント
                }
                $totalAnswers++; // 総回答数をカウント
            }

            // 結果データを配列に追加
            $results[] = [
                'category_name' => $answerSession->category->category_name, // カテゴリ名
                'total_answers' => $totalAnswers, // 総回答数
                'total_correct_answers' => $totalCorrectAnswers, // 正解数
                'correct_answer_rate' => ($totalCorrectAnswers / $totalAnswers) * 100, // 正解率
                'datetime' => $answerSession->created_at, // セッション作成日時
            ];
        }

        // 結果をビューに渡して表示
        return view('home.results', compact('user', 'category', 'results'));
    }
}
