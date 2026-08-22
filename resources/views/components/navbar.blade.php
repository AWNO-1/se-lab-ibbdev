<nav class="bg-white/85 backdrop-blur-xl border-b border-white/70 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-6">
            <a href="{{ route('welcome') }}" class="flex items-center gap-2 hover:text-indigo-600 transition">
                <svg class="size-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <span class="hidden sm:block text-sm font-bold text-slate-900">IBBDev</span>
            </a>
        </div>

        <div class="hidden items-center gap-2 md:flex">
            <a href="{{ route('welcome') }}" class="text-slate-600 hover:text-indigo-600 transition rounded-xl px-4 py-2 text-sm font-semibold">
                الرئيسية
            </a>
            <a href="{{ route('about') }}" class="text-slate-600 hover:text-indigo-600 transition rounded-xl px-4 py-2 text-sm font-semibold">
                من نحن
            </a>
            <a href="{{ route('contact') }}" class="text-slate-600 hover:text-indigo-600 transition rounded-xl px-4 py-2 text-sm font-semibold">
                اتصل بنا
            </a>
            <a href="{{ route('faqs') }}" class="text-slate-600 hover:text-indigo-600 transition rounded-xl px-4 py-2 text-sm font-semibold">
                الأسئلة الشائعة
            </a>
        </div>

        <div class="hidden sm:flex items-center gap-2">
            @auth
                <a href="{{ route('profile.edit') }}"
                   class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700 transition">
                    الملف الشخصي
                </a>
                <form method="POST" action="{{ route('logout') }}"
                      class="inline">
                    @csrf
                    <button type="submit"
                            class="rounded-xl bg-red-500 px-4 py-2 text-sm font-semibold text-white hover:bg-red-600 transition">
                        تسجيل الخروج
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700 transition">
                    تسجيل الدخول
                </a>
                <a href="{{ route('register') }}"
                   class="rounded-xl bg-indigo-100 px-4 py-2 text-sm font-semibold text-indigo-700 hover:bg-indigo-200 transition">
                    التسجيل
                </a>
            @endauth
        </div>
    </div>
</nav>