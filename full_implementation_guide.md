# المعمل الخامس: دليل التنفيذ الكامل — منصة IBBDev

> مادة: هندسة البرمجيات | Laravel 13 (Blade)
> هذا الملف كافٍ بذاته: اقرأه من الأول للآخر ونفّذ كل جزء بنفسك على جهازك.

---

## 1. المشكلة (نص المعمل)

فريق من طلاب علوم الحاسوب يحتاج مكاناً واحداً لتبادل الخبرات البرمجية بدلاً من تشتّت الأسئلة بين مجموعات التواصل الاجتماعي. المطلوب منك بناء **IBBDev**: منصة ويب يستطيع فيها الطالب:

1. إنشاء حساب بصورة شخصية واسم مستخدم فريد.
2. طرح سؤال برمجي مع إرفاق صورة توضح الخطأ (اختياري).
3. الإجابة على أسئلة زملائه.
4. اعتماد إجابة كحل صحيح، فيحصل صاحبها تلقائياً على **10 نقاط سمعة (Reputation)**.

مهمتك: تصميم قاعدة البيانات، وبناء التطبيق بمعمارية نظيفة (MVC + Service Layer) تطبّق كل ما درسته في المعامل 1–4.

---

## 2. الأهداف التعليمية لهذا المعمل

بنهاية المعمل يجب أن تكون قادراً على:

- ترجمة مشكلة واقعية إلى قصص مستخدم ومعايير قبول.
- تصميم قاعدة بيانات علائقية بعلاقات One-to-Many.
- بناء تطبيق Laravel كامل بواجهات Blade (وليس API).
- فصل منطق الأعمال في Service Layer خلف Interfaces (تطبيق SOLID عملياً).
- تطبيق التحقق من الصلاحيات عبر Policies.
- اختبار تطبيقك يدوياً وتسليمه عبر Git بشكل احترافي.

---

## 3. المتطلبات (Requirements)

### 3.1 قصص المستخدم ومعايير القبول

| # | القصة | معيار القبول |
|---|---|---|
| US1 | كطالب، أريد إنشاء حساب باسم مستخدم فريد وصورة شخصية | يرفض النظام أي username مكرر؛ الصورة اختيارية |
| US2 | كطالب، أريد تسجيل الدخول والخروج | جلسة (session) تبقى نشطة حتى تسجيل الخروج |
| US3 | كطالب، أريد طرح سؤال برمجي مع صورة للخطأ | العنوان والنص إلزاميان (10 أحرف على الأقل)، الصورة اختيارية |
| US4 | كطالب، أريد الإجابة على أسئلة الآخرين | لا يمكن للمستخدم الإجابة على سؤاله الخاص (Edge Case) |
| US5 | كصاحب سؤال، أريد اعتماد إجابة كحل صحيح | يحصل صاحب الإجابة على 10 نقاط تلقائياً؛ لا يمكن لغير صاحب السؤال الاعتماد |

### 3.2 متطلبات غير وظيفية
- كل صفحة يجب أن تعمل بدون أخطاء PHP ظاهرة للمستخدم.
- كلمات المرور مُشفّرة (Laravel يفعل هذا تلقائياً).
- الصور تُخزَّن عبر نظام Storage وليس في قاعدة البيانات مباشرة.

---

## 4. المعمارية العامة

```
المتصفح
   │
   ▼
Routes (web.php)
   │
   ▼
Controller  ─── نحيف، يستقبل الطلب فقط ───┐
   │                                       │
   ▼                                       ▼
Form Request (تحقق من الإدخال)      Service (منطق الأعمال) ← يعتمد على Interface
   │                                       │
   ▼                                       ▼
                                    Model / Eloquent → Database
   │
   ▼
Blade View → HTML للمستخدم
```

**القاعدة الذهبية لهذا المعمل:** الـ Controller لا يكتب أي منطق أعمال بنفسه، فقط يستدعي Service عبر Interface (Dependency Injection).

---

## 5. تصميم قاعدة البيانات

```
users (جدول موجود مسبقاً من Laravel + أعمدة إضافية)
├── id
├── name
├── username        UNIQUE   ← جديد
├── email           UNIQUE
├── password
├── avatar          NULLABLE ← جديد
├── reputation_points  DEFAULT 0 ← جديد
└── timestamps

questions
├── id
├── user_id     FK → users.id  (ON DELETE CASCADE)
├── title
├── body
├── image       NULLABLE
└── timestamps

answers
├── id
├── question_id FK → questions.id (ON DELETE CASCADE)
├── user_id     FK → users.id     (ON DELETE CASCADE)
├── body
├── is_accepted DEFAULT false
└── timestamps
```

**العلاقات:**
`User 1—N Question` | `User 1—N Answer` | `Question 1—N Answer`

---

## 6. خطوات التنفيذ الكاملة

### الخطوة 1: إنشاء المشروع

```bash
composer create-project laravel/laravel ibbdev "13.*"
cd ibbdev
```

في ملف `.env` تأكد من:
```env
DB_CONNECTION=sqlite
```
ثم أنشئ ملف قاعدة البيانات:
```bash
touch database/database.sqlite
php artisan migrate
```

إذا نجح الأمر بدون أخطاء، مشروعك جاهز. أنشئ فرع Git للمعمل:
```bash
git init
git checkout -b lab5-ibbdev
git add .
git commit -m "Initial Laravel 13 project setup"
```

---

### الخطوة 2: نظام المصادقة (Breeze)

```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install && npm run build
php artisan migrate
```

اختبر الآن: شغّل `php artisan serve` وافتح `/register` — يجب أن تظهر صفحة تسجيل بتنسيق Tailwind سليم.

---

### الخطوة 3: قاعدة البيانات (Migrations)

أنشئ الملفات الثلاثة التالية عبر:
```bash
php artisan make:migration add_username_avatar_reputation_to_users_table --table=users
php artisan make:migration create_questions_table
php artisan make:migration create_answers_table
```

**محتوى `..._add_username_avatar_reputation_to_users_table.php`:**
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('name');
            $table->string('avatar')->nullable()->after('username');
            $table->unsignedInteger('reputation_points')->default(0)->after('avatar');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'avatar', 'reputation_points']);
        });
    }
};
```

**محتوى `..._create_questions_table.php`:**
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('body');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
```

**محتوى `..._create_answers_table.php`:**
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('body');
            $table->boolean('is_accepted')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
```

نفّذ:
```bash
php artisan migrate
```

✅ **تحقّق:** افتح قاعدة البيانات وتأكد من وجود الأعمدة والجداول الثلاثة.

---

### الخطوة 4: النماذج (Models) والعلاقات

عدّل `app/Models/User.php`:
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'username', 'email', 'password', 'avatar', 'reputation_points',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
```

أنشئ `app/Models/Question.php`:
```bash
php artisan make:model Question
```
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['user_id', 'title', 'body', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
```

أنشئ `app/Models/Answer.php`:
```bash
php artisan make:model Answer
```
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['question_id', 'user_id', 'body', 'is_accepted'];

    protected $casts = ['is_accepted' => 'boolean'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

✅ **تحقّق عبر Tinker:**
```bash
php artisan tinker
>>> User::first()->questions
```

---

### الخطوة 5: طبقة الخدمات (Service Layer) — أهم جزء تعليمي

هنا نطبّق **SRP** (كل Service مسؤول عن شيء واحد) و **DIP** (الـ Controller يعتمد على Interface وليس على تطبيق محدد).

أنشئ مجلد `app/Contracts` وثلاثة ملفات:

**`app/Contracts/ReputationServiceInterface.php`:**
```php
<?php

namespace App\Contracts;

use App\Models\Answer;

interface ReputationServiceInterface
{
    public function awardForAcceptedAnswer(Answer $answer): void;
}
```

**`app/Contracts/QuestionServiceInterface.php`:**
```php
<?php

namespace App\Contracts;

use App\Models\Question;
use App\Models\User;

interface QuestionServiceInterface
{
    public function create(User $user, array $data): Question;
}
```

**`app/Contracts/AnswerServiceInterface.php`:**
```php
<?php

namespace App\Contracts;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;

interface AnswerServiceInterface
{
    public function create(User $user, Question $question, array $data): Answer;
}
```

أنشئ مجلد `app/Services` وثلاثة ملفات تطبّق هذه العقود:

**`app/Services/ReputationService.php`:**
```php
<?php

namespace App\Services;

use App\Contracts\ReputationServiceInterface;
use App\Models\Answer;

class ReputationService implements ReputationServiceInterface
{
    public function awardForAcceptedAnswer(Answer $answer): void
    {
        $answer->update(['is_accepted' => true]);
        $answer->user()->increment('reputation_points', 10);
    }
}
```

**`app/Services/QuestionService.php`:**
```php
<?php

namespace App\Services;

use App\Contracts\QuestionServiceInterface;
use App\Models\Question;
use App\Models\User;

class QuestionService implements QuestionServiceInterface
{
    public function create(User $user, array $data): Question
    {
        $imagePath = null;

        if (isset($data['image'])) {
            $imagePath = $data['image']->store('questions', 'public');
        }

        return Question::create([
            'user_id' => $user->id,
            'title' => $data['title'],
            'body' => $data['body'],
            'image' => $imagePath,
        ]);
    }
}
```

**`app/Services/AnswerService.php`:**
```php
<?php

namespace App\Services;

use App\Contracts\AnswerServiceInterface;
use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AnswerService implements AnswerServiceInterface
{
    public function create(User $user, Question $question, array $data): Answer
    {
        if ($question->user_id === $user->id) {
            throw ValidationException::withMessages([
                'body' => 'لا يمكنك الإجابة على سؤالك الخاص.',
            ]);
        }

        return Answer::create([
            'question_id' => $question->id,
            'user_id' => $user->id,
            'body' => $data['body'],
        ]);
    }
}
```

الآن اربط كل Interface بتطبيقه في `app/Providers/AppServiceProvider.php`:
```php
<?php

namespace App\Providers;

use App\Contracts\AnswerServiceInterface;
use App\Contracts\QuestionServiceInterface;
use App\Contracts\ReputationServiceInterface;
use App\Models\Answer;
use App\Policies\AnswerPolicy;
use App\Services\AnswerService;
use App\Services\QuestionService;
use App\Services\ReputationService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ReputationServiceInterface::class, ReputationService::class);
        $this->app->bind(QuestionServiceInterface::class, QuestionService::class);
        $this->app->bind(AnswerServiceInterface::class, AnswerService::class);
    }

    public function boot(): void
    {
        Gate::policy(Answer::class, AnswerPolicy::class);
    }
}
```

> 🧠 **لماذا هذا مهم؟** لو أردت لاحقاً تغيير طريقة حساب النقاط (مثلاً 20 نقطة بدل 10، أو نظام مضاعفات)، تُعدّل فقط داخل `ReputationService` دون لمس أي Controller. هذا هو معنى "الكود القابل للصيانة" الذي درسناه في المعمل الرابع.

---

### الخطوة 6: التحقق من الإدخال (Form Requests)

```bash
php artisan make:request StoreQuestionRequest
php artisan make:request StoreAnswerRequest
```

**`app/Http/Requests/StoreQuestionRequest.php`:**
```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'body' => 'required|string|min:10',
            'image' => 'nullable|image|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'عنوان السؤال مطلوب.',
            'body.required' => 'نص السؤال مطلوب.',
            'body.min' => 'نص السؤال يجب أن يكون 10 أحرف على الأقل.',
            'image.image' => 'الملف المرفق يجب أن يكون صورة.',
            'image.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت.',
        ];
    }
}
```

**`app/Http/Requests/StoreAnswerRequest.php`:**
```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnswerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return ['body' => 'required|string|min:5'];
    }

    public function messages(): array
    {
        return [
            'body.required' => 'نص الإجابة مطلوب.',
            'body.min' => 'الإجابة يجب أن تكون 5 أحرف على الأقل.',
        ];
    }
}
```

---

### الخطوة 7: الصلاحيات (Policy)

```bash
php artisan make:policy AnswerPolicy --model=Answer
```

**`app/Policies/AnswerPolicy.php`:**
```php
<?php

namespace App\Policies;

use App\Models\Answer;
use App\Models\User;

class AnswerPolicy
{
    public function accept(User $user, Answer $answer): bool
    {
        return $user->id === $answer->question->user_id;
    }
}
```

(تم تسجيلها مسبقاً في `AppServiceProvider::boot()` في الخطوة 5.)

---

### الخطوة 8: الـ Controllers (نحيفة)

```bash
php artisan make:controller QuestionController
php artisan make:controller AnswerController
```

**`app/Http/Controllers/QuestionController.php`:**
```php
<?php

namespace App\Http\Controllers;

use App\Contracts\QuestionServiceInterface;
use App\Http\Requests\StoreQuestionRequest;
use App\Models\Question;

class QuestionController extends Controller
{
    public function __construct(
        protected QuestionServiceInterface $questionService
    ) {}

    public function index()
    {
        $questions = Question::with('user')
            ->withCount('answers')
            ->latest()
            ->paginate(10);

        return view('questions.index', compact('questions'));
    }

    public function show(Question $question)
    {
        $question->load(['user', 'answers.user']);

        return view('questions.show', compact('question'));
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(StoreQuestionRequest $request)
    {
        $this->questionService->create($request->user(), $request->validated());

        return redirect()->route('questions.index')
            ->with('success', 'تم نشر سؤالك بنجاح.');
    }
}
```

**`app/Http/Controllers/AnswerController.php`:**
```php
<?php

namespace App\Http\Controllers;

use App\Contracts\AnswerServiceInterface;
use App\Contracts\ReputationServiceInterface;
use App\Http\Requests\StoreAnswerRequest;
use App\Models\Answer;
use App\Models\Question;

class AnswerController extends Controller
{
    public function __construct(
        protected AnswerServiceInterface $answerService,
        protected ReputationServiceInterface $reputationService
    ) {}

    public function store(StoreAnswerRequest $request, Question $question)
    {
        $this->answerService->create($request->user(), $question, $request->validated());

        return back()->with('success', 'تم إرسال إجابتك بنجاح.');
    }

    public function accept(Answer $answer)
    {
        $this->authorize('accept', $answer);

        $this->reputationService->awardForAcceptedAnswer($answer);

        return back()->with('success', 'تم اعتماد الإجابة ومنح صاحبها 10 نقاط.');
    }
}
```

لاحظ: كل constructor يستقبل **Interface** وليس Class مباشرة — هذا هو Dependency Injection المطبَّق عملياً.

---

### الخطوة 9: المسارات (Routes)

**`routes/web.php`:**
```php
<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('questions.index'));

Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');
Route::get('/questions/{question}', [QuestionController::class, 'show'])->name('questions.show');

Route::middleware('auth')->group(function () {
    Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');

    Route::post('/questions/{question}/answers', [AnswerController::class, 'store'])->name('answers.store');
    Route::post('/answers/{answer}/accept', [AnswerController::class, 'accept'])->name('answers.accept');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
```

✅ **تحقّق:** `php artisan route:list` يجب أن يعرض كل هذه المسارات بأسمائها.

---

### الخطوة 10: واجهات Blade

**`resources/views/layouts/app.blade.php`:**
```blade
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IBBDev</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <nav class="bg-white border-b shadow-sm">
        <div class="max-w-4xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ route('questions.index') }}" class="text-xl font-bold text-indigo-600">IBBDev</a>

            <div class="flex items-center gap-4">
                @auth
                    <span class="text-sm text-gray-600">
                        {{ auth()->user()->name }} — {{ auth()->user()->reputation_points }} نقطة
                    </span>
                    <a href="{{ route('questions.create') }}" class="text-sm text-indigo-600">سؤال جديد</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-sm text-red-500">خروج</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm">دخول</a>
                    <a href="{{ route('register') }}" class="text-sm">تسجيل</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 py-8">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>
</body>
</html>
```

**`resources/views/questions/index.blade.php`:**
```blade
@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">الأسئلة</h1>

    <div class="space-y-4">
        @forelse ($questions as $question)
            <a href="{{ route('questions.show', $question) }}"
               class="block bg-white p-4 rounded shadow-sm hover:shadow-md">
                <h2 class="text-lg font-semibold text-indigo-600">{{ $question->title }}</h2>
                <p class="text-sm text-gray-500 mt-1">
                    بواسطة {{ $question->user->username }} — {{ $question->answers_count }} إجابة
                </p>
            </a>
        @empty
            <p class="text-gray-500">لا توجد أسئلة بعد. كن أول من يطرح سؤالاً!</p>
        @endforelse
    </div>

    <div class="mt-6">{{ $questions->links() }}</div>
@endsection
```

**`resources/views/questions/create.blade.php`:**
```blade
@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">سؤال جديد</h1>

    <form method="POST" action="{{ route('questions.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">العنوان</label>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full border rounded p-2">
            @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">تفاصيل السؤال</label>
            <textarea name="body" rows="5" class="w-full border rounded p-2">{{ old('body') }}</textarea>
            @error('body') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">صورة الخطأ (اختياري)</label>
            <input type="file" name="image" class="w-full">
            @error('image') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <button class="bg-indigo-600 text-white px-4 py-2 rounded">نشر السؤال</button>
    </form>
@endsection
```

**`resources/views/questions/show.blade.php`:**
```blade
@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-2">{{ $question->title }}</h1>
    <p class="text-sm text-gray-500 mb-4">بواسطة {{ $question->user->username }}</p>

    <div class="bg-white p-4 rounded shadow-sm mb-6">
        <p>{{ $question->body }}</p>

        @if ($question->image)
            <img src="{{ asset('storage/'.$question->image) }}" class="mt-4 rounded max-w-md">
        @endif
    </div>

    <h2 class="text-xl font-semibold mb-4">الإجابات ({{ $question->answers->count() }})</h2>

    <div class="space-y-4 mb-8">
        @forelse ($question->answers as $answer)
            <div class="bg-white p-4 rounded shadow-sm {{ $answer->is_accepted ? 'border-2 border-green-500' : '' }}">
                <p>{{ $answer->body }}</p>
                <div class="flex justify-between items-center mt-2">
                    <span class="text-sm text-gray-500">بواسطة {{ $answer->user->username }}</span>

                    @if ($answer->is_accepted)
                        <span class="text-green-600 text-sm font-semibold">✔ إجابة معتمدة</span>
                    @elseif (auth()->check() && auth()->id() === $question->user_id)
                        <form method="POST" action="{{ route('answers.accept', $answer) }}">
                            @csrf
                            <button class="text-sm text-indigo-600">اعتماد كحل</button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-gray-500">لا توجد إجابات بعد.</p>
        @endforelse
    </div>

    @auth
        @if (auth()->id() !== $question->user_id)
            <form method="POST" action="{{ route('answers.store', $question) }}" class="space-y-3">
                @csrf
                <textarea name="body" rows="4" placeholder="اكتب إجابتك..." class="w-full border rounded p-2">{{ old('body') }}</textarea>
                @error('body') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                <button class="bg-indigo-600 text-white px-4 py-2 rounded">إرسال الإجابة</button>
            </form>
        @endif
    @else
        <p class="text-gray-500">
            <a href="{{ route('login') }}" class="text-indigo-600">سجّل دخولك</a> للإجابة على هذا السؤال.
        </p>
    @endauth
@endsection
```

---

### الخطوة 11: رفع الصور — تفعيل رابط التخزين

```bash
php artisan storage:link
```

بدون هذا الأمر، الصور المرفوعة لن تظهر في المتصفح رغم أنها محفوظة فعلياً في `storage/app/public`.

---

## 7. الاختبار اليدوي الشامل (Checklist)

- [ ] إنشاء حساب جديد باسم مستخدم فريد
- [ ] محاولة إنشاء حساب بنفس الـ username → يُرفض
- [ ] تسجيل الدخول والخروج يعملان
- [ ] طرح سؤال بدون صورة
- [ ] طرح سؤال مع صورة، وتظهر عند عرض السؤال
- [ ] الإجابة على سؤال لمستخدم آخر
- [ ] محاولة الإجابة على سؤالك الخاص → تُرفض برسالة واضحة
- [ ] اعتماد إجابة من صاحب السؤال ← نقاط المُجيب تزيد 10
- [ ] محاولة اعتماد إجابة من غير صاحب السؤال → صفحة 403

---

## 8. التسليم عبر Git

```bash
git add .
git commit -m "Complete IBBDev platform - Lab 5"
git push origin lab5-ibbdev
```

افتح Pull Request على GitHub واكتب وصفاً يلخص الميزات المُنفذة، تماماً كما تعلمنا في المعمل الأول.

---

## 9. الربط النهائي بالمعامل السابقة

| ما بنيته هنا | المفهوم | من أي معمل |
|---|---|---|
| فرع Git + Pull Request | Git Workflow | 1 |
| Controllers + Blade + Form Requests | MVC / CRUD | 2 |
| Models + علاقات + Interfaces | OOP | 3 |
| Service Layer + SRP + DIP + Policy | SOLID | 4 |
| **تطبيق حقيقي كامل يجمع كل ما سبق** | **الهندسة البرمجية المتكاملة** | **5** |
