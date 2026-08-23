<div dir="rtl">

<div align="center">

# 🚀 مختبر هندسة البرمجيات — إدارة المهام

تطبيق تعليمي حديث لبناء وإدارة المهام باستخدام **Laravel 13** ونمط **MVC**، مع تطبيق عملي متكامل لعمليات **CRUD**.

[![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net)
[![Pest](https://img.shields.io/badge/Pest-4-F24E1E?style=for-the-badge)](https://pestphp.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)

[التثبيت](#-تثبيت-المشروع) · [تشغيل المشروع](#-تشغيل-المشروع) · [الصفحات](#️-صفحات-إدارة-المهام) · [المسارات](#️-مسارات-المهام-الحالية) · [الدليل العملي](#-الدليل-العملي-للمحاضرة-الثانية)

</div>

---

## 📖 نبذة عن المشروع

أُنشئ هذا المستودع بوصفه تطبيقًا عمليًا لمقرر **هندسة البرمجيات — المستوى الرابع (تقنية معلومات)**. يوضح المشروع دورة بناء ميزة إدارة المهام من قاعدة البيانات حتى واجهة المستخدم، ويتضمن:

- أربع صفحات مستقلة للمهام: القائمة، والإنشاء، والعرض، والتعديل.
- إنشاء المهام وعرض تفاصيلها وتعديلها وحذفها من واجهة عربية متجاوبة.
- تغيير حالة المهمة بين «قيد التنفيذ» و«مكتملة».
- عرض إحصاءات إجمالية للمهام المكتملة والمهام قيد التنفيذ.
- تقسيم القائمة إلى صفحات، بحيث تعرض كل صفحة 9 مهام.
- التحقق من المدخلات برسائل عربية باستخدام `Form Requests`.
- استخدام `Route Model Binding` للوصول الآمن إلى السجلات.
- حماية جميع مسارات المهام بالوسيطين `auth` و`verified`.
- توليد بيانات تجريبية باستخدام `Factory` و`Seeder`.
- واجهات عربية حديثة ومتجاوبة مبنية باستخدام `Blade` و`Tailwind CSS`.
- نموذج Blade مشترك بين صفحتي الإنشاء والتعديل لتقليل تكرار الكود.
- نظام تسجيل دخول وإدارة ملف شخصي باستخدام `Laravel Breeze`.
- اختبارات آلية باستخدام `Pest`.

## 🧰 التقنيات المستخدمة

| التقنية | الإصدار أو الاستخدام |
| --- | --- |
| Laravel | `13.x` |
| PHP | `8.3` أو أحدث |
| Laravel Breeze | المصادقة وإدارة الحساب |
| Blade | بناء واجهات العرض |
| Tailwind CSS | تنسيق الواجهات |
| Alpine.js | التفاعلات البسيطة في الواجهة |
| SQLite | قاعدة البيانات الافتراضية |
| Vite | بناء وتشغيل ملفات الواجهة |
| Pest | الاختبارات الآلية |

## ✅ المتطلبات

تأكد من تثبيت الأدوات التالية قبل البدء:

- `PHP 8.3` أو أحدث مع إضافات PHP التي يتطلبها Laravel.
- `Composer 2`.
- `Node.js 20.19` أو أحدث، أو `Node.js 22.12` أو أحدث.
- `npm`.
- `Git`.

## 📥 تثبيت المشروع

### 1. تنزيل المستودع والدخول إلى مجلده

```bash
git clone https://github.com/Qaidsaher/IBBDev.git
cd IBBDev
```

### 2. تثبيت حزم PHP

```bash
composer install
```

### 3. إنشاء ملف الإعدادات المحلي

على **Windows PowerShell**:

```powershell
Copy-Item .env.example .env
```

على **Linux أو macOS**:

```bash
cp .env.example .env
```

ثم أنشئ مفتاح تشفير التطبيق:

```bash
php artisan key:generate
```

### 4. تجهيز قاعدة بيانات SQLite

الإعداد الافتراضي في `.env.example` يستخدم SQLite. أنشئ ملف قاعدة البيانات الفارغ:

على **Windows PowerShell**:

```powershell
New-Item database/database.sqlite -ItemType File -Force
```

على **Linux أو macOS**:

```bash
touch database/database.sqlite
```

بعد ذلك أنشئ الجداول والبيانات التجريبية:

```bash
php artisan migrate --seed
```

> ينشئ الأمر بيانات تجريبية، منها مستخدم بالبريد `test@example.com`. كلمة المرور الافتراضية التي ينشئها مصنع المستخدمين هي `password`.

### 5. تثبيت حزم الواجهة وبناؤها

```bash
npm install
npm run build
```

## ▶️ تشغيل المشروع

شغّل خادم Laravel ومعالج الطابور وخادم Vite معًا:

```bash
composer run dev
```

ثم افتح الرابط الذي يظهر في الطرفية، وغالبًا يكون:

```text
http://127.0.0.1:8000
```

صفحة إدارة المهام متاحة على:

```text
http://127.0.0.1:8000/tasks
```

لإيقاف خوادم التطوير اضغط `Ctrl + C`.

## 🧪 تشغيل الاختبارات

لتشغيل جميع اختبارات المشروع:

```bash
php artisan test --compact
```

لتشغيل اختبارات إدارة المهام فقط:

```bash
php artisan test --compact tests/Feature/TaskManagementTest.php
```

تغطي اختبارات المهام الحالات التالية:

- منع الزائر من الوصول إلى صفحات المهام الأربع.
- نجاح عرض صفحات `index` و`create` و`show` و`edit`.
- إنشاء مهمة جديدة وإعادة التوجيه إلى صفحة تفاصيلها.
- ظهور رسائل التحقق العربية للبيانات غير الصحيحة.
- تعديل بيانات المهمة وحالة إنجازها.
- حذف المهمة والتأكد من إزالتها من قاعدة البيانات.

ويمكن تشغيل مجموعة الاختبارات كاملة عبر Composer أيضًا:

```bash
composer test
```

### آخر نتيجة تحقق

وقت تحديث هذه الوثيقة:

- نجح **31 اختبارًا** بإجمالي **101 assertion**.
- نجح بناء ملفات الواجهة باستخدام `npm run build`.
- ظهرت المسارات السبعة للمهام بنجاح عبر `php artisan route:list --path=tasks --except-vendor`.
- اجتاز كود PHP تنسيق Laravel Pint.

## 🗃️ أوامر مفيدة أثناء التطوير

| الأمر | الوظيفة |
| --- | --- |
| `php artisan route:list` | عرض مسارات التطبيق |
| `php artisan migrate` | تنفيذ عمليات ترحيل قاعدة البيانات الجديدة |
| `php artisan migrate:fresh --seed` | إعادة إنشاء قاعدة البيانات وإضافة بيانات تجريبية؛ يحذف البيانات الحالية |
| `php artisan test --compact` | تشغيل الاختبارات |
| `vendor/bin/pint --format agent` | تنسيق ملفات PHP |
| `npm run dev` | تشغيل Vite ومراقبة تغييرات الواجهة |
| `npm run build` | إنشاء نسخة الإنتاج من ملفات الواجهة |

## 🧩 مكونات المشروع

```text
app/
├── Http/Controllers/TaskController.php     # منطق إدارة المهام
├── Http/Requests/                          # قواعد التحقق من المدخلات
└── Models/Task.php                         # نموذج المهمة
database/
├── factories/TaskFactory.php               # توليد مهام تجريبية
├── migrations/                             # بنية جداول قاعدة البيانات
└── seeders/DatabaseSeeder.php              # تعبئة البيانات التجريبية
resources/views/tasks/                      # صفحات إدارة المهام الأربع
├── index.blade.php                         # قائمة المهام والإحصاءات
├── create.blade.php                        # صفحة إنشاء مهمة
├── show.blade.php                          # صفحة تفاصيل المهمة
├── edit.blade.php                          # صفحة تعديل المهمة
└── partials/form.blade.php                 # النموذج المشترك
resources/views/layouts/
├── app.blade.php                           # التخطيط العربي الرئيسي
└── navigation.blade.php                    # شريط التنقل المتجاوب
routes/web.php                              # مسارات الويب
tests/Feature/TaskManagementTest.php        # اختبارات دورة CRUD
```

## 🖥️ صفحات إدارة المهام

بُنيت كل عملية رئيسية في صفحة مستقلة حتى تكون تجربة الاستخدام أوضح وأسهل في الصيانة:

| الصفحة | الملف | المسار | المسؤولية |
| --- | --- | --- | --- |
| قائمة المهام | `tasks/index.blade.php` | `/tasks` | عرض البطاقات والإحصاءات والترقيم وأزرار الإجراءات |
| إنشاء مهمة | `tasks/create.blade.php` | `/tasks/create` | إدخال عنوان المهمة ووصفها وحالتها |
| تفاصيل المهمة | `tasks/show.blade.php` | `/tasks/{task}` | عرض البيانات والحالة وتاريخ الإنشاء وآخر تحديث |
| تعديل المهمة | `tasks/edit.blade.php` | `/tasks/{task}/edit` | تحديث الحقول أو تغيير حالة الإنجاز |

تعتمد الصفحات الأربع على التخطيط `layouts/app.blade.php` الذي يضبط اتجاه الصفحة إلى `RTL`، ويستخدم خطًا عربيًا، وشريط تنقل متجاوبًا، وخلفية موحدة. كما تستخدم صفحتا الإنشاء والتعديل الملف `tasks/partials/form.blade.php` نفسه، لذلك تبقى الحقول ورسائل الأخطاء وأزرار الحفظ متناسقة في المكانين.

## 🛣️ مسارات المهام الحالية

يعرّف التطبيق المسارات السبعة القياسية باستخدام `Route::resource`، ويحميها من وصول الزائر غير المسجل:

```php
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('tasks', TaskController::class);
});
```

| الفعل | الرابط | اسم المسار | دالة المتحكم |
| --- | --- | --- | --- |
| `GET` | `/tasks` | `tasks.index` | `index` |
| `GET` | `/tasks/create` | `tasks.create` | `create` |
| `POST` | `/tasks` | `tasks.store` | `store` |
| `GET` | `/tasks/{task}` | `tasks.show` | `show` |
| `GET` | `/tasks/{task}/edit` | `tasks.edit` | `edit` |
| `PUT/PATCH` | `/tasks/{task}` | `tasks.update` | `update` |
| `DELETE` | `/tasks/{task}` | `tasks.destroy` | `destroy` |

> يجب تسجيل الدخول قبل فتح صفحات المهام. إذا حاول الزائر الوصول إليها، يعيده Laravel تلقائيًا إلى صفحة تسجيل الدخول.

## 🎨 قرارات التصميم

- اتجاه عربي كامل `RTL` وخط `Noto Kufi Arabic`.
- شريط تنقل متجاوب يعمل على الهاتف وسطح المكتب.
- بطاقات إحصائية في صفحة القائمة لإجمالي المهام وحالاتها.
- شبكة بطاقات مرنة تتغير بحسب حجم الشاشة.
- ألوان مستقلة للحالات: الأخضر للمكتملة، والكهرماني لقيد التنفيذ.
- رسائل نجاح وأخطاء واضحة وقابلة للوصول.
- حالة فارغة تشجّع المستخدم على إنشاء أول مهمة.
- نافذة تأكيد قبل الحذف، مع إبراز الإجراء الخطر باللون الأحمر.
- استخدام `Vite` لبناء Tailwind بدل الاعتماد على CDN.

## 🛡️ التحقق والحماية

- `StoreTaskRequest` مسؤول عن التحقق عند الإنشاء.
- `UpdateTaskRequest` مسؤول عن التحقق عند التعديل.
- العنوان إلزامي، وطوله بين 3 و255 حرفًا.
- الوصف اختياري، وبحد أقصى 1000 حرف.
- حالة الإنجاز قيمة منطقية، ويرسل النموذج القيمة `0` حتى عند إلغاء تحديد صندوق الاختيار.
- حُوّل عمود `description` إلى النوع `TEXT` عبر Migration حتى يتوافق فعليًا مع حد 1000 حرف.
- يحمي `@csrf` جميع النماذج التي تغيّر البيانات.
- يوفر `Route Model Binding` استجابة `404` تلقائية عند طلب مهمة غير موجودة.
- تتطلب المسارات مستخدمًا مسجلًا ومتحققًا منه.

## 🔄 تدفق طلب إدارة المهام

```text
المتصفح ← المسار ← المتحكم ← النموذج ← قاعدة البيانات
   ↑                                      ↓
   └──────────── واجهة Blade ─────────────┘
```

عند الإنشاء مثلًا، يرسل النموذج طلب `POST` إلى `tasks.store`. يتحقق `StoreTaskRequest` من البيانات أولًا، ثم يحفظ `TaskController` السجل، ويعيد المستخدم إلى صفحة التفاصيل `tasks.show` مع رسالة نجاح. وعند التعديل يحدث التدفق نفسه عبر `PUT/PATCH` و`UpdateTaskRequest`.

## 🤝 المساهمة

1. أنشئ فرعًا جديدًا: `git checkout -b feature/اسم-الميزة`.
2. نفّذ التغيير وأضف الاختبارات المناسبة.
3. شغّل الاختبارات ومنسق الشفرة.
4. أنشئ التزامًا برسالة واضحة، ثم ارفع الفرع وافتح `Pull Request`.

---

# 🎓 الدليل العملي للمحاضرة الثانية

## هندسة البرمجيات — المستوى الرابع (تقنية معلومات)

### 🧩 معمارية الويب، نمط MVC، وبناء ميزة CRUD كاملة باستخدام Laravel

> ⏱️ **مدة المحاضرة:** 90 دقيقة | 🎯 **الأسلوب:** شرح مركّز وتطبيق جماعي فوري
> 📌 **نطاق المحاضرة:** الفهم العميق والتطبيق العملي الكامل. موضوعا `SOLID` و`Dependency Injection` مخصصان لمحاضرات قادمة.

---

## 🧠 أولاً: كيف يعمل الويب فعليًا؟ (Client ↔ Server)

تخيّلوا معي المشهد التالي:

أنتم جالسون في **مطعم** 🍽️. أنتم لا تدخلون المطبخ وتطبخون بأنفسكم، ولا الطاهي يخرج ليسألكم ماذا تريدون مباشرة من غرفة التحضير. بينكما **نظام واضح للتواصل**:

| في المطعم             | في الويب                                                 |
| --------------------- | -------------------------------------------------------- |
| أنتم (الزبون)         | **العميل (Client)** — المتصفح الذي يستخدمه المستخدم      |
| المطبخ                | **الخادم (Server)** — الجهاز الذي يشغّل تطبيق Laravel     |
| طلب الزبون للنادل     | **HTTP Request** — طلب يُرسله المتصفح                     |
| الطبق الذي يعود إليكم | **HTTP Response** — الصفحة أو البيانات التي تعود للمتصفح |

🔑 **الفكرة الجوهرية:** العميل **لا يعرف** كيف يُحضَّر الطلب، وهذا هو جمال الفصل بين الطرفين — كل طرف مسؤول عن جزئه فقط.

---

## 🧭 ثانيًا: نمط MVC — تشبيه المطعم الكامل

MVC ليس تعقيدًا، بل هو **تقسيم أدوار ذكي** حتى لا يقوم شخص واحد بكل شيء:

| الدور في المطعم    | المكوّن البرمجي   | المسؤولية                                                          |
| ------------------ | ---------------- | ------------------------------------------------------------------ |
| 👨‍💼 **مدير الصالة**  | **Controller**   | يستقبل الطلب (Request)، يقرر ماذا يحتاج، وينسّق بين البيانات والعرض |
| 📦 **أمين المخزن**  | **Model**        | يتحدث مباشرة مع قاعدة البيانات: يجلب، يحفظ، يحدّث، يحذف             |
| 🎨 **خبير التنسيق** | **View (Blade)** | يأخذ البيانات الجاهزة ويحوّلها إلى صفحة HTML أنيقة                  |

**تسلسل الأحداث الكامل:**

```
1️⃣ المستخدم يطلب صفحة أو يرسل نموذجًا
2️⃣ Route يوجّه الطلب إلى الدالة الصحيحة في Controller
3️⃣ Controller يطلب/يعدّل البيانات عبر Model
4️⃣ Model يتعامل مع قاعدة البيانات ويُرجع النتيجة
5️⃣ Controller يمرر النتيجة إلى View
6️⃣ View يبني HTML أنيقًا ويعيده للمستخدم
```

> 💡 **لماذا هذا الفصل مهم؟** لو أردنا تغيير الشكل، نعدّل الـ View فقط. ولو أردنا تغيير منطق الحفظ، نعدّل الـ Controller أو الـ Model. **كل طرف مستقل ومتخصص.**

---

## 🎨 ثالثًا: لماذا نستخدم Tailwind CSS بالتحديد؟

هذا سؤال يستحق وقفة، لأن الطلاب غالبًا اعتادوا كتابة CSS بالطريقة التقليدية. إليكم المقارنة:

| الجانب                | ✍️ CSS تقليدي                              | ⚡ Tailwind CSS                                                               |
| --------------------- | ----------------------------------------- | ---------------------------------------------------------------------------- |
| **مكان الكتابة**      | ملف `.css` منفصل، تبديل مستمر بين ملفين   | مباشرة داخل وسم HTML كـ class                                                |
| **تسمية الأصناف**     | عليك اختراع اسم مثل `.task-card-title`    | أصناف جاهزة مثل `p-4 text-lg bg-blue-600`                                    |
| **الاتساق البصري**    | يعتمد على انضباط كل مطور بمفرده           | نظام تصميم موحّد (مقاييس تباعد وألوان ثابتة للمشروع كله)                      |
| **سرعة البناء**       | أبطأ، خصوصًا في مرحلة التعلّم               | أسرع بكثير لبناء واجهات أولية (Prototyping)                                  |
| **حجم الملف النهائي** | يكبر تدريجيًا وقد يمتلئ بقواعد غير مستخدمة | في الإنتاج الحقيقي (build خاص) يبقى صغيرًا جدًا لأنه يولّد فقط ما تستخدمه فعليًا |

🎯 **لماذا هو مثالي لكم في هذه المرحلة تحديدًا؟**
لأن هدفكم الأساسي الآن هو فهم منطق Laravel وMVC، وليس إتقان تصميم CSS من الصفر. تنسيق مباشر بجانب الكود يقلل "تبديل السياق" الذهني بين ملفات متعددة، ويجعلكم ترون النتيجة فورًا.

> 📌 **التطبيق الحالي لا يستخدم CDN.** تُثبت حزم Tailwind بواسطة `npm`، ويحمّل التخطيط الملفات عبر `@vite(['resources/css/app.css', 'resources/js/app.js'])`. استخدم `npm run dev` أثناء التطوير و`npm run build` لإنشاء ملفات الإنتاج.

---

## ⚙️ رابعًا: خريطة أوامر Artisan التي سنستخدمها اليوم

قبل أن نغرق في التفاصيل، إليكم جدول مرجعي بكل الأوامر التي سنستخدمها، حتى تفهموا **متى ولماذا** نستدعي كل واحد منها:

| الأمر                                               | الغرض منه                                                                                     |
| --------------------------------------------------- | --------------------------------------------------------------------------------------------- |
| `php artisan make:model Task -m`                    | إنشاء Model باسم Task + ملف Migration مرافق دفعة واحدة                                        |
| `php artisan make:controller TaskController`        | إنشاء ملف Controller فارغ نكتب داخله المنطق                                                   |
| `php artisan make:request StoreTaskRequest`         | إنشاء فئة Form Request مخصصة للتحقق عند **الإضافة**                                           |
| `php artisan make:request UpdateTaskRequest`        | إنشاء فئة Form Request مخصصة للتحقق عند **التعديل**                                           |
| `php artisan make:factory TaskFactory --model=Task` | إنشاء مصنع لتوليد بيانات وهمية واقعية للاختبار                                                |
| `php artisan make:seeder TaskSeeder`                | إنشاء بذرة (Seeder) لتعبئة قاعدة البيانات تلقائيًا                                             |
| `php artisan migrate`                               | تنفيذ ملفات الـ Migration وإنشاء الجداول فعليًا في قاعدة البيانات                              |
| `php artisan migrate:fresh --seed`                  | حذف كل الجداول، إعادة إنشائها من الصفر، ثم تعبئتها ببيانات تجريبية تلقائيًا                    |
| `php artisan route:list`                            | عرض جميع المسارات المسجّلة في المشروع — أداة تصحيح ممتازة عند الحيرة                           |
| `php artisan tinker`                                | فتح واجهة سطر أوامر تفاعلية للتعامل المباشر مع الـ Models وقاعدة البيانات دون كتابة كود واجهة |

> 💡 **نصيحة ذهبية:** إذا شعرتم يومًا أن مسارًا معينًا "لا يعمل"، أول شيء نفّذوه هو `php artisan route:list` لتتأكدوا أنه مسجّل فعلًا بالاسم والطريقة الصحيحة.

---

## 🛣️ خامسًا: المسارات (Routes) — شرح متعمّق

### الأفعال (HTTP Verbs) التي سنحتاجها لعملية CRUD كاملة

CRUD تعني: **C**reate (إنشاء) - **R**ead (قراءة) - **U**pdate (تحديث) - **D**elete (حذف). كل عملية منها ترتبط بفعل HTTP محدد:

| الفعل (Verb)    | يُستخدم لـ                                  |
| --------------- | ------------------------------------------ |
| `GET`           | طلب **عرض** بيانات فقط (بلا تعديل)         |
| `POST`          | إرسال بيانات **جديدة** ليتم إنشاؤها        |
| `PUT` / `PATCH` | إرسال بيانات لـ **تحديث** مورد موجود مسبقًا |
| `DELETE`        | طلب **حذف** مورد موجود                     |

⚠️ **حالة حافة مهمة جدًا:** نماذج HTML (`<form>`) تدعم فعليًا فعلين فقط هما `GET` و `POST`! فكيف نرسل طلب `PUT` أو `DELETE` إذن؟ الحل هو توجيه Blade يُسمى `@method(...)` سنشرحه بالتفصيل في قسم Blade أدناه — فهو "يتنكّر" بفعل POST ليجعل Laravel يفهمه كـ PUT أو DELETE.

### تعريف المسارات الحالية

في `routes/web.php`:

```php
use App\Http\Controllers\TaskController;

/**
 * مسارات إدارة المهام السبعة وفق نمط RESTful.
 * ينشئ هذا التعريف صفحات القائمة والإنشاء والعرض والتعديل،
 * بالإضافة إلى عمليات الحفظ والتحديث والحذف.
 */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('tasks', TaskController::class);
});
```

📝 **شرح كل جزء:**
- **`Route::resource`**: ينشئ المسارات السبعة القياسية لعملية CRUD بسطر واحد.
- **`auth`**: يمنع الزائر غير المسجل من الوصول إلى إدارة المهام.
- **`verified`**: يضيف شرط التحقق من البريد للتطبيقات التي تفعّل هذه الميزة.
- **أسماء المسارات**: بدل كتابة `/tasks` يدويًا، نستخدم مثلًا `route('tasks.index')` و`route('tasks.show', $task)`.
- **`{task}` بين قوسين**: هذا **معامل المسار (Route Parameter)**. يمثل رقم تعريف (id) مهمة محددة داخل الرابط، مثل `/tasks/5/edit`.

### 🔗 ربط النموذج التلقائي (Route Model Binding)

هذه نقطة سحرية في Laravel: عندما نكتب `{task}` في المسار، ونكتب `Task $task` كمعامل في دالة الـ Controller، فإن Laravel **تلقائيًا**:
1. يأخذ الرقم من الرابط (مثل `5`)
2. يبحث في قاعدة البيانات عن المهمة بهذا المعرف
3. يمرر لكم **الكائن (Object) الجاهز** مباشرة، بدل أن تكتبوا أنتم يدويًا `Task::find($id)` أو `Task::findOrFail($id)`

```php
public function edit(Task $task) // ← $task هنا جاهز فعليًا، لم نكتب أي استعلام!
{
    return view('tasks.edit', compact('task'));
}
```

⚠️ **حالة حافة تلقائية مجانية:** إذا كتب المستخدم رابطًا لمهمة غير موجودة (مثل `/tasks/9999/edit`)، فإن Laravel يُرجع تلقائيًا صفحة خطأ **404** دون أن تكتبوا سطرًا واحدًا من الكود للتحقق!

### ⚡ المسارات التي ينشئها Route::resource

بدل كتابة كل الأسطر السابقة يدويًا، يوفر Laravel اختصارًا واحدًا يُنشئ كل مسارات CRUD السبعة دفعة واحدة:

```php
Route::resource('tasks', TaskController::class);
```

هذا السطر الوحيد يُكافئ الجدول التالي بالكامل:

| الفعل     | الرابط               | الدالة في Controller | اسم المسار      | الغرض                   |
| --------- | -------------------- | -------------------- | --------------- | ----------------------- |
| GET       | `/tasks`             | `index`              | `tasks.index`   | عرض كل المهام           |
| GET       | `/tasks/create`      | `create`             | `tasks.create`  | عرض نموذج إضافة مهمة    |
| POST      | `/tasks`             | `store`              | `tasks.store`   | حفظ مهمة جديدة          |
| GET       | `/tasks/{task}`      | `show`               | `tasks.show`    | عرض مهمة واحدة بالتفصيل |
| GET       | `/tasks/{task}/edit` | `edit`               | `tasks.edit`    | عرض نموذج تعديل مهمة    |
| PUT/PATCH | `/tasks/{task}`      | `update`             | `tasks.update`  | تحديث مهمة موجودة       |
| DELETE    | `/tasks/{task}`      | `destroy`            | `tasks.destroy` | حذف مهمة                |

> 📌 التطبيق الحالي يستخدم المسارات السبعة كاملة. لذلك أصبح لكل من `create` و`show` صفحة مستقلة، بينما بقيت عمليات `store` و`update` و`destroy` مسؤولة عن تغيير البيانات ثم إعادة التوجيه.

---

## 🗄️ سادسًا: قاعدة البيانات والنموذج (Migration & Model)

```bash
php artisan make:model Task -m
```

**📄 ملف الـ Migration:**

```php
public function up(): void
{
    Schema::create('tasks', function (Blueprint $table) {
        $table->id();                                   // المعرّف الفريد لكل مهمة
        $table->string('title');                         // عنوان المهمة (نص قصير - إلزامي)
        $table->text('description')->nullable();         // وصف تفصيلي (نص طويل - اختياري)
        $table->boolean('is_completed')->default(false); // هل أُنجزت المهمة؟ (افتراضيًا: لا)
        $table->timestamps();                            // created_at و updated_at تلقائيًا
    });
}
```

**📄 ملف النموذج** (`app/Models/Task.php`):

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'is_completed'];

    protected function casts(): array
    {
        return [
            'is_completed' => 'boolean',
        ];
    }
}
```

⚠️ **ملاحظة أمنية:** `$fillable` تحدد الحقول المسموح تعبئتها تلقائيًا عبر `create()` أو `update()`، لمنع مستخدم خبيث من التلاعب بحقول لم نقصد كشفها.

تحول `casts()` قيمة `is_completed` القادمة من قاعدة البيانات إلى قيمة منطقية حقيقية. كما يضم المشروع Migration باسم `change_description_to_text_on_tasks_table` يحول الوصف من `VARCHAR` إلى `TEXT`، لأن قواعد التحقق تسمح بوصف يصل إلى 1000 حرف.

```bash
php artisan migrate
```

---

## ✅ سابعًا: التحقق من البيانات (Validation) — من الطريقة اليدوية إلى Form Requests

### 🔹 المرحلة الأولى: التحقق مباشرة داخل الـ Controller (الطريقة الأساسية)

نبدأ بالطريقة الأبسط لفهم المبدأ أولًا، قبل أن ننتقل لطريقة أكثر احترافية:

```php
public function store(Request $request)
{
    // ✅ التحقق يتم مباشرة هنا داخل الدالة
    $validated = $request->validate([
        'title'       => 'required|string|min:3|max:255',
        'description' => 'nullable|string|max:1000',
    ]);

    Task::create($validated);

    return redirect()->route('tasks.index')->with('success', 'تمت إضافة المهمة بنجاح! ✅');
}
```

🛡️ **لماذا هذه القواعد بالتحديد؟ (حالات الحافة التي عالجناها):**

| القاعدة              | حالة الحافة التي تمنعها                      |
| -------------------- | -------------------------------------------- |
| `required`           | مستخدم يضغط "إضافة" بحقل عنوان فارغ تمامًا    |
| `min:3`              | عنوان بحرف واحد لا معنى له مثل "أ"           |
| `max:255`            | مستخدم يلصق نصًا ضخمًا جدًا في حقل العنوان      |
| `nullable` على الوصف | السماح بترك الوصف فارغًا دون رفض الطلب        |
| `max:1000` على الوصف | منع نص وصف مبالغ في طوله يثقل قاعدة البيانات |

### 🤔 المشكلة: ماذا لو احتجنا نفس التحقق في أكثر من دالة؟

لاحظوا أننا سنحتاج قواعد شبيهة جدًا في دالة `update` أيضًا. لو كررنا نفس الأسطر في كل دالة، سيصبح الـ Controller مزدحمًا وصعب الصيانة (لو أردنا تعديل قاعدة واحدة، سنحتاج تذكّر كل الأماكن التي كررناها فيها). هنا يأتي الحل الاحترافي 👇

### 🔹 المرحلة الثانية: نقل التحقق إلى Form Request مخصص

```bash
php artisan make:request StoreTaskRequest
php artisan make:request UpdateTaskRequest
```

**📄 ملف `app/Http/Requests/StoreTaskRequest.php`:**

```php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // هل يُسمح لهذا المستخدم بتنفيذ هذا الطلب؟ (نتركها true الآن)
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|max:1000',
            'is_completed' => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'يرجى كتابة عنوان المهمة.',
            'title.min' => 'يجب ألا يقل عنوان المهمة عن 3 أحرف.',
            'description.max' => 'يجب ألا يزيد وصف المهمة على 1000 حرف.',
        ];
    }
}
```

**📄 ملف `app/Http/Requests/UpdateTaskRequest.php`:**

```php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|max:1000',
            'is_completed' => 'sometimes|boolean',
        ];
    }
}
```

✨ **الفرق الجوهري بعد الانتقال إلى Form Request:**

| قبل (Request عادي)                                  | بعد (Form Request مخصص)                                     |
| --------------------------------------------------- | ----------------------------------------------------------- |
| `public function store(Request $request)`           | `public function store(StoreTaskRequest $request)`          |
| نكتب `$request->validate([...])` يدويًا داخل كل دالة | التحقق يحدث **تلقائيًا** قبل حتى دخول الكود إلى داخل الدالة! |
| القواعد مبعثرة ومكررة في أماكن متعددة               | القواعد في **مكان واحد منظم** قابل لإعادة الاستخدام         |
| Controller مزدحم بالتفاصيل                          | Controller نظيف يركّز فقط على منطق الحفظ/التحديث             |

> 🎯 **الخلاصة:** Form Request ليس ميزة إضافية للتباهي، بل هو تطبيق عملي لمبدأ هندسي أساسي: **فصل الاهتمامات (Separation of Concerns)** — التحقق شيء، ومنطق الحفظ شيء آخر.

يحتوي الملفان الفعليان أيضًا على `attributes()` و`messages()` لتقديم أسماء حقول ورسائل عربية مفهومة. فالمستخدم يرى مثلًا «يرجى كتابة عنوان المهمة» بدل رسالة تحقق إنجليزية عامة.

---

## 🎮 ثامنًا: المتحكم الكامل (Controller) — عملية CRUD كاملة

```bash
php artisan make:controller TaskController
```

**📄 المتحكم الحالي** (`app/Http/Controllers/TaskController.php`) يستخدم أنواع إرجاع صريحة، و`Form Requests`، وترقيم النتائج:

```php
namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    /**
     * عرض قائمة المهام مع ملخص لحالاتها.
     */
    public function index(): View
    {
        $tasks = Task::query()
            ->latest()
            ->paginate(9);

        $tasksCount = Task::query()->count();
        $completedTasksCount = Task::query()->where('is_completed', true)->count();
        $pendingTasksCount = $tasksCount - $completedTasksCount;

        return view('tasks.index', compact(
            'tasks',
            'tasksCount',
            'completedTasksCount',
            'pendingTasksCount',
        ));
    }

    /**
     * عرض نموذج إنشاء مهمة جديدة.
     */
    public function create(): View
    {
        return view('tasks.create');
    }

    /**
     * التحقق من بيانات المهمة الجديدة ثم حفظها.
     */
    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $task = Task::query()->create([
            ...$request->safe()->only(['title', 'description']),
            'is_completed' => $request->boolean('is_completed'),
        ]);

        return redirect()
            ->route('tasks.show', $task)
            ->with('success', 'تم إنشاء المهمة بنجاح.');
    }

    /**
     * عرض تفاصيل مهمة واحدة عبر ربط النموذج التلقائي.
     */
    public function show(Task $task): View
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * عرض نموذج تعديل المهمة المحددة.
     */
    public function edit(Task $task): View
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * التحقق من البيانات الجديدة ثم تحديث المهمة.
     */
    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $task->update([
            ...$request->safe()->only(['title', 'description']),
            'is_completed' => $request->boolean('is_completed'),
        ]);

        return redirect()
            ->route('tasks.show', $task)
            ->with('success', 'تم تحديث المهمة بنجاح.');
    }

    /**
     * حذف المهمة ثم العودة إلى قائمة المهام.
     */
    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'تم حذف المهمة بنجاح.');
    }
}
```

### شرح مسؤوليات الدوال

| الدالة | المسؤولية |
| --- | --- |
| `index()` | يجلب أحدث المهام في صفحات من 9 سجلات، ويحسب إحصاءات الحالات |
| `create()` | يعرض صفحة إنشاء مهمة جديدة |
| `store()` | يتحقق من البيانات ويحفظ المهمة ثم يفتح صفحة تفاصيلها |
| `show()` | يعرض مهمة واحدة باستخدام `Route Model Binding` |
| `edit()` | يعرض نموذج التعديل مع القيم الحالية |
| `update()` | يحفظ التغييرات ويعيد المستخدم إلى صفحة التفاصيل |
| `destroy()` | يحذف المهمة ويعيد المستخدم إلى القائمة |

📝 **نقاط مهمة:**

- تسمح `$request->safe()->only(...)` بتمرير الحقول التي تم التحقق منها فقط.
- تحول `$request->boolean('is_completed')` قيم صندوق الاختيار إلى `true` أو `false` بصورة آمنة.
- تعلن `View` و`RedirectResponse` بوضوح ما تعيده كل دالة.
- تعيد عمليتا الإنشاء والتعديل المستخدم إلى `tasks.show` حتى يرى النتيجة مباشرة.
- تستخدم تعليقات `PHPDoc` العربية لشرح مسؤولية كل دالة من دون ازدحام المنطق بتعليقات داخلية.

---

## 🌱 تاسعًا: بيانات تجريبية — Factories و Seeders

عند تطوير ميزة جديدة، من غير العملي أن تُضيفوا 15 مهمة يدويًا من الواجهة فقط لتختبروا شكل القائمة. هنا تأتي فائدة **Factories** و **Seeders**.

### 🏭 Factory: مصنع بيانات وهمية واقعية

```bash
php artisan make:factory TaskFactory --model=Task
```

**📄 ملف `database/factories/TaskFactory.php`:**

```php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'        => $this->faker->sentence(4),      // جملة عشوائية من 4 كلمات
            'description'  => $this->faker->paragraph(),       // فقرة عشوائية واقعية
            'is_completed' => $this->faker->boolean(30),        // احتمال 30% أن تكون "مكتملة"
        ];
    }
}
```

📝 **ما هو `faker`؟** مكتبة مدمجة في Laravel تولّد بيانات وهمية لكنها **تبدو حقيقية** (جمل، أسماء، تواريخ، أرقام...) دون أن تكتبوها يدويًا حرفًا بحرف.

### 🌱 Seeder: بذرة لتعبئة قاعدة البيانات تلقائيًا

```bash
php artisan make:seeder TaskSeeder
```

**📄 ملف `database/seeders/TaskSeeder.php`:**

```php
namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        Task::factory()->count(15)->create(); // يولّد 15 مهمة وهمية دفعة واحدة
    }
}
```

ثم نُسجّله في `database/seeders/DatabaseSeeder.php` حتى يُنفَّذ تلقائيًا:

```php
public function run(): void
{
    $this->call([
        TaskSeeder::class,
    ]);
}
```

وأخيرًا، لتنفيذ كل شيء دفعة واحدة (حذف الجداول القديمة + إعادة إنشائها + تعبئتها ببيانات جاهزة):

```bash
php artisan migrate:fresh --seed
```

> 🎯 **لماذا هذا مهم هندسيًا؟** لأنه يفصل "بيانات الاختبار" عن "منطق التطبيق"، ويجعل أي زميل جديد في الفريق قادرًا على تشغيل أمر واحد فقط والحصول على بيئة عمل مليئة ببيانات واقعية جاهزة للتجربة، دون انتظار أو إدخال يدوي.

---

## 🎨 عاشرًا: واجهات Blade الأربع والتصميم الحديث

يعتمد التطبيق على تخطيط عربي موحد بدل تكرار بنية HTML في كل صفحة:

```text
layouts/app.blade.php
        │
        ├── layouts/navigation.blade.php
        │
        └── tasks/
            ├── index.blade.php
            ├── create.blade.php
            ├── show.blade.php
            ├── edit.blade.php
            └── partials/form.blade.php
```

يحدد `app.blade.php` اللغة العربية والاتجاه `RTL`، ويحمّل خط `Noto Kufi Arabic` وملفات Vite، ثم يضمّن شريط التنقل والمحتوى الخاص بكل صفحة.

### توجيهات Blade المستخدمة

| التوجيه | الاستخدام في المشروع |
| --- | --- |
| `<x-app-layout>` | تطبيق التخطيط وشريط التنقل على الصفحة |
| `<x-slot name="header">` | تعريف عنوان الصفحة وأزرارها العلوية |
| `@include(...)` | إعادة استخدام نموذج المهمة في الإنشاء والتعديل |
| `@csrf` | حماية نماذج الإنشاء والتعديل والحذف |
| `@method('PUT')` | إرسال طلب التعديل بالطريقة التي يتوقعها Laravel |
| `@method('DELETE')` | إرسال طلب حذف المهمة |
| `@error('field')` | عرض رسالة التحقق العربية بجانب الحقل |
| `@checked(...)` | تحديد صندوق حالة الإنجاز بحسب القيمة القديمة أو الحالية |
| `old('field', $value)` | الاحتفاظ بإدخال المستخدم عند فشل التحقق |
| `@if / @foreach` | عرض الحالات والمهام والرسائل بصورة شرطية |
| `route('name', $task)` | إنشاء الروابط اعتمادًا على أسماء المسارات |
| `session('success')` | عرض رسالة نجاح مؤقتة بعد العملية |

### 1. صفحة القائمة — `index.blade.php`

هذه هي لوحة العمل الرئيسية، وتحتوي على:

- زر واضح للانتقال إلى صفحة إنشاء المهمة.
- ثلاث بطاقات لإجمالي المهام والمكتملة وقيد التنفيذ.
- شبكة متجاوبة من بطاقات المهام.
- شارة ملوّنة توضح حالة كل مهمة.
- روابط العرض والتعديل، ونموذج مستقل للحذف.
- ترقيم للنتائج ناتج عن `paginate(9)`.
- حالة فارغة تظهر عندما لا توجد مهام.

يعرض المتحكم البيانات التي تحتاجها الصفحة كما يلي:

```php
$tasks = Task::query()
    ->latest()
    ->paginate(9);

$tasksCount = Task::query()->count();
$completedTasksCount = Task::query()->where('is_completed', true)->count();
$pendingTasksCount = $tasksCount - $completedTasksCount;
```

### 2. صفحة الإنشاء — `create.blade.php`

تقدم نموذجًا مستقلًا لإنشاء المهمة، مع إرشادات قصيرة للمستخدم. لا يحتوي الملف على نسخة مكررة من الحقول؛ بل يستدعي النموذج المشترك:

```blade
@include('tasks.partials.form', [
    'task' => null,
    'action' => route('tasks.store'),
    'method' => 'POST',
    'submitLabel' => 'إنشاء المهمة',
    'cancelUrl' => route('tasks.index'),
])
```

### 3. صفحة التفاصيل — `show.blade.php`

تعرض الصفحة:

- عنوان المهمة ورقمها.
- حالة المهمة بلون واضح.
- الوصف كاملًا مع المحافظة على فواصل الأسطر.
- تاريخ الإنشاء وآخر تحديث.
- زر الانتقال إلى التعديل.
- منطقة حذف منفصلة مع تحذير وتأكيد قبل التنفيذ.
- رسالة نجاح بعد الإنشاء أو التعديل.

### 4. صفحة التعديل — `edit.blade.php`

تعيد استخدام النموذج نفسه، لكنها تمرر المهمة الحالية ومسار التحديث:

```blade
@include('tasks.partials.form', [
    'task' => $task,
    'action' => route('tasks.update', $task),
    'method' => 'PUT',
    'submitLabel' => 'حفظ التعديلات',
    'cancelUrl' => route('tasks.show', $task),
])
```

### النموذج المشترك — `partials/form.blade.php`

يمنع هذا الملف تكرار حقول العنوان والوصف والحالة. ويعالج حالة مهمة في صناديق الاختيار: يرسل حقلًا مخفيًا بالقيمة `0` ثم يرسل `1` إذا اختار المستخدم حالة الإنجاز.

```blade
<input type="hidden" name="is_completed" value="0">

<input
    id="is_completed"
    name="is_completed"
    type="checkbox"
    value="1"
    @checked(old('is_completed', $task?->is_completed ?? false))
>
```

بهذه الطريقة تصل قيمة صريحة إلى الخادم سواء كان الصندوق محددًا أم لا، ثم تحولها `$request->boolean('is_completed')` إلى قيمة منطقية صحيحة.

### خصائص تجربة الاستخدام

- تصميم متجاوب يبدأ من الهاتف ويعمل حتى الشاشات الكبيرة.
- تسلسل بصري واضح للعناوين والمحتوى والإجراءات.
- حالات `hover` و`focus` للأزرار والحقول.
- أسماء وصول `aria-label` للأزرار التي تعتمد على الأيقونات.
- رسائل نجاح تحمل `role="status"` ورسائل أخطاء واضحة.
- تأكيد JavaScript قبل الحذف لمنع الحذف العرضي.
- تمييز الإجراء الأساسي والإجراء الخطر بألوان مختلفة.

---


## 👥 حادي عشر: النشاط العملي الجماعي (للفرق)

الآن دور فريقكم! نفّذوا الخطوات التالية **بالترتيب** على مشروعكم الفعلي، وطبّقوا عملية CRUD **كاملة** (إضافة + عرض + تعديل + حذف) على الميزة الخاصة بمشروعكم:

| #   | الخطوة                        | التفصيل                                                                                                 |
| --- | ----------------------------- | ------------------------------------------------------------------------------------------------------- |
| 1️⃣   | **افتحوا Kanban Board**       | اذهبوا إلى تبويب Projects في مستودع GitHub الخاص بفريقكم                                                |
| 2️⃣   | **اسحبوا Issue**              | اختاروا Issue من عمود "To Do" يخص ميزة مشابهة (مثال: تصنيفات، تعليقات، ملاحظات...)                      |
| 3️⃣   | **انقلوه إلى "In Progress"**  | وعيّنوا (Assign) الـ Issue لأنفسكم كفريق                                                                 |
| 4️⃣   | **أنشئوا فرعًا جديدًا**         | `git checkout -b feature/اسم-الميزة`                                                                    |
| 5️⃣   | **طبّقوا CRUD كاملة عبر MVC**  | Migration ← Model ← Routes ← Form Requests ← Controller (index/create/store/show/edit/update/destroy) ← Blade Views |
| 6️⃣   | **استخدموا Factory و Seeder** | لتوليد بيانات تجريبية بدل الإدخال اليدوي المتكرر                                                        |
| 7️⃣   | **احفظوا عملكم**              | `git add .` ثم `git commit -m "رسالة واضحة"` ثم `git push origin feature/اسم-الميزة`                    |
| 8️⃣   | **افتحوا Pull Request**       | اربطوه بالـ Issue، واطلبوا من زميل مراجعة الكود (Code Review) قبل الدمج                                 |
| 9️⃣   | **أغلقوا الدورة**             | بعد الموافقة والدمج (Merge)، انقلوا الـ Issue إلى عمود "Done"                                           |

---

## 🤖 ثاني عشر: توثيق الذكاء الاصطناعي والمراجعة النهائية

### 📝 نموذج `AI_Log.md`

```markdown
# سجل استخدام الذكاء الاصطناعي - AI Log

## الأداة المستخدمة: [مثال: ChatGPT / Claude / Copilot]
## التاريخ: [التاريخ]

### الطلب (Prompt) الذي استُخدم:
"..."

### الغرض من الاستخدام:
[مثال: طلبت اقتراح تنسيق Tailwind لبطاقة عرض المهمة]

### التعديلات التي أجريتها على المخرجات:
[صف أي تغييرات أجريتها على الكود المُقترح ولماذا]

### الدرس المستفاد:
[ما الذي فهمتَه بشكل أعمق بعد هذا الاستخدام؟]
```

### ✅ قائمة التحقق النهائية الموسّعة للفريق

قبل تسليم الـ Pull Request، تأكدوا من:

**قاعدة البيانات والنموذج**
- [ ] تم إنشاء وتنفيذ الـ Migration بنجاح (`php artisan migrate`)
- [ ] الـ Model يحتوي على `$fillable` صحيحة وآمنة، ويستخدم `HasFactory`

**المسارات**
- [ ] المسارات السبعة معرّفة (index, create, store, show, edit, update, destroy) بأسماء واضحة
- [ ] مسارات المهام محمية بواسطة `auth` و`verified`
- [ ] تم التحقق من المسارات عبر `php artisan route:list`

**التحقق والمتحكم**
- [ ] تم إنشاء `StoreRequest` و `UpdateRequest` مخصصين بدل التحقق اليدوي المتكرر
- [ ] قواعد التحقق تغطي حالات الحافة (فارغ، طويل جدًا، صندوق اختيار غير مُفعّل)
- [ ] الـ Controller نظيف ولا يحتوي على تكرار في قواعد التحقق

**البيانات التجريبية**
- [ ] تم إنشاء Factory وSeeder، وتجربة `php artisan migrate:fresh --seed`

**الواجهة (Blade)**
- [ ] صفحات القائمة والإنشاء والعرض والتعديل تعمل فعليًا
- [ ] نموذج الإنشاء والتعديل موجود في Partial مشترك لتجنب التكرار
- [ ] التصميم متجاوب ويعمل باتجاه `RTL`
- [ ] عمليات الإضافة، العرض، التعديل، والحذف تعمل من الواجهة
- [ ] تم اختبار إرسال نموذج فارغ والتأكد من ظهور رسائل الخطأ بجانب الحقول
- [ ] رسالة تأكيد تظهر قبل الحذف (`confirm()`)
- [ ] رسائل النجاح تظهر بعد كل عملية (إضافة/تعديل/حذف)

**الاختبارات والجودة**
- [ ] اختبارات `TaskManagementTest` تغطي الصفحات ودورة CRUD
- [ ] تم تشغيل `php artisan test --compact`
- [ ] تم تشغيل `vendor/bin/pint --dirty --format agent`
- [ ] نجح بناء الواجهة عبر `npm run build`

**دورة العمل الهندسية**
- [ ] تم إنشاء Branch منفصل خاص بالميزة
- [ ] الـ Commits ذات رسائل واضحة ومفهومة
- [ ] تم فتح Pull Request وربطه بالـ Issue المعني
- [ ] تم تحديث `AI_Log.md` إن استُخدم الذكاء الاصطناعي
- [ ] تم نقل الـ Issue إلى العمود الصحيح على Kanban Board

---

### 🎉 خلاصة المحاضرة

اليوم لم نكتفِ بـ "الإضافة والعرض"، بل أكملنا الصورة الهندسية الكاملة: **CRUD كامل**، فهم عميق لكل توجيه Blade نكتبه، تطور طبيعي من التحقق اليدوي إلى Form Requests الاحترافية، وتوليد بيانات تجريبية واقعية عبر Factories وSeeders بدل الإدخال اليدوي المتكرر. هذا هو الأساس الذي سيرافقكم في كل ميزة تبنونها لاحقًا، مهما كبر تعقيدها.

**بالتوفيق للفرق جميعًا! 💪**

</div>
#   I B B D e v 
 
 