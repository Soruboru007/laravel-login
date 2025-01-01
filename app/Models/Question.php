<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    // Define the attributes that are mass assignable
    protected $fillable = ['category_id', 'question', 'answer', 'options'];

    // Cast 'options' to an array (for easy handling of the JSON field)
    protected $casts = [
        'options' => 'array', // Automatically converts the JSON field to an array
    ];

    /**
     * Define the relationship with the Category model.
     */
    public function category()
    {
        return $this->belongsTo(Category::class); // A question belongs to one category
    }
}
