<x-app-layout>
    {{-- Hero + Search --}}
    <section class="relative overflow-hidden bg-slate-950 text-white">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/20 via-violet-600/20 to-transparent"></div>
        <div class="relative mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
            <div class="max-w-3xl mx-auto text-center">
                <span class="inline-flex rounded-full bg-white/10 px-3 py-1 text-xs font-bold text-indigo-200 ring-1 ring-white/10">مركز المساعدة — 24/7</span>
                <h1 class="mt-4 text-4xl font-black sm:text-5xl">كيف يمكننا مساعدتك؟</h1>
                <p class="mt-4 text-slate-300">ابحث عن إجابات فورية لأكثر الأسئلة شيوعاً حول IBBDev.</p>

                <div class="mt-8 relative max-w-xl mx-auto" x-data="{ q: '' }">
                    <input x-model="q" type="search" placeholder="ابحث مثلاً: كيف أكسب نقاط؟" class="w-full rounded-2xl border-0 bg-white px-5 py-4 pe-12 text-sm text-slate-900 placeholder:text-slate-400 shadow-lg focus:ring-2 focus:ring-indigo-500">
                    <svg class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 size-5 text-slate-400 rtl:left-auto rtl:right-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                </div>

                <div class="mt-6 flex flex-wrap justify-center gap-2 text-xs">
                    <span class="text-slate-400">الأكثر بحثاً:</span>
                    <a href="#reputation" class="rounded-full bg-white/10 px-3 py-1 font-bold text-white hover:bg-white/20 transition">النقاط</a>
                    <a href="#questions" class="rounded-full bg-white/10 px-3 py-1 font-bold text-white hover:bg-white/20 transition">طرح سؤال</a>
                    <a href="#account" class="rounded-full bg-white/10 px-3 py-1 font-bold text-white hover:bg-white/20 transition">إنشاء حساب</a>
                </div>
            </div>
        </div>
    </section>

    {{-- Categories --}}
    <section class="py-8 bg-white border-b border-slate-200 sticky top-0 z-10 backdrop-blur bg-white/80">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-hide" x-data="{ active: 'all' }">
                <button @click="active='all'" :class="active==='all' ? 'bg-slate-900 text-white' : 'bg-white text-slate-700 ring-1 ring-slate-200'" class="shrink-0 rounded-full px-5 py-2 text-sm font-bold transition">الكل</button>
                <button @click="active='account'" :class="active==='account' ? 'bg-slate-900 text-white' : 'bg-white text-slate-700 ring-1 ring-slate-200'" class="shrink-0 rounded-full px-5 py-2 text-sm font-bold transition">الحساب</button>
                <button @click="active='questions'" :class="active==='questions' ? 'bg-slate-900 text-white' : 'bg-white text-slate-700 ring-1 ring-slate-200'" class="shrink-0 rounded-full px-5 py-2 text-sm font-bold transition">الأسئلة</button>
                <button @click="active='reputation'" :class="active==='reputation' ? 'bg-slate-900 text-white' : 'bg-white text-slate-700 ring-1 ring-slate-200'" class="shrink-0 rounded-full px-5 py-2 text-sm font-bold transition">النقاط</button>
                <button @click="active='tech'" :class="active==='tech' ? 'bg-slate-900 text-white' : 'bg-white text-slate-700 ring-1 ring-slate-200'" class="shrink-0 rounded-full px-5 py-2 text-sm font-bold transition">تقني</button>
            </div>
        </div>
    </section>

    <div class="mx-auto max-w-3xl px-4 py-10 sm:px-6 lg:px-8">
        {{-- Quick stats --}}
        <div class="grid grid-cols-3 gap-4 mb-10">
            <div class="rounded-2xl bg-indigo-50 border border-indigo-200 p-4 text-center">
                <p class="text-2xl font-black text-indigo-600">847</p><p class="text-xs font-bold text-slate-700">إجابة مفيدة</p>
            </div>
            <div class="rounded-2xl bg-violet-50 border border-violet-200 p-4 text-center">
                <p class="text-2xl font-black text-violet-600">~3h</p><p class="text-xs font-bold text-slate-700">متوسط الرد</p>
            </div>
            <div class="rounded-2xl bg-emerald-50 border border-emerald-200 p-4 text-center">
                <p class="text-2xl font-black text-emerald-600">92%</p><p class="text-xs font-bold text-slate-700">نسبة الحل</p>
            </div>
        </div>

        <div class="space-y-8" x-data="{ open: null }">
            {{-- Account --}}
            <div id="account">
                <h2 class="text-sm font-black tracking-widest text-indigo-600">الحساب</h2>
                <div class="mt-3 space-y-3">
                    @php
                        $faqsAccount = [
                            ['q'=>'كيف أنشئ حساباً؟','a'=>'اضغط “إنشاء حساب” في الأعلى، أدخل اسمك، بريدك، اسم مستخدم فريد، وكلمة مرور. ستصلك رسالة تفعيل (اختيارية).'],
                            ['q'=>'هل اسم المستخدم يجب أن يكون فريداً؟','a'=>'نعم، حقل username فريد. إذا كان محجوزاً ستظهر لك رسالة ويجب اختيار آخر.'],
                            ['q'=>'كيف أغير صورتي الشخصية (Avatar)؟','a'=>'من الملف الشخصي → تعديل → رفع صورة Avatar. تُحفظ في storage/app/public/avatars وتُعرض عبر asset(storage/...).'],
                            ['q'=>'نسيت كلمة المرور؟','a'=>'من صفحة تسجيل الدخول اضغط “نسيت كلمة المرور” واتبع خطوات إعادة التعيين عبر البريد.'],
                        ];
                    @endphp
                    @foreach($faqsAccount as $i => $f)
                        <div class="rounded-2xl border border-slate-200 bg-white overflow-hidden">
                            <button @click="open === 'a{{ $i }}' ? open=null : open='a{{ $i }}'" class="w-full flex items-center justify-between gap-4 px-5 py-4 text-start hover:bg-slate-50 transition">
                                <span class="font-bold text-slate-900 text-sm">{{ $f['q'] }}</span>
                                <span class="shrink-0 size-8 rounded-full bg-slate-900 text-white flex items-center justify-center transition" :class="open==='a{{ $i }}' ? 'rotate-45' : ''">
                                    <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                </span>
                            </button>
                            <div x-show="open==='a{{ $i }}'" x-transition class="px-5 pb-5">
                                <p class="text-sm leading-6 text-slate-600 border-t border-slate-100 pt-4">{{ $f['a'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Questions --}}
            <div id="questions">
                <h2 class="text-sm font-black tracking-widest text-violet-600">الأسئلة والإجابات</h2>
                <div class="mt-3 space-y-3">
                    @php
                        $faqsQ = [
                            ['q'=>'كيف أطرح سؤالاً مع صورة؟','a'=>'من “سؤال جديد” املأ العنوان (max 255) والوصف (min 10) واختر صورة (image, max 2MB). تُحفظ عبر $request->file(image)->store(questions,public).'],
                            ['q'=>'لماذا لا أستطيع الإجابة على سؤالي؟','a'=>'لضمان الحياد، يمنع النظام الإجابة على سؤالك الخاص. ستظهر رسالة “لا يمكنك الإجابة على سؤالك الخاص”.'],
                            ['q'=>'كيف أعتمد إجابة كحل؟','a'=>'إذا كنت صاحب السؤال، ستجد زر “اعتماد كحل (+10)” تحت كل إجابة غير معتمدة. زر واحد فقط لكل سؤال. سيُمنح صاحب الإجابة 10 نقاط تلقائياً عبر ReputationService.'],
                            ['q'=>'هل يمكنني تعديل سؤالي بعد نشره؟','a'=>'حالياً الإصدار لا يدعم التعديل/الحذف — نعمل على إضافة Policy خاصة للمالك فقط.'],
                        ];
                    @endphp
                    @foreach($faqsQ as $i => $f)
                        <div class="rounded-2xl border border-slate-200 bg-white overflow-hidden">
                            <button @click="open === 'q{{ $i }}' ? open=null : open='q{{ $i }}'" class="w-full flex items-center justify-between gap-4 px-5 py-4 text-start hover:bg-slate-50 transition">
                                <span class="font-bold text-slate-900 text-sm">{{ $f['q'] }}</span>
                                <span class="shrink-0 size-8 rounded-full bg-slate-900 text-white flex items-center justify-center" :class="open==='q{{ $i }}' ? 'rotate-45' : ''">
                                    <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                </span>
                            </button>
                            <div x-show="open==='q{{ $i }}'" x-transition class="px-5 pb-5">
                                <p class="text-sm leading-6 text-slate-600 border-t border-slate-100 pt-4">{{ $f['a'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Reputation --}}
            <div id="reputation">
                <h2 class="text-sm font-black tracking-widest text-emerald-600">النقاط والسمعة</h2>
                <div class="mt-3 space-y-3">
                    @php
                        $faqsR = [
                            ['q'=>'كيف أكسب نقاط السمعة؟','a'=>'تحصل على +10 نقاط عندما يعتمد صاحب السؤال إجابتك عبر ReputationService::awardForAcceptedAnswer() التي تعمل increment على reputation_points.'],
                            ['q'=>'أين أرى نقاطي؟','a'=>'في القائمة العلوية بجانب اسمك، وفي صفحة الملف الشخصي، وبجانب اسمك في كل سؤال/إجابة.'],
                            ['q'=>'هل النقاط تُخصم؟','a'=>'لا، حالياً النقاط تراكمية فقط. نخطط لإضافة خصم عند الحصول على تقييم سلبي في الإصدارات القادمة.'],
                        ];
                    @endphp
                    @foreach($faqsR as $i => $f)
                        <div class="rounded-2xl border border-slate-200 bg-white overflow-hidden">
                            <button @click="open === 'r{{ $i }}' ? open=null : open='r{{ $i }}'" class="w-full flex items-center justify-between gap-4 px-5 py-4 text-start hover:bg-slate-50 transition">
                                <span class="font-bold text-slate-900 text-sm">{{ $f['q'] }}</span>
                                <span class="shrink-0 size-8 rounded-full bg-slate-900 text-white flex items-center justify-center" :class="open==='r{{ $i }}' ? 'rotate-45' : ''">
                                    <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                </span>
                            </button>
                            <div x-show="open==='r{{ $i }}'" x-transition class="px-5 pb-5">
                                <p class="text-sm leading-6 text-slate-600 border-t border-slate-100 pt-4">{{ $f['a'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Tech --}}
            <div id="tech">
                <h2 class="text-sm font-black tracking-widest text-slate-500">تقني</h2>
                <div class="mt-3 space-y-3">
                    @php
                        $faqsT = [
                            ['q'=>'ما هي التقنيات المستخدمة؟','a'=>'Laravel 13, PHP 8.3, Blade + Tailwind 3, Vite, Pest 4, Pint, SQLite, Breeze. كلها موثقة في composer.json.'],
                            ['q'=>'كيف يعمل تسجيل الدخول؟','a'=>'عبر Laravel Breeze (Blade) مع Tailwind. الجلسات عبر database driver و CSRF محمي.'],
                            ['q'=>'هل المنصة متجاوبة؟','a'=>'نعم 100% — Tailwind mobile-first مع Alpine.js للقوائم والـ accordion و backdrop-blur.'],
                        ];
                    @endphp
                    @foreach($faqsT as $i => $f)
                        <div class="rounded-2xl border border-slate-200 bg-white overflow-hidden">
                            <button @click="open === 't{{ $i }}' ? open=null : open='t{{ $i }}'" class="w-full flex items-center justify-between gap-4 px-5 py-4 text-start hover:bg-slate-50 transition">
                                <span class="font-bold text-slate-900 text-sm">{{ $f['q'] }}</span>
                                <span class="shrink-0 size-8 rounded-full bg-slate-900 text-white flex items-center justify-center" :class="open==='t{{ $i }}' ? 'rotate-45' : ''">
                                    <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                </span>
                            </button>
                            <div x-show="open==='t{{ $i }}'" x-transition class="px-5 pb-5">
                                <p class="text-sm leading-6 text-slate-600 border-t border-slate-100 pt-4">{{ $f['a'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Still need help --}}
        <div class="mt-12 rounded-[1.75rem] bg-indigo-600 p-6 sm:p-8 text-white flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <h3 class="text-lg font-black">لم تجد إجابتك؟</h3>
                <p class="text-sm text-indigo-100 mt-1">تواصل معنا وسنرد خلال ساعات — أو تصفح الأسئلة مباشرة.</p>
            </div>
            <div class="flex gap-3 shrink-0">
                <a href="{{ route('contact') }}" class="rounded-xl bg-white px-6 py-3 text-sm font-black text-indigo-600 hover:bg-indigo-50 transition">تواصل معنا</a>
                <a href="{{ route('questions.index') }}" class="rounded-xl bg-indigo-700 px-6 py-3 text-sm font-bold text-white ring-1 ring-white/20 hover:bg-indigo-800 transition">تصفح الأسئلة</a>
            </div>
        </div>
    </div>
</x-app-layout>
