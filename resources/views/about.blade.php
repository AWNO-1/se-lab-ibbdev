<x-app-layout>
    {{-- Hero --}}
    <section class="relative overflow-hidden bg-slate-950 text-white">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/30 via-violet-600/20 to-transparent"></div>
        <div class="absolute -top-20 -right-20 size-96 rounded-full bg-indigo-500/20 blur-[80px]"></div>
        <div class="relative mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-24">
            <div class="max-w-3xl">
                <span class="inline-flex rounded-full bg-white/10 px-3 py-1 text-xs font-bold text-indigo-200 ring-1 ring-white/10">من نحن — قصتنا</span>
                <h1 class="mt-4 text-4xl font-black leading-tight sm:text-5xl">نبني <span class="text-indigo-400">مجتمع المطورين</span> العربي</h1>
                <p class="mt-5 text-lg leading-8 text-slate-300">IBBDev وُلدت داخل معامل هندسة البرمجيات — من فكرة طلاب إلى منصة حقيقية تطبق SOLID, Service Layer, DI, و Blade باحترافية.</p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('contact') }}" class="rounded-2xl bg-white px-7 py-3 text-sm font-black text-slate-900 hover:bg-slate-100 transition">تواصل معنا</a>
                    <a href="{{ route('questions.index') }}" class="rounded-2xl bg-white/10 px-7 py-3 text-sm font-bold text-white ring-1 ring-white/20 hover:bg-white/20 transition">استعرض الأسئلة</a>
                </div>
            </div>
            <div class="mt-10 grid grid-cols-3 gap-6 max-w-xl border-t border-white/10 pt-8">
                <div><p class="text-2xl font-black">{{ \App\Models\User::count() }}+</p><p class="text-xs text-slate-400">مستخدم</p></div>
                <div><p class="text-2xl font-black">15</p><p class="text-xs text-slate-400">جامعة مشاركة</p></div>
                <div><p class="text-2xl font-black">2026</p><p class="text-xs text-slate-400">سنة الانطلاق</p></div>
            </div>
        </div>
    </section>

    {{-- Mission + Vision --}}
    <section class="py-16 sm:py-24 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-bold text-indigo-600 ring-1 ring-indigo-200">رسالتنا</span>
                    <h2 class="mt-4 text-3xl font-black text-slate-900">تمكين الطلاب عبر المعرفة المتبادلة</h2>
                    <p class="mt-4 leading-8 text-slate-600">نؤمن أن مشاركة المعرفة هي أقصر طريق للنمو. IBBDev توفر بيئة آمنة، سريعة، وعربية بالكامل لطرح الأسئلة البرمجية، الحصول على إجابات موثوقة، وبناء سمعة تقنية تفتح لك أبواب الفرص.</p>
                    <div class="mt-8 space-y-4">
                        <div class="flex gap-3">
                            <span class="size-8 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600">✓</span>
                            <p class="text-sm text-slate-700"><span class="font-bold">تعلم تطبيقي</span> — كل ميزة بُنيت كتطبيق حي لمفاهيم المعمل 1-4.</p>
                        </div>
                        <div class="flex gap-3">
                            <span class="size-8 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600">✓</span>
                            <p class="text-sm text-slate-700"><span class="font-bold">جودة أولاً</span> — نظام نقاط وسمعة يضمن وصول أفضل الإجابات للقمة.</p>
                        </div>
                        <div class="flex gap-3">
                            <span class="size-8 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600">✓</span>
                            <p class="text-sm text-slate-700"><span class="font-bold">مفتوح للجميع</span> — واجهة Blade خفيفة بدون تعقيد React.</p>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="rounded-[2rem] bg-slate-50 p-8 border border-slate-200">
                        <h3 class="font-black text-slate-900">رؤيتنا 2030</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-600">أن نكون المنصة الأولى عربياً لطلاب علوم الحاسوب — حيث يجد كل سؤال إجابة، وكل إجابة تُكافأ.</p>
                        <div class="mt-6 grid grid-cols-2 gap-4">
                            <div class="rounded-2xl bg-white p-5 border border-slate-200 text-center">
                                <p class="text-2xl font-black text-indigo-600">92%</p><p class="text-xs text-slate-500">نسبة الحل</p>
                            </div>
                            <div class="rounded-2xl bg-white p-5 border border-slate-200 text-center">
                                <p class="text-2xl font-black text-violet-600">24h</p><p class="text-xs text-slate-500">متوسط الرد</p>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -bottom-6 -left-6 hidden sm:block rounded-2xl bg-indigo-600 text-white px-6 py-4 shadow-xl">
                        <p class="text-xs text-indigo-200">مبني بـ</p><p class="font-black">Laravel 13 + Blade</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Values --}}
    <section class="py-16 bg-slate-50">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto">
                <h2 class="text-3xl font-black text-slate-900">قيمنا</h2>
                <p class="mt-3 text-slate-600">أربعة مبادئ توجه كل سطر كود نكتبه.</p>
            </div>
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @php
                    $values = [
                        ['title'=>'الوضوح','desc'=>'كود نظيف، أسماء وصفية، وتعليقات مركزة فقط عند الحاجة.','icon'=>'M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z'],
                        ['title'=>'التعاون','desc'=>'Git branches, Pull Requests, و Kanban — نعمل كفريق حقيقي.','icon'=>'M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z'],
                        ['title'=>'الجودة','desc'=>'Pest tests, Pint formatting, و Service Layer — لا نسلم إلا المختبر.','icon'=>'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['title'=>'الانفتاح','desc'=>'عربي RTL بالكامل، Tailwind متجاوب، ووصول للجميع على أي جهاز.','icon'=>'M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418'],
                    ];
                @endphp
                @foreach($values as $v)
                    <div class="rounded-2xl bg-white p-6 border border-slate-200">
                        <div class="size-10 rounded-xl bg-slate-900 text-white flex items-center justify-center">
                            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $v['icon'] }}"/></svg>
                        </div>
                        <h3 class="mt-4 font-bold text-slate-900">{{ $v['title'] }}</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-600">{{ $v['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Tech Stack & Timeline --}}
    <section class="py-16 sm:py-20 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12">
                <div>
                    <h3 class="text-2xl font-black text-slate-900">التقنيات المستخدمة</h3>
                    <div class="mt-6 grid grid-cols-2 gap-3">
                        @php $stack = [['Laravel 13','PHP 8.3'],['Blade + Vite','Tailwind 3'],['Pest 4','Pint'],['SQLite','Breeze']]; @endphp
                        @foreach($stack as $s)
                            <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">
                                <p class="text-sm font-bold text-slate-900">{{ $s[0] }}</p><p class="text-xs text-slate-500">{{ $s[1] }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6 rounded-2xl bg-indigo-50 border border-indigo-200 p-5">
                        <p class="text-sm font-bold text-indigo-900">مبدأ هندسي مطبق:</p>
                        <p class="text-sm text-indigo-700 mt-1">SRP + DIP — Controller نحيف، Service خلف Interface، و DI عبر constructor.</p>
                    </div>
                </div>
                <div>
                    <h3 class="text-2xl font-black text-slate-900">رحلتنا</h3>
                    <ol class="mt-6 relative border-s border-slate-200 space-y-6">
                        @php $timeline=[['2026-01','المعمل 1: User Stories & Git'],['2026-03','المعمل 2: MVC + Blade + Tailwind'],['2026-05','المعمل 3: OOP + DI'],['2026-07','المعمل 4: SOLID + Service Layer'],['2026-08','المعمل 5: IBBDev كاملة — هذا المشروع']]; @endphp
                        @foreach($timeline as $t)
                            <li class="ms-6">
                                <span class="absolute -start-2 size-4 rounded-full bg-indigo-600 ring-4 ring-indigo-100"></span>
                                <p class="text-xs font-bold text-indigo-600">{{ $t[0] }}</p>
                                <p class="text-sm font-semibold text-slate-900">{{ $t[1] }}</p>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </section>

    {{-- Team CTA --}}
    <section class="mx-4 sm:mx-6 lg:mx-8 mb-8">
        <div class="mx-auto max-w-7xl rounded-[2rem] bg-slate-900 px-6 py-10 sm:px-10 text-white flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <h3 class="text-xl font-black">هل لديك اقتراح؟</h3>
                <p class="text-sm text-slate-300 mt-1">نحن نستمع — تواصل معنا وسنرد خلال ساعات.</p>
            </div>
            <a href="{{ route('contact') }}" class="rounded-xl bg-white px-6 py-3 text-sm font-black text-slate-900 hover:bg-slate-100 transition">تواصل الآن</a>
        </div>
    </section>
</x-app-layout>
