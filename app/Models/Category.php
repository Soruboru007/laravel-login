<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Category extends Model
{
    protected $fillable = [
        'category_name',
    ];
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answerSessions()
    {
        return $this->hasMany(AnswerSession::class);
    }

    public function getAnswerSessionsByUserIdAndCategoryId(string $user_id, string $category_id)
    {
        return $this
            ->answerSessions()
            ->where(['user_id' => $user_id, 'category_id' => $category_id])
            ->orderBy('created_at')
            ->get();
    }
}
