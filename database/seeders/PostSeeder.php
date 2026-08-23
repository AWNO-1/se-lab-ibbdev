<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Post;
use App\Models\ReputationLog;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostSeeder extends Seeder
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
                'avatar_path' => null,
                'reputation_points' => 0,
                'email_verified_at' => now(),
            ]
        );

        // Create 3 other fake users if not enough users
        if (User::count() < 4) {
            User::factory()->count(3)->create();
        }

        $allUsers = User::all();

        // Avoid duplicate seeding: if posts already exist, skip
        if (Post::count() > 0) {
            return;
        }

        // Arabic posts examples for saher
        $arabicPosts = [
            ['title' => 'كيف أحل مشكلة NullPointerException في Java؟', 'body' => 'أواجه خطأ NullPointerException عند محاولة الوصول إلى كائن لم يتم تهيئته. ما هي أفضل الممارسات لتجنب هذا الخطأ؟'],
            ['title' => 'ما الفرق بين let و const في JavaScript؟', 'body' => 'أريد فهم الفرق الدقيق بين let و const في ES6، ومتى يجب استخدام كل منهما في المشاريع الحقيقية.'],
            ['title' => 'كيف أستخدم Eloquent Relationships في Laravel؟', 'body' => 'أحاول فهم علاقات hasMany و belongsTo في Laravel. هل يمكن شرحها بمثال عملي من مشروع IBBDev؟'],
            ['title' => 'ما هو مبدأ SOLID وكيف أطبقه؟', 'body' => 'سمعت كثيراً عن مبادئ SOLID في هندسة البرمجيات، لكن لا أفهم كيف أطبقها بشكل عملي في كود PHP.'],
            ['title' => 'كيف أحسن أداء استعلامات قاعدة البيانات؟', 'body' => 'لدي استعلامات بطيئة في Laravel عند جلب الأسئلة مع إجاباتها. كيف أستخدم Eager Loading بشكل صحيح؟'],
        ];

        foreach ($arabicPosts as $q) {
            Post::create([
                'user_id' => $saherUser->id,
                'title' => $q['title'],
                'body' => $q['body'],
                'image_path' => null,
                'is_solved' => false,
            ]);
        }

        // Create additional posts using fake users (4 posts)
        Post::factory(4)->create();

        // Create answers for each post
        $posts = Post::all();
        foreach ($posts as $post) {
            $answerCount = random_int(2, 3);
            for ($i = 0; $i < $answerCount; $i++) {
                $answerer = $allUsers->where('id', '!=', $post->user_id)->random();
                $isAccepted = (bool) random_int(0, 1);
                // Ensure only one accepted per post max
                if ($isAccepted && $post->answers()->where('is_accepted', true)->exists()) {
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
                    'post_id' => $post->id,
                    'user_id' => $answerer->id,
                    'body' => $arabicAnswers[array_rand($arabicAnswers)],
                    'is_accepted' => $isAccepted,
                ]);

                if ($isAccepted) {
                    $answerer->increment('reputation_points', 10);
                    // Also log reputation
                    ReputationLog::create([
                        'user_id' => $answerer->id,
                        'points' => 10,
                        'reason' => 'تم اعتماد إجابته كحل لسؤال: '.$post->title,
                    ]);
                    // Mark post as solved if accepted
                    if ($isAccepted) {
                        $post->update(['is_solved' => true]);
                    }
                }
            }
        }
    }
}
