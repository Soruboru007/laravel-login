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

        if (! $category_id) {
            return response()->json(['error' => 'Category ID is required'], 400);
        }

        // Create a new answer session
        $session = AnswerSession::create([
            'user_id' => $user->id,
            'category_id' => $category_id,
            'session_id' => uniqid('session_', true), // Generate a unique session identifier
        ]);
        $session->save();

        $formAnswers = $request->all();

        // Remove category_id from the queryParams so only answers remain
        unset($formAnswers['category_id']);
        unset($formAnswers['_token']);

        // Process each question/answer pair in the query string
        foreach ($formAnswers as $questionId => $answerValue) {
            // Validate the question exists
            $question = Question::find($questionId);
            if (! $question) {
                continue; // Skip invalid question IDs
            }

            // Check if the answer is correct
            $isCorrect = $question->answer === $answerValue;

            // Save the answer
            $answer = Answer::create([
                'question_id' => $questionId,
                'answer_session_id' => $session->id,
                'answer' => $answerValue,
                'is_correct' => $isCorrect,
            ]);
            $answer->save();
        }

        return redirect()->route('get-results', ['category_id' => $category_id]);
    }
}
