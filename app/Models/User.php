<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Userモデル: ユーザーアカウントの情報を管理する
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * 一括割り当て可能な属性を定義
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username', // ユーザー名
        'email',    // メールアドレス
        'password', // パスワード
    ];

    /**
     * シリアル化時に隠す属性の定義
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',       // パスワードは外部に公開しない
        'remember_token', // ログイン状態を記憶するトークンも隠す
    ];

    /**
     * キャストすべき属性の定義
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // 日時型にキャスト
            'password' => 'hashed',           // パスワードをハッシュ化して保存
        ];
    }
}
