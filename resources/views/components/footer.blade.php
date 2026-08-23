<footer class="mt-auto bg-slate-950 text-slate-300">
    {{-- Newsletter --}}
    <div class="border-b border-white/5">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col lg:flex-row gap-6 items-center justify-between">
                <div>
                    <h3 class="font-black text-white">ابق على اطلاع</h3>
                    <p class="text-sm text-slate-400 mt-1">احصل على ملخص أسبوعي لأفضل الأسئلة والإجابات.</p>
                </div>
                <form onsubmit="event.preventDefault(); alert('تم الاشتراك! (تجريبي)');" class="flex gap-2 w-full lg:w-auto">
                    <input type="email" required placeholder="بريدك الإلكتروني" class="flex-1 lg:w-80 rounded-xl bg-white/10 border border-white/10 px-4 py-3 text-sm text-white placeholder:text-slate-400 focus:bg-white focus:text-slate-900 focus:placeholder:text-slate-500 focus:ring-2 focus:ring-indigo-500">
                    <button class="rounded-xl bg-indigo-600 px-6 py-3 text-sm font-black text-white hover:bg-indigo-700 transition">اشتراك</button>
                </form>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-5">
            {{-- Brand --}}
            <div class="lg:col-span-2">
                <div class="flex items-center gap-3">
                    <span class="flex size-10 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-600 to-violet-600 text-white">
                        <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </span>
                    <span class="font-black text-white">IBBDev</span>
                </div>
                <p class="mt-4 text-sm leading-6 text-slate-400 max-w-sm">منصة تفاعلية لطلاب علوم الحاسوب لتبادل الخبرات البرمجية — أسئلة، إجابات، ونظام سمعة يكافئ الجودة.</p>
                <div class="mt-6 flex gap-2">
                    <a href="#" aria-label="تويتر" class="size-9 rounded-xl bg-white/5 flex items-center justify-center hover:bg-white/10 transition ring-1 ring-white/10">
                        <svg class="size-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/></svg>
                    </a>
                    <a href="#" aria-label="GitHub" class="size-9 rounded-xl bg-white/5 flex items-center justify-center hover:bg-white/10 transition ring-1 ring-white/10">
                        <svg class="size-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.65.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"/></svg>
                    </a>
                    <a href="#" aria-label="يوتيوب" class="size-9 rounded-xl bg-white/5 flex items-center justify-center hover:bg-white/10 transition ring-1 ring-white/10">
                        <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.91 11.672a.375.375 0 010 .656l-5.603 3.113a.375.375 0 01-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112z"/></svg>
                    </a>
                </div>
            </div>

            {{-- Links --}}
            <div>
                <h4 class="text-sm font-black text-white">المنتج</h4>
                <ul class="mt-4 space-y-2.5 text-sm">
                    <li><a href="{{ route('posts.index') }}" class="hover:text-white transition">الأسئلة</a></li>
                    <li><a href="{{ route('posts.create') }}" class="hover:text-white transition">اطرح سؤالاً</a></li>
                    <li><a href="{{ route('faqs') }}" class="hover:text-white transition">الأسئلة الشائعة</a></li>
                    <li><a href="#" class="hover:text-white transition">لوحة الشرف</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-sm font-black text-white">الشركة</h4>
                <ul class="mt-4 space-y-2.5 text-sm">
                    <li><a href="{{ route('about') }}" class="hover:text-white transition">من نحن</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white transition">اتصل بنا</a></li>
                    <li><a href="#" class="hover:text-white transition">الوظائف</a></li>
                    <li><a href="#" class="hover:text-white transition">المدونة</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-sm font-black text-white">الدعم</h4>
                <ul class="mt-4 space-y-2.5 text-sm">
                    <li><a href="{{ route('contact') }}" class="hover:text-white transition">الدعم الفني</a></li>
                    <li><a href="{{ route('faqs') }}" class="hover:text-white transition">مركز المساعدة</a></li>
                    <li><a href="#" class="hover:text-white transition">سياسة الخصوصية</a></li>
                    <li><a href="#" class="hover:text-white transition">الشروط</a></li>
                </ul>
            </div>
        </div>

        <div class="mt-12 flex flex-col sm:flex-row gap-4 items-center justify-between border-t border-white/5 pt-8">
            <p class="text-xs text-slate-500">© {{ date('Y') }} IBBDev — جميع الحقوق محفوظة. صُنع بـ <span class="text-red-400">♥</span> لطلاب علوم الحاسوب.</p>
            <div class="flex items-center gap-4 text-xs text-slate-500">
                <span class="hidden sm:inline-flex items-center gap-1.5"><span class="size-2 rounded-full bg-emerald-500 animate-pulse"></span> جميع الأنظمة تعمل</span>
                <span>العربية • اليمن</span>
            </div>
        </div>
    </div>
</footer>
