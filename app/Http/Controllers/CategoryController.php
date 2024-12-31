<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
