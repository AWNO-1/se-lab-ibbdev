<x-app-layout>
    <x-slot name="header">
        <div>
            @auth
                <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-indigo-600">مرحبًا {{ Auth::user()->name }}</p>
            @else
                <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-indigo-600">تفاصيل السؤال</p>
            @endauth
            <h1 class="text-2xl font-bold text-slate-950 sm:text-3xl">تفاصيل السؤال</h1>
            <p class="mt-2 text-sm leading-6 text-slate-500">اقرأ السؤال وقدم إجابتك.</p>
        </div>
    </x-slot>

    <div class="mx-auto max-w-3xl px-4 py-10 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-6 rounded-2xl bg-emerald-50 border border-emerald-200 px-4 py-3 text-sm font-semibold text-emerald-800">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 rounded-2xl bg-red-50 border border-red-200 px-4 py-3 text-sm font-semibold text-red-800">
                {{ session('error') }}
            </div>
        @endif

        {{-- Post Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 sm:p-8">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center overflow-hidden">
                        @if($post->user->avatar_path)
                            <img src="{{ $post->user->avatar_path }}" alt="{{ $post->user->name }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-indigo-600 font-bold text-sm">{{ mb_substr($post->user->name, 0, 1) }}</span>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-900">{{ $post->user->name }}</p>
                        <p class="text-xs text-slate-500">@ {{ $post->user->username }} · {{ $post->created_at->diffForHumans() }} · {{ $post->user->reputation_points }} نقطة</p>
                    </div>
                </div>

                <h2 class="text-xl sm:text-2xl font-bold text-slate-900 leading-relaxed">{{ $post->title }}</h2>
                <p class="mt-4 text-slate-600 leading-8 whitespace-pre-line">{{ $post->body }}</p>

                @if($post->image_path)
                    <div class="mt-6">
                        @if(Str::startsWith($post->image_path, ['http://', 'https://']))
                            <img src="{{ $post->image_path }}" class="w-full rounded-2xl border border-slate-200" alt="صورة السؤال">
                        @else
                            <img src="{{ asset('storage/'.$post->image_path) }}" class="w-full rounded-2xl border border-slate-200" alt="صورة السؤال">
                        @endif
                    </div>
                @endif
            </div>

            {{-- Answers Section --}}
            <div class="bg-slate-50 border-t border-slate-200 px-6 py-6 sm:px-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-base font-bold text-slate-900">الإجابات ({{ $post->answers->count() }})</h3>
                    @if($post->answers->where('is_accepted', true)->count() > 0)
                        <span class="inline-flex items-center gap-1 rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700">
                            <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            يوجد حل معتمد
                        </span>
                    @endif
                </div>

                @forelse($post->answers as $answer)
                    <div class="mb-4 rounded-2xl bg-white border p-5 {{ $answer->is_accepted ? 'border-emerald-300 bg-emerald-50/50' : 'border-slate-200' }}">
                        @if($answer->is_accepted)
                            <div class="mb-3 inline-flex items-center gap-1 rounded-full bg-emerald-600 px-3 py-1 text-xs font-bold text-white">
                                ✓ حل معتمد
                            </div>
                        @endif
                        <p class="text-slate-800 leading-7 whitespace-pre-line">{{ $answer->body }}</p>
                        <div class="mt-4 flex flex-wrap items-center justify-between gap-3 border-t border-slate-100 pt-4">
                            <div class="flex items-center gap-2 text-xs text-slate-500">
                                <span class="w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-600">{{ mb_substr($answer->user->name, 0, 1) }}</span>
                                <span class="font-semibold text-slate-700">{{ $answer->user->name }}</span>
                                <span>· {{ $answer->user->reputation_points }} نقطة</span>
                                <span>· {{ $answer->created_at->diffForHumans() }}</span>
                            </div>
                            @auth
                                @can('accept', $answer)
                                    @if(!$answer->is_accepted && $post->answers->where('is_accepted', true)->count() == 0)
                                        <form method="POST" action="{{ route('answers.accept', $answer) }}">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center gap-1 rounded-xl bg-emerald-600 px-4 py-2 text-xs font-bold text-white hover:bg-emerald-700 transition">
                                                اعتماد كحل (+10 نقاط)
                                            </button>
                                        </form>
                                    @endif
                                @endcan
                            @endauth
                        </div>
                    </div>
                @empty
                    <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center">
                        <p class="text-sm text-slate-500">لا توجد إجابات بعد. كن أول من يجيب!</p>
                    </div>
                @endforelse

                {{-- Add Answer Form --}}
                @auth
                    @if(auth()->id() !== $post->user_id)
                        <div class="mt-8 rounded-2xl bg-white border border-slate-200 p-6">
                            <h4 class="font-bold text-slate-900 mb-3">أضف إجابتك</h4>
                            <form method="POST" action="{{ route('answers.store', $post) }}">
                                @csrf
                                <textarea name="body" rows="4" required
                                    class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-indigo-500 @error('body') border-red-300 @enderror"
                                    placeholder="اكتب إجابتك هنا minimum 5 أحرف...">{{ old('body') }}</textarea>
                                @error('body')
                                    <p class="mt-2 text-xs font-semibold text-red-600">{{ $message }}</p>
                                @enderror
                                <div class="mt-4 flex justify-end">
                                    <button type="submit" class="rounded-xl bg-indigo-600 px-6 py-2.5 text-sm font-bold text-white hover:bg-indigo-700 transition">
                                        إرسال الإجابة
                                    </button>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="mt-6 rounded-xl bg-amber-50 border border-amber-200 px-4 py-3 text-sm text-amber-800">
                            أنت صاحب السؤال، لا يمكنك الإجابة على سؤالك الخاص.
                        </div>
                    @endif
                @else
                    <div class="mt-6 rounded-2xl bg-indigo-50 border border-indigo-200 p-6 text-center">
                        <p class="text-sm text-slate-600">يجب تسجيل الدخول لإضافة إجابة</p>
                        <a href="{{ route('login') }}" class="mt-3 inline-flex rounded-xl bg-indigo-600 px-5 py-2 text-sm font-bold text-white hover:bg-indigo-700 transition">تسجيل الدخول</a>
                    </div>
                @endauth
            </div>
        </div>

        <div class="mt-6 flex justify-between">
            <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-indigo-600 transition">
                <svg class="size-4 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                العودة للأسئلة
            </a>
        </div>
    </div>
</x-app-layout>
