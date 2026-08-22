<x-app-layout>
    <x-slot name="header">
        <div>
            @auth
                <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-indigo-600">مرحبًا {{ Auth::user()->name }}</p>
            @else
                <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-indigo-600">مرحبًا بك في IBBDev</p>
            @endauth
            <h1 class="text-2xl font-bold text-slate-950 sm:text-3xl">جميع الأسئلة</h1>
            <p class="mt-2 text-sm leading-6 text-slate-500">تصفح الأسئلة واكتشف خبرات برمجية جديدة.</p>
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="relative overflow-hidden rounded-[2rem] bg-slate-950 px-6 py-12 text-white shadow-2xl sm:px-10 lg:px-14">
            <div class="absolute -left-16 -top-24 size-72 rounded-full bg-indigo-600/30 blur-3xl"></div>
            <div class="absolute -bottom-32 right-0 size-80 rounded-full bg-violet-600/20 blur-3xl"></div>

            <div class="relative max-w-2xl">
                <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1.5 text-xs font-bold text-indigo-200 ring-1 ring-white/10">
                    مساحة الأسئلة اليومية
                </span>
                <h2 class="mt-6 text-3xl font-bold leading-[1.6] sm:text-4xl">اكتشف أسئلة من زملائك</h2>
                <p class="mt-4 max-w-xl text-sm leading-8 text-slate-300">استعرض الأسئلة البرمجية، اقرأ التفاصيل، وقدم إجاباتك لمساعدة غيرك.</p>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    @auth
                        <a href="{{ route('questions.create') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-2xl bg-white px-5 py-3 text-sm font-bold text-slate-900 transition hover:-translate-y-0.5 hover:bg-indigo-50">
                            <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            إنشاء سؤال جديد
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-2xl bg-white px-5 py-3 text-sm font-bold text-slate-900 transition hover:-translate-y-0.5 hover:bg-indigo-50">
                            تسجيل الدخول لإنشاء سؤال
                        </a>
                    @endauth
                    <a href="{{ route('welcome') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-2xl bg-white/10 px-5 py-3 text-sm font-bold text-white ring-1 ring-white/20 transition hover:bg-white/20">
                        الصفحة الرئيسية
                    </a>
                </div>
            </div>
        </div>

        {{-- عرض الأسئلة --}}
        <div class="mt-10 space-y-4">
            @forelse($questions as $question)
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-200 hover:border-indigo-200 hover:shadow-md transition">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center flex-shrink-0 overflow-hidden">
                            @if($question->user->avatar)
                                <img src="{{ $question->user->avatar }}" alt="{{ $question->user->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-indigo-600 font-bold text-sm">{{ mb_substr($question->user->name, 0, 1) }}</span>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-slate-900 font-bold truncate">
                                <a href="{{ route('questions.show', $question) }}" class="hover:text-indigo-600 transition">{{ $question->title }}</a>
                            </h3>
                            <p class="text-slate-500 text-sm mt-1 line-clamp-2">{{ Str::limit(strip_tags($question->body), 150) }}</p>
                            <div class="mt-3 flex items-center gap-3 text-xs text-slate-400">
                                <span class="font-semibold text-slate-600">{{ $question->user->name }}</span>
                                <span class="flex items-center gap-1">
                                    <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c-1.268 0-2.39-.63-3.068-1.593a3.745 3.745 0 00-3.442-1.657H6.75a2.25 2.25 0 00-2.25 2.25v2.25c0 1.243.99 2.25 2.25 2.25h7.5a3.75 3.75 0 013.75 3.75v.75a.75.75 0 001.5 0v-.75A5.25 5.25 0 0014.25 12h.006z"/></svg>
                                    {{ $question->answers->count() }} {{ $question->answers->count() == 1 ? 'إجابة' : 'إجابات' }}
                                </span>
                                <span>{{ $question->created_at->diffForHumans() }}</span>
                                @if($question->image)
                                    <span class="inline-flex items-center gap-1 text-indigo-500">
                                        <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                                        صورة
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <a href="{{ route('questions.show', $question) }}"
                            class="inline-flex items-center gap-1 text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition">
                            عرض التفاصيل
                            <svg class="size-4 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-2xl shadow-sm p-10 text-center border border-dashed border-slate-300">
                    <div class="mx-auto w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center">
                        <svg class="size-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                        </svg>
                    </div>
                    <h3 class="mt-4 font-bold text-slate-900">لا توجد أسئلة بعد</h3>
                    <p class="mt-2 text-sm text-slate-500">كن أول من يطرح سؤالاً وابدأ النقاش!</p>
                    @auth
                        <a href="{{ route('questions.create') }}" class="mt-6 inline-flex rounded-xl bg-indigo-600 px-6 py-2.5 text-sm font-bold text-white hover:bg-indigo-700 transition">طرح سؤال جديد</a>
                    @endauth
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
