# المعمل الخامس: بناء منصة IBBDev الكاملة باستخدام Laravel 13 (Blade)

> مادة: هندسة البرمجيات — إعداد: م. ساهر
> هذا الملف مصمم ليُستخدم مباشرة من قبل الطالب على جهازه الشخصي، خطوة بخطوة.

---

## 🔗 كيف يرتبط هذا المعمل بما سبق

| المعمل | ما تعلمناه | كيف نستخدمه هنا |
|---|---|---|
| 1 | User Stories، Git/GitHub، Kanban | كل ميزة = فرع (branch) منفصل، ونكتب قصص المستخدم قبل البرمجة |
| 2 | MVC، CRUD، Form Requests، Blade، Tailwind | نبني تطبيق Blade كامل (وليس API) بنفس الأسلوب |
| 3 | OOP، Interfaces، Dependency Injection | نطبّق DI حقيقياً بين Controller و Service |
| 4 | SOLID، Service Layer، UML | نفصل منطق نظام النقاط في Service مستقل خلف Interface |

---

## 📌 نظرة عامة على المشروع: IBBDev

منصة تفاعلية لطلاب علوم الحاسوب لتبادل الخبرات البرمجية، تحتوي على:

- **إدارة الحسابات:** تسجيل دخول/إنشاء حساب، صورة شخصية (Avatar)، اسم مستخدم فريد (Username).
- **طرح الأسئلة:** كتابة سؤال برمجي مع إمكانية إرفاق صورة للخطأ.
- **تقديم الإجابات:** الرد على أسئلة الزملاء.
- **نظام النقاط (Reputation System):** صاحب الإجابة يحصل على 10 نقاط تلقائياً عند اعتماد إجابته كحل صحيح.

**ملاحظة مهمة:** هذا الإصدار Blade (واجهات كاملة بصفحات HTML)، وليس API. كل شيء يظهر مباشرة في المتصفح.

---

## 🧰 كيف تستخدم هذا الملف

لكل خطوة أدناه ثلاثة أجزاء:

1. **الشرح 📖** — لماذا نفعل هذا وما الفكرة الهندسية وراءه.
2. **الـ Prompt الجاهز 🧠** — نص جاهز، انسخه بالكامل والصقه في أداة الذكاء الاصطناعي البرمجية على جهازك (Claude Code، أو opencode، أو أي أداة مشابهة).
3. **تحقّق قبل المتابعة ✅** — لا تنتقل للخطوة التالية قبل التأكد من هذه النقاط.

> ⚠️ لا تنسخ كل الخطوات دفعة واحدة. نفّذ خطوة، افهم ما حدث، تأكد أنها تعمل، ثم انتقل للتالية. هذا هو جوهر التعلّم الهندسي.

---

## الخطوة 0: المتطلبات قبل البدء

### 📖 الشرح
قبل أي سطر كود، تأكد أن بيئة عملك جاهزة، تماماً كما تعلمنا في المعمل الأول عند تجهيز Git وبيئة الفريق.

تأكد من توفر:
- PHP 8.3 أو أحدث
- Composer
- Node.js و npm
- MySQL (أو SQLite للتبسيط)
- Git
- أداة ذكاء اصطناعي برمجية مثبتة على جهازك (Claude Code / opencode / Cursor)

### ✅ تحقّق قبل المتابعة
```
php -v
composer -V
node -v
git -v
```
كل أمر يجب أن يعطي رقم إصدار وليس رسالة خطأ.

---

## الخطوة 1: تهيئة المشروع

### 📖 الشرح
هذه أول لبنة: مشروع Laravel 13 فارغ متصل بقاعدة بيانات، وفرع Git خاص بالمعمل الخامس (تطبيق مباشر لعادة الفروع من المعمل الأول).

### 🧠 الـ Prompt الجاهز
```
أنشئ لي مشروع Laravel 13 جديد باسم "ibbdev" باستخدام composer.
بعد الإنشاء:
1. أنشئ ملف .env بالإعدادات الافتراضية واربطه بقاعدة بيانات SQLite (أسهل للاختبار المحلي).
2. شغّل أمر إنشاء قاعدة البيانات وملف database.sqlite إن لم يكن موجوداً.
3. شغّل php artisan migrate للتأكد أن الاتصال بقاعدة البيانات يعمل.
4. أنشئ مستودع Git جديد داخل المشروع (git init) واعمل أول commit بعنوان "Initial Laravel 13 project setup".
5. اشرح لي باختصار بنية المجلدات الأساسية في Laravel (app, routes, database, resources).
```

### ✅ تحقّق قبل المتابعة
- الأمر `php artisan serve` يعمل وتفتح الصفحة الافتراضية للمشروع في المتصفح.
- يوجد commit واحد على الأقل في Git.

---

## الخطوة 2: تصميم قاعدة البيانات (Migrations)

### 📖 الشرح
هذه الخطوة تُترجم مخطط الـ ERD إلى جداول حقيقية. لدينا 3 جداول رئيسية:

```
users        (موجود افتراضياً + أعمدة إضافية)
├── username (unique)
├── avatar (nullable)
└── reputation_points (integer, default 0)

questions
├── user_id (FK -> users)
├── title
├── body
└── image (nullable)

answers
├── question_id (FK -> questions)
├── user_id (FK -> users)
├── body
└── is_accepted (boolean, default false)
```

### 🧠 الـ Prompt الجاهز
```
أضف إلى مشروع Laravel 13 الخاص بي (ibbdev) الآتي:

1. Migration جديد يضيف على جدول users الأعمدة التالية:
   - username: string, unique, بعد عمود name
   - avatar: string, nullable
   - reputation_points: unsignedInteger, default 0

2. Migration لجدول questions يحتوي:
   - id
   - user_id: foreign key مرتبط بجدول users مع onDelete('cascade')
   - title: string
   - body: text
   - image: string, nullable
   - timestamps

3. Migration لجدول answers يحتوي:
   - id
   - question_id: foreign key مرتبط بجدول questions مع onDelete('cascade')
   - user_id: foreign key مرتبط بجدول users مع onDelete('cascade')
   - body: text
   - is_accepted: boolean, default false
   - timestamps

بعد كتابة الملفات، شغّل php artisan migrate وتأكد أنها تمر بدون أخطاء.
```

### ✅ تحقّق قبل المتابعة
- أمر `php artisan migrate` نجح بدون أخطاء.
- افتح قاعدة البيانات (عبر TablePlus أو DB Browser for SQLite) وتأكد من وجود الجداول الثلاثة بالأعمدة الصحيحة.

---

## الخطوة 3: نظام المصادقة بواجهات Blade

### 📖 الشرح
بدلاً من كتابة تسجيل الدخول والتسجيل من الصفر، نستخدم Laravel Breeze الذي يجهّز واجهات Blade جاهزة (تسجيل، دخول، خروج، إعادة تعيين كلمة المرور) مبنية على Tailwind CSS — نفس ما تعلمناه في المعمل الثاني.

### 🧠 الـ Prompt الجاهز
```
ثبّت حزمة Laravel Breeze في مشروع ibbdev باستخدام composer، ثم فعّلها باختيار الواجهة Blade (وليس React أو Vue).
بعد التثبيت:
1. شغّل أوامر npm install و npm run build.
2. شغّل php artisan migrate مرة أخرى للتأكد أن أي جداول جديدة أضافتها Breeze تم إنشاؤها.
3. شغّل الخادم المحلي وتأكد من ظهور صفحات /login و /register بتنسيق Tailwind سليم.
4. اشرح لي أين وضعت Breeze ملفات auth controllers وملفات views الخاصة بها.
```

### ✅ تحقّق قبل المتابعة
- يمكنك فتح `/register` وإنشاء حساب تجريبي بنجاح.
- بعد التسجيل تنتقل تلقائياً إلى Dashboard.

---

## الخطوة 4: النماذج والعلاقات (Eloquent Models)

### 📖 الشرح
هنا نطبّق مباشرة مفاهيم العلاقات في Eloquent (One-to-Many) التي تخدم مبدأ Single Responsibility: كل Model مسؤول فقط عن بياناته وعلاقاته.

### 🧠 الـ Prompt الجاهز
```
أنشئ لي في مشروع ibbdev الـ Models التالية مع علاقاتها:

1. عدّل App\Models\User ليحتوي على:
   - علاقة hasMany مع Question باسم questions
   - علاقة hasMany مع Answer باسم answers
   - أضف username, avatar, reputation_points إلى المصفوفة $fillable

2. أنشئ Model باسم Question يحتوي على:
   - $fillable تشمل user_id, title, body, image
   - علاقة belongsTo مع User باسم user
   - علاقة hasMany مع Answer باسم answers

3. أنشئ Model باسم Answer يحتوي على:
   - $fillable تشمل question_id, user_id, body, is_accepted
   - علاقة belongsTo مع Question باسم question
   - علاقة belongsTo مع User باسم user

اشرح لي الفرق بين hasMany و belongsTo بمثال بسيط من هذا المشروع تحديداً.
```

### ✅ تحقّق قبل المتابعة
- في `php artisan tinker` جرّب: `User::first()->questions` ولا تحصل على خطأ.

---

## الخطوة 5: طبقة الخدمات (Service Layer) + Interfaces + DI

### 📖 الشرح
هذه أهم خطوة تعليمية في المعمل، لأنها تربط مباشرة بالمعمل الرابع (SOLID). سنعزل منطق "منح نقاط السمعة" في Service مستقل خلف Interface، بدلاً من كتابته داخل الـ Controller مباشرة. هذا تطبيق حي لمبدأي:
- **SRP** (Single Responsibility): الـ Controller لا يعرف كيف تُحسب النقاط، فقط يطلب من الـ Service تنفيذ العملية.
- **DIP** (Dependency Inversion): الـ Controller يعتمد على Interface وليس على تطبيق محدد.

### 🧠 الـ Prompt الجاهز
```
في مشروع ibbdev، أنشئ طبقة خدمات (Service Layer) بالشكل التالي:

1. أنشئ مجلد app/Contracts وبداخله interface باسم ReputationServiceInterface
   يحتوي على method واحدة:
   public function awardForAcceptedAnswer(Answer $answer): void;

2. أنشئ مجلد app/Services وبداخله class باسم ReputationService
   يطبّق ReputationServiceInterface، بحيث تقوم الدالة awardForAcceptedAnswer بـ:
   - تحديث الإجابة المُمررة بجعل is_accepted = true
   - إضافة 10 نقاط إلى reputation_points الخاص بصاحب الإجابة (owner) باستخدام increment

3. اربط الـ Interface بالـ Service داخل app/Providers/AppServiceProvider.php
   عبر method register()، باستخدام:
   $this->app->bind(ReputationServiceInterface::class, ReputationService::class);

4. أنشئ كذلك QuestionService و AnswerService بنفس الأسلوب (Interface + implementation)
   يحتويان على العمليات الأساسية (إنشاء سؤال، إنشاء إجابة، منع المستخدم من الإجابة على سؤاله الخاص).

اشرح لي بجملتين فقط: لماذا لا نضع هذا الكود مباشرة داخل الـ Controller؟
```

### ✅ تحقّق قبل المتابعة
- الملفات موجودة في `app/Contracts` و `app/Services`.
- الربط موجود في `AppServiceProvider`.
- تفهم إجابة الذكاء الاصطناعي عن سبب فصل هذا المنطق (اسأل معلمك إن لم تفهم).

---

## الخطوة 6: التحقق من صحة البيانات (Form Requests)

### 📖 الشرح
مثل المعمل الثاني، ننقل منطق التحقق خارج الـ Controller إلى فئات Form Request مخصصة، حتى يبقى الـ Controller نظيفاً ومختصاً فقط بالتنسيق.

### 🧠 الـ Prompt الجاهز
```
أنشئ في مشروع ibbdev فئتي Form Request التاليتين:

1. StoreQuestionRequest:
   - title: required, string, max:255
   - body: required, string, min:10
   - image: nullable, image, max:2048

2. StoreAnswerRequest:
   - body: required, string, min:5

فعّل authorize() لترجع true في كليهما، وأضف رسائل خطأ بالعربية داخل method باسم messages().
```

### ✅ تحقّق قبل المتابعة
- الملفان موجودان في `app/Http/Requests`.
- رسائل الخطأ مكتوبة بالعربية بشكل مفهوم.

---

## الخطوة 7: الـ Controllers (نحيفة)

### 📖 الشرح
تذكّروا مشكلة "Fat Controller" من المعمل الرابع. هنا نطبّق الحل: الـ Controller يستقبل الطلب فقط، يستدعي الـ Service، ويُرجع الـ View. لا منطق أعمال هنا إطلاقاً.

### 🧠 الـ Prompt الجاهز
```
أنشئ في مشروع ibbdev الـ Controllers التالية، بحيث تعتمد على الـ Services عبر Dependency Injection في الـ constructor (وليس بإنشاء new Service() يدوياً):

1. QuestionController مع الدوال:
   - index(): يعرض كل الأسئلة (مرتبة الأحدث أولاً) مع بيانات صاحب كل سؤال
   - show(Question $question): يعرض سؤالاً واحداً مع كل إجاباته
   - create(): يعرض نموذج إنشاء سؤال جديد
   - store(StoreQuestionRequest $request): ينشئ السؤال عبر QuestionService

2. AnswerController مع الدوال:
   - store(StoreAnswerRequest $request, Question $question): ينشئ إجابة عبر AnswerService،
     ويجب أن يمنع المستخدم من الإجابة على سؤاله الخاص (استخدم QuestionService لهذا التحقق)
   - accept(Answer $answer): يتحقق أن المستخدم الحالي هو صاحب السؤال، ثم يستدعي
     ReputationServiceInterface->awardForAcceptedAnswer()

اجعل كل constructor يستقبل الـ Interfaces وليس الـ Services مباشرة.
```

### ✅ تحقّق قبل المتابعة
- كل constructor في الـ Controllers يستقبل نوع الـ Interface (type-hint) وليس الـ class مباشرة.
- لا يوجد أي `new ReputationService()` أو مشابه داخل الـ Controllers.

---

## الخطوة 8: المسارات (Routes)

### 📖 الشرح
نربط كل ما سبق عبر `routes/web.php`، مع التمييز بين المسارات المفتوحة للجميع والمسارات التي تتطلب middleware باسم auth.

### 🧠 الـ Prompt الجاهز
```
عدّل ملف routes/web.php في مشروع ibbdev بحيث يحتوي على:

مسارات مفتوحة (بدون auth):
- GET /questions -> QuestionController@index باسم questions.index
- GET /questions/{question} -> QuestionController@show باسم questions.show

مسارات محمية (داخل Route::middleware('auth')):
- GET /questions/create -> QuestionController@create باسم questions.create
- POST /questions -> QuestionController@store باسم questions.store
- POST /questions/{question}/answers -> AnswerController@store باسم answers.store
- POST /answers/{answer}/accept -> AnswerController@accept باسم answers.accept

اجعل الصفحة الرئيسية / تُحوّل مباشرة إلى /questions.
```

### ✅ تحقّق قبل المتابعة
- أمر `php artisan route:list` يظهر كل المسارات أعلاه بأسمائها الصحيحة.

---

## الخطوة 9: واجهات Blade

### 📖 الشرح
هذه الطبقة المرئية. نستخدم Layout رئيسي واحد (نفس فكرة `@extends` من المعمل الثاني) حتى لا نكرر كود الـ header والـ navbar في كل صفحة.

### 🧠 الـ Prompt الجاهز
```
أنشئ في مشروع ibbdev واجهات Blade التالية باستخدام Tailwind CSS (نفس نمط Breeze الحالي):

1. resources/views/layouts/app.blade.php
   - يحتوي navbar فيه رابط "الأسئلة" وعرض اسم المستخدم ونقاط سمعته إن كان مسجلاً دخوله
   - @yield('content') في المنتصف

2. resources/views/questions/index.blade.php
   - يعرض بطاقة (card) لكل سؤال: العنوان، اسم صاحبه، عدد الإجابات
   - رابط "سؤال جديد" يظهر فقط إذا كان المستخدم مسجلاً دخوله (استخدم @auth)

3. resources/views/questions/create.blade.php
   - نموذج فيه title, body, image (input file)
   - استخدم @csrf وأظهر رسائل الأخطاء تحت كل حقل عبر @error

4. resources/views/questions/show.blade.php
   - تفاصيل السؤال، صورته إن وجدت
   - قائمة الإجابات، وزر "اعتماد كحل" يظهر فقط لصاحب السؤال وللإجابات غير المعتمدة بعد
   - نموذج لإضافة إجابة جديدة يظهر فقط إذا كان المستخدم مسجلاً دخوله ولم يكن هو صاحب السؤال

استخدم @if و @foreach و @auth و @error في كل مكان مناسب، وتأكد من التنسيق بـ Tailwind.
```

### ✅ تحقّق قبل المتابعة
- تصفّح `/questions` من المتصفح ولا تظهر أي أخطاء Blade.
- جرّب إنشاء سؤال وتأكد من ظهوره في القائمة.

---

## الخطوة 10: رفع الصور (Avatar وصور الأسئلة)

### 📖 الشرح
نستخدم نظام تخزين الملفات في Laravel (Storage) بدلاً من حفظ الصور مباشرة في قاعدة البيانات.

### 🧠 الـ Prompt الجاهز
```
في مشروع ibbdev، فعّل رفع الصور كالتالي:

1. تأكد أن رابط storage موجود عبر: php artisan storage:link

2. في QuestionService، عند إنشاء سؤال يحتوي على صورة:
   خزّن الصورة عبر $request->file('image')->store('questions', 'public')
   واحفظ المسار الناتج في عمود image

3. في صفحة profile الخاصة بـ Breeze، أضف حقل رفع avatar
   يُخزَّن في مجلد avatars عبر نفس الطريقة، ويُحدَّث عمود avatar في جدول users

4. في الواجهات، اعرض الصور عبر: <img src="{{ asset('storage/'.$question->image) }}">

اشرح لي الفرق بين مجلد storage/app/public ومجلد public/storage.
```

### ✅ تحقّق قبل المتابعة
- بعد رفع صورة لسؤال، تظهر فعلياً عند عرض السؤال.
- المجلد `storage/app/public/questions` يحتوي على الصورة المرفوعة.

---

## الخطوة 11: الصلاحيات (Authorization)

### 📖 الشرح
نطبّق قواعد الوصول التي حددناها في الـ Acceptance Criteria: لا يمكن للمستخدم الإجابة على سؤاله الخاص، ولا يمكن لغير صاحب السؤال اعتماد إجابة.

### 🧠 الـ Prompt الجاهز
```
أنشئ في مشروع ibbdev Policy باسم AnswerPolicy مرتبطة بـ Model باسم Answer، تحتوي على:

- method باسم accept(User $user, Answer $answer) ترجع true فقط إذا كان
  $user هو نفسه صاحب السؤال المرتبط بهذه الإجابة (answer->question->user_id)

سجّل الـ Policy في AuthServiceProvider، ثم استخدمها داخل AnswerController@accept
عبر $this->authorize('accept', $answer) بدلاً من أي تحقق يدوي متفرق.

أيضاً أضف تحققاً في AnswerController@store يمنع إنشاء إجابة إذا كان
auth()->id() == $question->user_id، مع رسالة خطأ واضحة بالعربية.
```

### ✅ تحقّق قبل المتابعة
- جرّب الدخول بحساب غير صاحب السؤال ومحاولة اعتماد إجابة → يجب أن تُرفض العملية (403).
- جرّب الإجابة على سؤالك الخاص → يجب أن تظهر رسالة رفض واضحة.

---

## الخطوة 12: الاختبار اليدوي الشامل (Checklist)

### 📖 الشرح
قبل تسليم أي معمل، دائماً اختبر بنفسك كأنك مستخدم حقيقي — نفس فكرة الـ Edge Cases من المعمل الأول.

### ✅ نفّذ هذه السيناريوهات يدوياً عبر المتصفح
- [ ] إنشاء حساب جديد باسم مستخدم فريد (username)
- [ ] محاولة إنشاء حساب بنفس الـ username → يجب أن يُرفض
- [ ] تسجيل الدخول والخروج
- [ ] طرح سؤال بدون صورة
- [ ] طرح سؤال مع صورة والتأكد من ظهورها
- [ ] الإجابة على سؤال لمستخدم آخر
- [ ] محاولة الإجابة على سؤالك الخاص → يجب أن تُرفض
- [ ] اعتماد إجابة من صاحب السؤال ← نقاط صاحب الإجابة تزيد 10
- [ ] محاولة اعتماد إجابة من مستخدم ليس صاحب السؤال → يجب أن تُرفض

---

## الخطوة 13: Git والتسليم

### 📖 الشرح
تطبيق أخير لعادة المعمل الأول: لا تُسلّم كود لم يمر عبر Pull Request.

### 🧠 الـ Prompt الجاهز
```
في مشروع ibbdev:
1. أنشئ ملف .gitignore مناسباً لمشروع Laravel إن لم يكن موجوداً (تجاهل vendor, node_modules, .env, database.sqlite)
2. أضف كل التغييرات واعمل commit بعنوان واضح "Complete IBBDev platform - Lab 5"
3. ادفع (push) الفرع إلى GitHub
4. اقترح عليّ نص وصف (description) مناسب لفتح Pull Request يلخص كل الميزات المُنفذة
```

### ✅ تحقّق قبل المتابعة
- الملف `.env` و `database.sqlite` **غير** موجودين في GitHub.
- الـ Pull Request مفتوح ويحتوي وصفاً واضحاً بالميزات.

---

## 🎯 ملخص الربط النهائي بالمعامل السابقة

| ما بنيته في هذا المعمل | المفهوم الذي طبّقته | من أي معمل |
|---|---|---|
| فروع Git لكل ميزة | Git Workflow | المعمل 1 |
| Blade + Tailwind + Form Requests | MVC / CRUD | المعمل 2 |
| Interfaces + Dependency Injection | OOP | المعمل 3 |
| Service Layer + SRP + DIP | SOLID | المعمل 4 |
| **كل ما سبق مجتمعاً في تطبيق واحد حقيقي** | **الهندسة البرمجية الكاملة** | **المعمل 5** |

---


