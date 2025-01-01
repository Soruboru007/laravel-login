<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function showCreateQuestionForm()
    {

        $user = Auth::user();

        $categories = Category::all();

        return view('home.create-question', compact('user', 'categories'));
    }

    public function createQuestion(Request $request)
    {

        // Validate the incoming request
        $request->validate([
            'category_id' => 'required|exists:categories,id', // Ensure category exists
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
            'option_1' => 'required|string|max:255',
            'option_2' => 'required|string|max:255',
            'option_3' => 'nullable|string|max:255',  // Make this optional
            'option_4' => 'nullable|string|max:255',  // Make this optional
        ]);

        // Combine the options into an array
        $options = [
            $request->input('option_1'),
            $request->input('option_2'),
            $request->input('option_3'),
            $request->input('option_4'),
        ];

        // Filter out any empty options (if option_3 or option_4 are not provided)
        $options = array_filter($options, function ($value) {
            return ! empty($value);
        });

        // Create the new question
        $question = Question::create([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
            'options' => json_encode(array_values($options)),  // Store options as JSON
            'category_id' => $request->input('category_id'),
        ]);
        $question->save();

        return redirect()->route('create-question')->with('success', '問題を作成しました。');
    }

    public function getQuestions(string $category_id)
    {
        $user = Auth::user();
        // Retrieve the category by its ID
        $category = Category::find($category_id);
        // If category not found, return a 404 response
        if (! $category) {
            abort(404, 'Category not found');
        }

        // Retrieve all questions that belong to this category
        $questions = $category->questions; // This assumes you have the relationship defined in the Category model

        // Pass the category to the view
        return view('home.questions', compact('user', 'category', 'questions'));
    }
}
