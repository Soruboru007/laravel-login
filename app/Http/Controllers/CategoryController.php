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
    public function showCreateCategoryForm()
    {
        $user = Auth::user();
        return view('home.create-category', compact('user'));
    }
    public function createCategory(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories', // Ensure the category name is unique
        ]);
        $category = Category::create(['category_name' => $request->input('category_name')]);
        $category->save();
        // Redirect to a success page or back with a success message
        return redirect()->route('create-category')->with('success', 'カテゴリを作成しました。');
    }

    public function saveAnswers(Request $request)
    {
        // Get all query string parameters
        $queryParams = $request->query();

        // Assume the category_id is passed in the query string
        $categoryId = $queryParams['category_id'] ?? null;

        if (! $categoryId) {
            return response()->json(['error' => 'Category ID is required'], 400);
        }

        // Create a new answer session
        $session = AnswerSession::create([
            'category_id' => $categoryId,
            'session_id' => uniqid('session_', true), // Generate a unique session identifier
        ]);
        $session->save();

        // Remove category_id from the queryParams so only answers remain
        unset($queryParams['category_id']);

        // Process each question/answer pair in the query string
        foreach ($queryParams as $questionId => $answerValue) {
            // Validate the question exists
            $question = Question::find($questionId);
            if (! $question) {
                continue; // Skip invalid question IDs
            }

            // Check if the answer is correct
            $isCorrect = $question->answer === $answerValue;

            // Save the answer
            Answer::create([
                'question_id' => $questionId,
                'answer' => $answerValue,
                'is_correct' => $isCorrect,
            ]);
        }

        return redirect()->route('get-results', ['category_id' => $categoryId]);
    }

    public function getResults(string $category_id)
    {

        $user = Auth::user();

        $category = Category::find($category_id);

        if (! $category) {
            abort(404, 'Category not found');
        }

        $answerSessions = $category->getAnswerSessionsByUserIdAndCategoryId();

        $results = [];

        foreach ($answerSessions as $answerSession) {
            $answers = Answer::where('answer_session_id', $answerSession->id);

            $totalAnswers = 0;
            $totalCorrectAnswers = 0;
            $percentageCorrectAnswers = 0;
            foreach ($answers as $answer) {
                if ($answer->is_correct) {
                    $totalCorrectAnswers++;
                }
                $totalAnswers++;
            }

            $results[] = [
                'category_name' => $answerSession->category->category_name,
                'total_answers' => $totalAnswers,
                'total_correct_answers' => $totalCorrectAnswers,
                'correct_answer_rate' => ($totalCorrectAnswers / $totalAnswers) * 100,
                'datetime' => $answerSession->created_at,
            ];
        }

        return view('home.results', compact('user', 'category', 'results'));
    }
}
