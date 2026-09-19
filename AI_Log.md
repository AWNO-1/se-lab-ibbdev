# سجل استخدام الذكاء الاصطناعي — AI Usage Log
# مشروع: منصة IBBDev للأسئلة والأجوبة البرمجية (Lab 5)

> **المقرر:** هندسة البرمجيات — الجانب العملي (2026/2027)  
> **المشروع:** منصة IBBDev البرمجية (Student Q&A Platform)  
> **إشراف:** م. ساهر القائد (الهمداني)  
> **الهدف:** توثيق الاستعانة بأدوات الذكاء الاصطناعي بشفافية كأداة هندسية مساعدة مع الاحتفاظ بالقرار والمراجعة البشرية الكاملة.

---

## Entry 01

### Date
2026-09-19

### Student
AWMO-1 (فريق العمل الهندسي)

### Tool
Antigravity AI / Gemini 3.8 Flash

### Purpose
استشارة الذكاء الاصطناعي في التحقق من المعمارية المتكاملة لمنصة IBBDev (فصل منطق الأعمال في Service Layer، وتطبيق عقود Interfaces، وحماية الصلاحيات عبر Policies، واحتساب نقاط السمعة)، وبناء جناح اختبارات آلية شاملة (Pest Feature Tests) تغطي حالات الحافة (Edge Cases).

### Prompt Summary
طلبنا مراجعة المعمارية لربط `AnswerService` و `QuestionService` و `ReputationService` بالـ Controllers عبر عقود Interfaces، وكيفية صياغة اختبارات آلية تتحقق من منع المستخدم من الإجابة على سؤاله الخاص، ومنع غير صاحب السؤال من اعتماد الإجابة (403 Forbidden عبر AnswerPolicy)، والتأكد من إضافة 10 نقاط سمعة وتسجيلها في جدول `reputation_logs`.

### AI Suggestions
1. **طبقة الخدمات (Service Layer):** فصل المنطق بالكامل خلف عقود `QuestionServiceInterface` و `AnswerServiceInterface` و `ReputationServiceInterface`، وربطها في `AppServiceProvider`.
2. **الصلاحيات (Policies):** تطبيق `AnswerPolicy::accept` للتأكد من أن `auth()->id() === $answer->post->user_id`.
3. **الاختبارات:** كتابة مجموعة اختبارات في `tests/Feature/IbbDevPlatformTest.php` تفحص طرح الأسئلة، الإجابات، حالات الحافة، واحتساب النقاط.
4. **اقتراحات إضافية:** اقتراح إضافة تصويت بنقاط صاعدة وهابطة (Upvote/Downvote)، ونظام تنبيهات لحظية عبر WebSockets/Pusher.

### Accepted Suggestions
- قبول تطبيق معمارية Service Layer + Interfaces لضمان الالتزام بمبدأي Single Responsibility و Dependency Inversion.
- قبول تسجيل الصلاحية عبر `AnswerPolicy` واستدعائها عبر `$this->authorize('accept', $answer)`.
- قبول وتنفيذ اختبارات Pest الستة الشاملة للتحقق من السلوك الفعلي وحالات الحافة.

### Rejected Suggestions
- **نظام التصويت (Upvote/Downvote):** تم الرفض لأنه خارج متطلبات المعمل الخامس المحددة (اعتماد الحل الصحيح + 10 نقاط سمعة فقط).
- **نظام الإشعارات اللحظية عبر WebSockets:** تم الرفض للالتزام بتعليمات الأستاذ الصريحة في دليل المعمل (التركيز على واجهات Blade وتطبيق الـ Service Layer النظيفة دون مكتبات سحابية خارجية).

### Reason for Rejection
الالتزام الحرفي بنطاق المعمل الخامس (Scope) وتجنب التعقيد الزائد (Over-engineering).

### Human Review
قام الطالب بتشغيل اختبارات Pest الآلية بالكامل عبر `php artisan test`، والتأكد من اجتياز جميع الاختبارات الـ 31 (83 تأكيداً / Assertions) بنسبة نجاح 100%، والتأكد من عمل الـ migrations وربط التخزين `storage:link`.
