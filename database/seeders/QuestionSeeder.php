<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the specific user saherqaid if not exists
        $saherUser = User::firstOrCreate(
            ['email' => 'saherqaid2020@gmail.com'],
            [
                'name' => 'saherqaid',
                'username' => 'saherqaid',
                'password' => Hash::make('password123'),
                'avatar' => null,
                'reputation_points' => 0,
                'email_verified_at' => now(),
            ]
        );

        // Create 3 other fake users if not enough users
        if (User::count() < 4) {
            User::factory()->count(3)->create();
        }

        $allUsers = User::all();
        $fakeUsers = $allUsers->where('id', '!=', $saherUser->id)->values();

        // Avoid duplicate seeding: if questions already exist, skip
        if (Question::count() > 0) {
            return;
        }

        // Arabic questions examples for saher
        $arabicQuestions = [
            ['title' => 'كيف أحل مشكلة NullPointerException في Java؟', 'body' => 'أواجه خطأ NullPointerException عند محاولة الوصول إلى كائن لم يتم تهيئته. ما هي أفضل الممارسات لتجنب هذا الخطأ؟'],
            ['title' => 'ما الفرق بين let و const في JavaScript؟', 'body' => 'أريد فهم الفرق الدقيق بين let و const في ES6، ومتى يجب استخدام كل منهما في المشاريع الحقيقية.'],
            ['title' => 'كيف أستخدم Eloquent Relationships في Laravel؟', 'body' => 'أحاول فهم علاقات hasMany و belongsTo في Laravel. هل يمكن شرحها بمثال عملي من مشروع IBBDev؟'],
            ['title' => 'ما هو مبدأ SOLID وكيف أطبقه؟', 'body' => 'سمعت كثيراً عن مبادئ SOLID في هندسة البرمجيات، لكن لا أفهم كيف أطبقها بشكل عملي في كود PHP.'],
            ['title' => 'كيف أحسن أداء استعلامات قاعدة البيانات؟', 'body' => 'لدي استعلامات بطيئة في Laravel عند جلب الأسئلة مع إجاباتها. كيف أستخدم Eager Loading بشكل صحيح؟'],
        ];

        foreach ($arabicQuestions as $q) {
            Question::create([
                'user_id' => $saherUser->id,
                'title' => $q['title'],
                'body' => $q['body'],
                'image' => null,
            ]);
        }

        // Create additional questions using fake users (4 questions)
        Question::factory(4)->create();

        // Create answers for each question
        $questions = Question::all();
        foreach ($questions as $question) {
            $answerCount = random_int(2, 3);
            for ($i = 0; $i < $answerCount; $i++) {
                $answerer = $allUsers->where('id', '!=', $question->user_id)->random();
                $isAccepted = (bool) random_int(0, 1);
                // Ensure only one accepted per question max
                if ($isAccepted && $question->answers()->where('is_accepted', true)->exists()) {
                    $isAccepted = false;
                }

                $arabicAnswers = [
                    'هذا شرح ممتاز، يمكنك حل المشكلة باستخدام التحقق من null قبل الاستخدام.',
                    'أنصحك بقراءة التوثيق الرسمي وتطبيق المثال العملي المرفق.',
                    'جرب استخدام optional() في Laravel لتجنب الأخطاء.',
                    'المشكلة تكمن في تهيئة الكائن، تأكد من استخدام new بشكل صحيح.',
                    'يمكنك استخدام try-catch للتعامل مع الاستثناءات بشكل أفضل.',
                ];

                $answer = Answer::create([
                    'question_id' => $question->id,
                    'user_id' => $answerer->id,
                    'body' => $arabicAnswers[array_rand($arabicAnswers)],
                    'is_accepted' => $isAccepted,
                ]);

                if ($isAccepted) {
                    $answerer->increment('reputation_points', 10);
                }
            }
        }
    }
}
