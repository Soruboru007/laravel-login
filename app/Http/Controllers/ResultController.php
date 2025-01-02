<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ResultController extends Controller
{
    public function getResults(string $category_id)
    {
        $user = Auth::user();

        $category = Category::find($category_id);

        if (! $category) {
            abort(404, 'Category not found');
        }

        $answerSessions = $category->getAnswerSessionsByUserIdAndCategoryId($user->id, $category_id);

        $results = [];

        foreach ($answerSessions as $answerSession) {
            $answers = Answer::where('answer_session_id', $answerSession->id)->get();

            Log::info($answers->all());

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
                'correct_answer_rate' => round(($totalCorrectAnswers / $totalAnswers) * 100, 0),
                'datetime' => $answerSession->created_at,
            ];
        }

        return view('home.results', compact('user', 'category', 'results'));
    }
}
