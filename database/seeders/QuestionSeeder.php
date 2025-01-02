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
                'question' => '彼は今、新薬の研究開発に<strong>挑んで</strong>いる。',
                'answer' => 'いどんで',
                'options' => 'はげんで,のぞんで,からんで,いどんで',
                'category_id' => $n1Category->id,
            ],
            [
                'question' => '住民が建設会社を相手に、<strong>訴訟</strong>を起こした。',
                'answer' => 'そしょう',
                'options' => 'そしょう,せきしょう,そこう,せっこう',
                'category_id' => $n1Category->id,
            ],
            [
                'question' => '私の主張は単なる<strong>〇〇</strong>ではなく、確たる証拠に基づいている',
                'answer' => '推測',
                'options' => '模索,思索,推測,推移',
                'category_id' => $n1Category->id,
            ],

            // JLPT N2 Questions
            [
                'question' => '事故の原因は、機械の<strong>〇〇</strong>作動にあると考えられている。',
                'answer' => '誤',
                'options' => '偽,誤,被,乱',
                'category_id' => $n2Category->id,
            ],
            [
                'question' => '___の言葉に意味が最も近いものを選びなさい。<br/><br/>このマニュアルの説明は<strong>ややこしい</strong>。',
                'answer' => '複雑だ',
                'options' => '明確だ,奇妙だ,複雑だ,簡潔だ',
                'category_id' => $n2Category->id,
            ],
            [
                'question' => '人を<strong>あざむいて</strong>、利益を得てはいけない。',
                'answer' => 'だまして',
                'options' => 'くるしませて,だまして,きずつけて,まよわせて',
                'category_id' => $n2Category->id,
            ],

            // JLPT N3 Questions
            [
                'question' => 'この辺りは視界を<strong>遮る</strong>物が何もない。',
                'answer' => 'さえぎる',
                'options' => 'さまたげる,さえぎる,せばめる,へだてる',
                'category_id' => $n3Category->id,
            ],
            [
                'question' => 'この説は科学的な<strong>根拠</strong>に乏しい。',
                'answer' => 'こんきょ',
                'options' => 'こんしょ,こんじょ,こんきょ,こんぎょ',
                'category_id' => $n3Category->id,
            ],
            [
                'question' => '何事も初めが<strong>肝心</strong>だ。',
                'answer' => 'かんじん',
                'options' => 'たんしん,かんしん,たんじん,かんじん',
                'category_id' => $n3Category->id,
            ],
        ];
        // Insert the questions into the database
        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}
