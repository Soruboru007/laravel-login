<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // JLPT N1 Category
        $n1Category = Category::where('category_name', 'N1')->first();
        if (! $n1Category) {
            $n1Category = Category::create([
                'category_name' => 'JLPT N1',
            ]);
        }

        // JLPT N2 Category
        $n2Category = Category::where('category_name', 'N2')->first();
        if (! $n2Category) {
            $n2Category = Category::create([
                'category_name' => 'JLPT N2',
            ]);
        }

        // JLPT N3 Category
        $n3Category = Category::where('category_name', 'N3')->first();
        if (! $n3Category) {
            $n3Category = Category::create([
                'category_name' => 'JLPT N3',
            ]);
        }

        // Sample questions for N1, N2, and N3
        $questions = [
            // JLPT N1 Questions
            [
                'question' => '日本語を学ぶ目的は何ですか。',
                'answer' => '日本語を学ぶことで仕事が有利になるから。',
                'options' => json_encode([
                    '日本の文化に興味があるから。',
                    '日本語を学ぶことで仕事が有利になるから。',
                    '日本語を話せると世界中の人とコミュニケーションが取れるから。',
                    '日本語を学ぶこと自体が楽しいから。',
                ]),
                'category_id' => $n1Category->id,
            ],
            [
                'question' => '次の漢字の読み方として正しいものはどれですか。',
                'answer' => 'としょかん',
                'options' => json_encode([
                    'としょかん',
                    'としょがん',
                    'ずしょかん',
                    'ずしょがん',
                ]),
                'category_id' => $n1Category->id,
            ],
            [
                'question' => '以下の文章の中で、誤っている部分はどれですか。',
                'answer' => '私は学生ではありませんでした。',
                'options' => json_encode([
                    '私は学生でした。',
                    '私は学生ではありませんでした。',
                    '私は学生です。',
                    '私は学生ではありません。',
                ]),
                'category_id' => $n1Category->id,
            ],

            // JLPT N2 Questions
            [
                'question' => '以下の文を読み、正しい意味を選んでください。',
                'answer' => '彼は遊びに行くことができない。',
                'options' => json_encode([
                    '彼は遊びに行きたくない。',
                    '彼は遊びに行くことができない。',
                    '彼は遊びに行くのが好きだ。',
                    '彼は遊びに行くのが苦手だ。',
                ]),
                'category_id' => $n2Category->id,
            ],
            [
                'question' => '次の語彙の意味として正しいものはどれですか。',
                'answer' => '確実に',
                'options' => json_encode([
                    '必要',
                    '特に',
                    '確実に',
                    '一部',
                ]),
                'category_id' => $n2Category->id,
            ],
            [
                'question' => '次の漢字の読み方として正しいものはどれですか。',
                'answer' => 'いそぐ',
                'options' => json_encode([
                    'いそぐ',
                    'きゅうぐ',
                    'きそぐ',
                    'あせぐ',
                ]),
                'category_id' => $n2Category->id,
            ],

            // JLPT N3 Questions
            [
                'question' => '次の文を読んで、空欄に入る言葉を選んでください。',
                'answer' => '寒い',
                'options' => json_encode([
                    '暑い',
                    '寒い',
                    '忙しい',
                    '早い',
                ]),
                'category_id' => $n3Category->id,
            ],
            [
                'question' => '次の文の意味として最も適切なものを選んでください。',
                'answer' => '私は犬が好きです。',
                'options' => json_encode([
                    '私は犬を嫌いです。',
                    '私は犬が好きです。',
                    '犬を飼っています。',
                    '犬を買いたいです。',
                ]),
                'category_id' => $n3Category->id,
            ],
            [
                'question' => '以下の語彙の意味として正しいものはどれですか。',
                'answer' => '嬉しい',
                'options' => json_encode([
                    '悲しい',
                    '楽しい',
                    '嬉しい',
                    '面白い',
                ]),
                'category_id' => $n3Category->id,
            ],
        ];

        // Insert the questions into the database
        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}
