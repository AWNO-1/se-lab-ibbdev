<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-indigo-600">مرحبًا {{ Auth::user()->name }}</p>
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
                           class="inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white transition hover:-translate-y-0.5 hover:bg-indigo-500">
                            <svg class="size-4 me-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            إنشاء سؤال جديد
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white transition hover:-translate-y-0.5 hover:bg-indigo-500">
                            <svg class="size-4 me-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            تسجيل الدخول لإنشاء سؤال
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    {{-- عرض الأسئلة --}}
    <div class="mt-10 space-y-6">
        @if(count($questions) > 0)
            @foreach($questions as $question)
                <div class="bg-white rounded-xl shadow-sm p-6 border border-slate-200">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center flex-shrink-0">
                            @if($question->user->avatar)
                                <img src="{{ asset('storage/'.$question->user->avatar) }}" alt="{{ $question->user->name }}">
                            @else
                                <span class="text-indigo-600 font-bold">{{ mb_substr($question->user->name, 0, 1) }}</span>
                            @endif>
                        </div>
                        <div class-flex-1 min-w-0>
                            <h3 class="text-slate-900 font-bold truncate">{{ $question->title }}</h3>
                            <p class="text-slate-500 text-sm mt-1 line-clamp-2">{{ strip_tags(substr($question->body, 0, 150)) }}...</p>
                        </div>
                        <div class="text-slate-400 text-sm">
                            <span>{{ $question->user->name }}</span>
                            <span class="mx-2 text-xs">|</span>
                            <span>{{ $question->answers->count() }} {{ $question->answers->count() == 1 ? 'إجابة' : 'إجابات' }}</span>
                        </div>
                    </div>
                    <a href="{{ route('questions.show', $question->id) }}"
                       class="mt-3 inline-flex items-center gap-1 text-sm text-indigo-600 hover underline">
                        عرض التفاصيل ›
                    </a>
                </div>
            @endforeach
        @else
            <div class="bg-white rounded-xl shadow-sm p-8 text-center text-slate-500">
                <svg class="mx-auto mb-4 size-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6m3-9H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-14m-3-3L21 12a2 2 0 01-2 2H5a2 2 0 01-2-2L4.23 7.73m6.36 4.38L12 15l4.38-4.38" />
                </svg>
                <p class="mt-4 text-sm">لا توجد أسئلة بعد. كن أول من يصيغ سؤالاً!</p>
            </div>
        @endif
    </div>
</x-app-layout>