<x-app-layout>
    {{-- Hero --}}
    <section class="relative overflow-hidden bg-gradient-to-b from-indigo-50 to-white border-b border-slate-200">
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
            <div class="max-w-3xl">
                <span class="inline-flex rounded-full bg-indigo-600 px-3 py-1 text-xs font-bold text-white">تواصل معنا</span>
                <h1 class="mt-4 text-4xl font-black text-slate-900 sm:text-5xl">نحن هنا لمساعدتك</h1>
                <p class="mt-4 text-lg leading-8 text-slate-600">لديك سؤال، اقتراح، أو بلاغ؟ فريق IBBDev يرد عادة خلال أقل من 4 ساعات في أيام العمل.</p>
            </div>

            <div class="mt-8 grid gap-4 sm:grid-cols-3">
                <div class="rounded-2xl bg-white p-5 border border-slate-200 shadow-sm">
                    <div class="size-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center">
                        <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/></svg>
                    </div>
                    <p class="mt-3 text-sm font-black text-slate-900">البريد</p>
                    <p class="text-sm text-indigo-600">support@ibbdev.sa</p>
                    <p class="text-xs text-slate-500 mt-1">نرد خلال 4 ساعات</p>
                </div>
                <div class="rounded-2xl bg-white p-5 border border-slate-200 shadow-sm">
                    <div class="size-10 rounded-xl bg-violet-600 text-white flex items-center justify-center">
                        <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.362-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                    </div>
                    <p class="mt-3 text-sm font-black text-slate-900">الدعم</p>
                    <p class="text-sm text-slate-900">داخل المنصة</p>
                    <p class="text-xs text-slate-500 mt-1">عبر صفحة الأسئلة</p>
                </div>
                <div class="rounded-2xl bg-white p-5 border border-slate-200 shadow-sm">
                    <div class="size-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center">
                        <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <p class="mt-3 text-sm font-black text-slate-900">أوقات العمل</p>
                    <p class="text-sm text-slate-900">السبت - الخميس</p>
                    <p class="text-xs text-slate-500 mt-1">9ص - 6م (Asia/Aden)</p>
                </div>
            </div>
        </div>
    </section>

    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-5 gap-8">
            {{-- Form --}}
            <div class="lg:col-span-3">
                <div class="rounded-[1.75rem] bg-white border border-slate-200 shadow-sm p-6 sm:p-8">
                    <h2 class="text-xl font-black text-slate-900">أرسل رسالة</h2>
                    <p class="text-sm text-slate-500 mt-1">جميع الحقول المطلوبة مشار إليها بـ <span class="text-red-500">*</span></p>

                    @if(session('success'))
                        <div class="mt-4 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 text-sm font-bold text-emerald-800">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="#" class="mt-6 space-y-5" onsubmit="event.preventDefault(); alert('تم استلام رسالتك — شكراً لتواصلك! (وضع تجريبي)');">
                        @csrf
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-slate-700">الاسم <span class="text-red-500">*</span></label>
                                <input type="text" required placeholder="ساهر قايد" class="mt-1 w-full rounded-xl border-slate-200 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700">البريد الإلكتروني <span class="text-red-500">*</span></label>
                                <input type="email" required placeholder="saher@example.com" class="mt-1 w-full rounded-xl border-slate-200 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700">الموضوع</label>
                            <select class="mt-1 w-full rounded-xl border-slate-200 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-indigo-500 bg-white">
                                <option>استفسار عام</option>
                                <option>بلاغ عن مشكلة</option>
                                <option>اقتراح ميزة</option>
                                <option>شراكة</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700">الرسالة <span class="text-red-500">*</span></label>
                            <textarea rows="5" required placeholder="اكتب رسالتك هنا... نحب أن نسمع منك بالتفصيل" class="mt-1 w-full rounded-xl border-slate-200 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-indigo-500 resize-none"></textarea>
                            <p class="mt-1 text-xs text-slate-500">الحد الأدنى 10 أحرف.</p>
                        </div>

                        <label class="flex gap-2 items-start">
                            <input type="checkbox" class="mt-1 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                            <span class="text-xs leading-5 text-slate-600">أوافق على <a href="#" class="font-bold text-indigo-600 hover:underline">سياسة الخصوصية</a> ومعالجة بياناتي للرد على استفساري.</span>
                        </label>

                        <div class="flex gap-3 pt-2">
                            <button type="submit" class="flex-1 rounded-xl bg-indigo-600 px-6 py-3 text-sm font-black text-white hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                                إرسال الرسالة
                            </button>
                            <a href="{{ route('faqs') }}" class="rounded-xl bg-white px-6 py-3 text-sm font-bold text-slate-700 ring-1 ring-slate-200 hover:bg-slate-50 transition">الأسئلة الشائعة</a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Side info --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="rounded-[1.75rem] bg-slate-950 text-white p-6 sm:p-8">
                    <h3 class="font-black">معلومات إضافية</h3>
                    <div class="mt-6 space-y-4 text-sm">
                        <div class="flex gap-3">
                            <span class="size-8 rounded-lg bg-white/10 flex items-center justify-center">📍</span>
                            <div><p class="font-bold">الموقع</p><p class="text-slate-300">إب، اليمن — حرم جامعة إب، كلية علوم الحاسوب</p></div>
                        </div>
                        <div class="flex gap-3">
                            <span class="size-8 rounded-lg bg-white/10 flex items-center justify-center">✉️</span>
                            <div><p class="font-bold">البريد</p><p class="text-slate-300">support@ibbdev.sa<br>hello@ibbdev.sa</p></div>
                        </div>
                        <div class="flex gap-3">
                            <span class="size-8 rounded-lg bg-white/10 flex items-center justify-center">💬</span>
                            <div><p class="font-bold">المجتمع</p><p class="text-slate-300">انضم إلى نقاشات <a href="{{ route('posts.index') }}" class="underline decoration-indigo-400">الأسئلة</a> للحصول على رد أسرع.</p></div>
                        </div>
                    </div>
                    <div class="mt-6 rounded-xl bg-white/5 p-4 ring-1 ring-white/10">
                        <p class="text-xs font-bold text-indigo-200">متوسط زمن الرد</p>
                        <p class="text-2xl font-black">~3.5 ساعة</p>
                        <p class="text-xs text-slate-400">في أيام العمل</p>
                    </div>
                </div>

                <div class="rounded-[1.75rem] bg-white border border-slate-200 p-6">
                    <h3 class="font-black text-slate-900">أسئلة سريعة</h3>
                    <div class="mt-4 space-y-3">
                        <a href="{{ route('faqs') }}" class="flex items-center justify-between rounded-xl bg-slate-50 px-4 py-3 hover:bg-slate-100 transition">
                            <span class="text-sm font-semibold text-slate-700">كيف أكسب نقاط السمعة؟</span>
                            <span class="text-slate-400">›</span>
                        </a>
                        <a href="{{ route('faqs') }}" class="flex items-center justify-between rounded-xl bg-slate-50 px-4 py-3 hover:bg-slate-100 transition">
                            <span class="text-sm font-semibold text-slate-700">هل يمكنني رفع صورة؟</span>
                            <span class="text-slate-400">›</span>
                        </a>
                        <a href="{{ route('about') }}" class="flex items-center justify-between rounded-xl bg-slate-50 px-4 py-3 hover:bg-slate-100 transition">
                            <span class="text-sm font-semibold text-slate-700">ما هي IBBDev؟</span>
                            <span class="text-slate-400">›</span>
                        </a>
                    </div>
                </div>

                {{-- Map placeholder --}}
                <div class="rounded-[1.75rem] bg-slate-100 border border-slate-200 h-48 flex items-center justify-center overflow-hidden">
                    <div class="text-center">
                        <div class="mx-auto size-12 rounded-xl bg-white flex items-center justify-center shadow">
                            <svg class="size-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                        </div>
                        <p class="mt-2 text-xs font-bold text-slate-600">الخريطة — إب، اليمن</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
