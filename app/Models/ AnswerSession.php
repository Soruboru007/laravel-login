<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnswerSession extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getByAnswerSessionId(string $user_id, string $answer_session_id)
    {
        return $this->where(['user_id' => $user_id, 'answer_session_id' => $answer_session_id])->first();
    }
}
