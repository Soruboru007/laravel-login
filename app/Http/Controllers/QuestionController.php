<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    public function showCreateQuestionForm()
    {
        $user = Auth::user();

        $categories = Category::all();

        return view('home.create-question',compact('user','categories'));
    }

    public function createQuestion(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);

        try {
            $question = Question::create([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'category_id' => $validated['category_id'],
                'user_id' => Auth::id()
            ]);

            return redirect()->route('home')->with('success', '質問が投稿されました');
        } catch (\Exception $e) {
            Log::error('質問の作成に失敗しました: ' . $e->getMessage());
            return back()->with('error', '質問の投稿に失敗しました');
        }
    }

    public function getQuestions(string $category_id)
    {
        $user = Auth::user();

        // Retrieve the category by its ID
        $category = Category::find($category_id);

        if (!$category) {
            abort(404, 'Category not found');
        }

        // Retrieve all questions that belong to this category
        $questions = $category->questions; // This assumes you have the relationship defined in the Category model

        // Pass the category to the view
        return view('home.questions', compact('user', 'category', 'questions'));
    }
}
