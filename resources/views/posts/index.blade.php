<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-indigo-600">
                    @auth مرحباً {{ Auth::user()->name }} @else مرحباً بك في IBBDev @endauth
                </p>
                <h1 class="text-2xl font-black text-slate-900 sm:text-3xl">استكشف الأسئلة</h1>
                <p class="mt-2 text-sm leading-6 text-slate-500">ابحث، فلتر، واكتشف حلولاً برمجية من مجتمع المطورين.</p>
            </div>
            @auth
                <a href="{{ route('posts.create') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-6 py-3 text-sm font-black text-white shadow-lg shadow-indigo-500/20 hover:bg-indigo-700 transition hover:-translate-y-0.5">
                    <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    سؤال جديد
                </a>
            @endauth
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        {{-- Search + Filters Bar - Modern Glass Card --}}
        <div class="rounded-[1.75rem] bg-white border border-slate-200 shadow-sm p-5 sm:p-6">
            <form method="GET" action="{{ route('posts.index') }}" class="space-y-5">
                <div class="flex flex-col lg:flex-row gap-4">
                    {{-- Search --}}
                    <div class="flex-1 relative">
                        <svg class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 size-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="ابحث بالعنوان أو المحتوى... (مثال: Laravel, NullPointer)" class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 pe-4 ps-11 text-sm placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-indigo-500 transition">
                    </div>

                    {{-- Sort --}}
                    <div class="flex gap-2">
                        <select name="sort" onchange="this.form.submit()" class="rounded-xl border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="latest" {{ request('sort','latest')==='latest' ? 'selected' : '' }}>الأحدث</option>
                            <option value="oldest" {{ request('sort')==='oldest' ? 'selected' : '' }}>الأقدم</option>
                            <option value="popular" {{ request('sort')==='popular' ? 'selected' : '' }}>الأكثر إجابات</option>
                        </select>
                        <button type="submit" class="hidden sm:inline-flex rounded-xl bg-slate-900 px-6 py-3 text-sm font-bold text-white hover:bg-indigo-600 transition">بحث</button>
                    </div>
                </div>

                {{-- Filter Pills --}}
                <div class="flex flex-wrap gap-2">
                    @php
                        $currentFilter = request('filter', 'all');
                        $filters = [
                            'all' => 'الكل',
                            'solved' => 'محلولة ✓',
                            'unsolved' => 'غير محلولة',
                            'my' => 'أسئلتي',
                        ];
                    @endphp
                    @foreach($filters as $key => $label)
                        @if($key==='my' && !auth()->check()) @continue @endif
                        <a href="{{ route('posts.index', array_merge(request()->except('page'), ['filter'=>$key])) }}" 
                           class="inline-flex items-center gap-1.5 rounded-full px-4 py-2 text-xs font-black ring-1 transition
                           {{ $currentFilter===$key ? 'bg-indigo-600 text-white ring-indigo-600 shadow' : 'bg-white text-slate-700 ring-slate-200 hover:bg-slate-50' }}">
                            {{ $label }}
                            @if($currentFilter===$key)
                                <span class="size-2 rounded-full bg-white"></span>
                            @endif
                        </a>
                    @endforeach
                    @if(request('search') || $currentFilter!=='all' || request('sort')!=='latest')
                        <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-1 rounded-full bg-red-50 px-4 py-2 text-xs font-bold text-red-600 ring-1 ring-red-200 hover:bg-red-100 transition">
                            مسح الفلاتر ✕
                        </a>
                    @endif
                </div>

                {{-- Active Search Badge --}}
                @if(request('search'))
                    <div class="flex items-center gap-2 text-xs">
                        <span class="text-slate-500">نتائج البحث عن:</span>
                        <span class="rounded-full bg-indigo-50 px-3 py-1 font-bold text-indigo-700 ring-1 ring-indigo-200">"{{ request('search') }}"</span>
                        <span class="text-slate-500">— وجدنا {{ $posts->total() }} نتيجة</span>
                    </div>
                @endif
            </form>
        </div>

        {{-- Posts Grid --}}
        <div class="mt-8">
            @if($posts->count() > 0)
                <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($posts as $post)
                        <article class="group relative flex flex-col overflow-hidden rounded-[1.5rem] bg-white border border-slate-200 hover:border-indigo-200 hover:shadow-xl hover:-translate-y-1 transition duration-300">
                            {{-- Image Header if exists --}}
                            @if($post->image_path)
                                <div class="h-36 overflow-hidden bg-slate-100">
                                    @if(Str::startsWith($post->image_path, ['http://','https://']))
                                        <img src="{{ $post->image_path }}" alt="{{ $post->title }}" class="h-full w-full object-cover group-hover:scale-105 transition duration-500">
                                    @else
                                        <img src="{{ asset('storage/'.$post->image_path) }}" alt="{{ $post->title }}" class="h-full w-full object-cover group-hover:scale-105 transition duration-500">
                                    @endif
                                </div>
                            @endif

                            <div class="p-5 flex flex-col flex-1">
                                {{-- Badges --}}
                                <div class="flex items-center gap-2 mb-3">
                                    @if($post->is_solved)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-black text-emerald-700 ring-1 ring-emerald-200">
                                            <svg class="size-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            محلول
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-2.5 py-1 text-[11px] font-bold text-amber-700 ring-1 ring-amber-200">مفتوح</span>
                                    @endif
                                    <span class="ms-auto text-[11px] text-slate-400">{{ $post->created_at->diffForHumans() }}</span>
                                </div>

                                <h3 class="font-black text-slate-900 line-clamp-2 group-hover:text-indigo-600 transition">
                                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                                </h3>
                                <p class="mt-2 text-sm leading-6 text-slate-600 line-clamp-2">{{ Str::limit(strip_tags($post->body), 110) }}</p>

                                {{-- Author + Stats --}}
                                <div class="mt-4 flex items-center gap-3 border-t border-slate-100 pt-4">
                                    <div class="flex items-center gap-2 flex-1 min-w-0">
                                        @if($post->user->avatar_path)
                                            <img src="{{ Str::startsWith($post->user->avatar_path, ['http://','https://']) ? $post->user->avatar_path : asset('storage/'.$post->user->avatar_path) }}" alt="{{ $post->user->name }}" class="size-8 rounded-full object-cover ring-1 ring-slate-200">
                                        @else
                                            <span class="size-8 rounded-full bg-indigo-100 flex items-center justify-center text-xs font-black text-indigo-700">{{ mb_substr($post->user->name,0,1) }}</span>
                                        @endif
                                        <div class="min-w-0">
                                            <p class="truncate text-xs font-bold text-slate-900">{{ $post->user->name }}</p>
                                            <p class="truncate text-[11px] text-slate-500">{{ '@'.$post->user->username }} · {{ $post->user->reputation_points }} نقطة</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2 text-xs">
                                        <span class="inline-flex items-center gap-1 rounded-full bg-slate-900 px-2.5 py-1 font-bold text-white">
                                            <svg class="size-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c-1.268 0-2.39-.63-3.068-1.593a3.745 3.745 0 00-3.442-1.657H6.75a2.25 2.25 0 00-2.25 2.25v2.25c0 1.243.99 2.25 2.25 2.25h7.5a3.75 3.75 0 013.75 3.75v.75a.75.75 0 001.5 0v-.75A5.25 5.25 0 0014.25 12h.006z"/></svg>
                                            {{ $post->answers_count ?? $post->answers->count() }}
                                        </span>
                                    </div>
                                </div>

                                {{-- How points were earned --}}
                                @if($post->is_solved)
                                    @php $accepted = $post->answers->where('is_accepted', true)->first(); @endphp
                                    @if($accepted)
                                        <div class="mt-3 rounded-xl bg-emerald-50 border border-emerald-200 px-3 py-2 flex items-center justify-between">
                                            <p class="text-[11px] font-bold text-emerald-800">
                                                <span class="inline-flex items-center gap-1">
                                                    <svg class="size-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                    {{ '@'.$accepted->user->username }} حصل على 10 نقاط
                                                </span>
                                            </p>
                                            <a href="{{ route('users.show', $accepted->user) }}" class="text-[11px] font-bold text-emerald-700 hover:underline">كيف؟ →</a>
                                        </div>
                                    @endif
                                @else
                                    <p class="mt-3 text-[11px] text-slate-400">💡 اعتمد إجابة لمنح صاحبها 10 نقاط وسجل في <code>reputation_logs</code></p>
                                @endif

                                <div class="mt-3 flex gap-2">
                                    <a href="{{ route('posts.show', $post) }}" class="flex-1 rounded-xl bg-slate-900 px-3 py-2 text-center text-xs font-black text-white hover:bg-indigo-600 transition">عرض التفاصيل</a>
                                    @can('update', $post)
                                        <a href="{{ route('posts.edit', $post) }}" class="rounded-xl bg-white px-3 py-2 text-xs font-bold text-slate-700 ring-1 ring-slate-200 hover:bg-slate-50 transition">تعديل</a>
                                    @endcan
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                {{-- Pagination - Modern --}}
                <div class="mt-10 flex flex-col sm:flex-row items-center justify-between gap-4 rounded-2xl bg-white border border-slate-200 px-5 py-4">
                    <p class="text-xs font-medium text-slate-500">
                        عرض <span class="font-black text-slate-900">{{ $posts->firstItem() }}</span> إلى <span class="font-black text-slate-900">{{ $posts->lastItem() }}</span> من <span class="font-black text-slate-900">{{ $posts->total() }}</span> سؤال
                    </p>
                    <div class="flex items-center gap-1">
                        {{ $posts->onEachSide(1)->links('pagination::tailwind') }}
                    </div>
                </div>
            @else
                <div class="rounded-[1.75rem] bg-white border-2 border-dashed border-slate-200 p-12 text-center">
                    <div class="mx-auto size-16 rounded-2xl bg-slate-100 flex items-center justify-center">
                        <svg class="size-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                    </div>
                    <h3 class="mt-4 text-lg font-black text-slate-900">لا توجد نتائج</h3>
                    <p class="mt-2 text-sm text-slate-500">
                        @if(request('search'))
                            لا توجد أسئلة تطابق "<span class="font-bold text-slate-900">{{ request('search') }}</span>" — جرب كلمات أخرى أو مسح الفلاتر.
                        @else
                            لا توجد أسئلة بعد. كن أول من يطرح سؤالاً!
                        @endif
                    </p>
                    <div class="mt-6 flex justify-center gap-3">
                        <a href="{{ route('posts.index') }}" class="rounded-xl bg-slate-900 px-5 py-2.5 text-sm font-bold text-white hover:bg-slate-800 transition">مسح الفلاتر</a>
                        @auth
                            <a href="{{ route('posts.create') }}" class="rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-bold text-white hover:bg-indigo-700 transition">طرح سؤال</a>
                        @endauth
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
