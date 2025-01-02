<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    // 質問作成フォームを表示する
    public function showCreateQuestionForm()
    {
        $user = Auth::user(); // 現在ログインしているユーザーを取得
        $categories = Category::all(); // すべてのカテゴリを取得
        return view('home.create-question', compact('user', 'categories')); // ユーザー情報とカテゴリをビューに渡して表示
    }

    // 質問を作成する
    public function createQuestion(Request $request)
    {
        // リクエストデータをバリデーション
        $request->validate([
            'category_id' => 'required|exists:categories,id', // カテゴリが存在するかを検証
            'question' => 'required|string|max:255', // 質問内容は必須
            'answer' => 'required|string|max:255', // 回答は必須
            'option_1' => 'required|string|max:255', // オプション1は必須
            'option_2' => 'required|string|max:255', // オプション2は必須
            'option_3' => 'nullable|string|max:255', // オプション3は任意
            'option_4' => 'nullable|string|max:255', // オプション4は任意
        ]);

        // オプションを配列にまとめる
        $options = [
            $request->input('option_1'),
            $request->input('option_2'),
            $request->input('option_3'),
            $request->input('option_4'),
        ];

        // 空のオプションを除外する（オプション3や4が空の場合）
        $options = array_filter($options, function ($value) {
            return ! empty($value);
        });

        // 新しい質問を作成して保存
        $question = Question::create([
            'question' => $request->input('question'), // 質問内容
            'answer' => $request->input('answer'), // 正解
            'options' => json_encode(array_values($options)), // オプションをJSON形式で保存
            'category_id' => $request->input('category_id'), // 関連するカテゴリID
        ]);
        $question->save();

        // 成功メッセージとともに質問作成ページにリダイレクト
        return redirect()->route('create-question')->with('success', '問題を作成しました。');
    }

    // 質問を取得して表示する
    public function getQuestions(string $category_id)
    {
        $user = Auth::user(); // 現在ログインしているユーザーを取得

        // カテゴリIDに基づいてカテゴリを取得
        $category = Category::find($category_id);

        // カテゴリが存在しない場合、404エラーを返す
        if (! $category) {
            abort(404, 'カテゴリが見つかりません');
        }

        // カテゴリに属するすべての質問を取得し、加工する
        $questions = $category->questions->map(function ($question) {
            // JSON形式のオプションを配列に変換
            $question->options = explode(',', $question->options);

            return $question;
        });

        // すべての質問オプションをログに出力（デバッグ用）
        foreach ($questions as $question) {
            Log::info($question->options);
        }

        // ユーザー、カテゴリ、質問をビューに渡して表示
        return view('home.questions', compact('user', 'category', 'questions'));
    }
}
