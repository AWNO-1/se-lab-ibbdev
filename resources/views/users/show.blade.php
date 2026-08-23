<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('users.index') }}" class="size-9 rounded-xl bg-white border border-slate-200 flex items-center justify-center hover:bg-slate-50 transition">
                <svg class="size-4 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 19.5L3 12m0 0l-7.5-7.5M3 12h18"/></svg>
            </a>
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-600">الملف الشخصي</p>
                <h1 class="text-xl font-black text-slate-900">{{ $user->name }}</h1>
            </div>
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        {{-- Profile Header --}}
        <div class="overflow-hidden rounded-[1.75rem] bg-white border border-slate-200 shadow-sm">
            <div class="h-28 bg-gradient-to-l from-indigo-600 via-violet-600 to-indigo-600"></div>
            <div class="px-6 sm:px-8 pb-8">
                <div class="flex flex-col sm:flex-row gap-6 -mt-12">
                    <div class="size-24 rounded-[1.5rem] overflow-hidden bg-white border-4 border-white shadow-xl">
                        @if($user->avatar_path)
                            <img src="{{ Str::startsWith($user->avatar_path, ['http://','https://']) ? $user->avatar_path : asset('storage/'.$user->avatar_path) }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                        @else
                            <div class="h-full w-full flex items-center justify-center bg-slate-100 text-3xl font-black text-slate-400">{{ mb_substr($user->name,0,1) }}</div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0 pt-2">
                        <div class="flex flex-wrap items-center gap-3">
                            <h2 class="text-2xl font-black text-slate-900">{{ $user->name }}</h2>
                            <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-black text-indigo-700 ring-1 ring-indigo-200">{{ '@'.$user->username }}</span>
                            @if($user->id === auth()->id())
                                <span class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700 ring-1 ring-emerald-200">أنت</span>
                            @endif
                            <span class="inline-flex items-center gap-1 rounded-full bg-amber-500 px-3 py-1 text-xs font-black text-white">
                                <svg class="size-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                {{ $user->reputation_points }} نقطة
                            </span>
                        </div>
                        <p class="mt-2 text-sm text-slate-600">{{ $user->email }} · عضو منذ {{ $user->created_at->format('Y/m/d') }} ({{ $user->created_at->diffForHumans() }})</p>

                        <div class="mt-4 grid grid-cols-3 gap-3 max-w-md">
                            <div class="rounded-xl bg-slate-50 border border-slate-200 p-3 text-center">
                                <p class="text-xl font-black text-slate-900">{{ $user->posts_count }}</p>
                                <p class="text-xs font-bold text-slate-500">سؤال</p>
                            </div>
                            <div class="rounded-xl bg-slate-50 border border-slate-200 p-3 text-center">
                                <p class="text-xl font-black text-indigo-600">{{ $user->answers_count }}</p>
                                <p class="text-xs font-bold text-slate-500">إجابة</p>
                            </div>
                            <div class="rounded-xl bg-slate-900 p-3 text-center text-white">
                                <p class="text-xl font-black">{{ $user->reputationLogs()->sum('points') }}</p>
                                <p class="text-xs font-bold text-slate-300">إجمالي النقاط</p>
                            </div>
                        </div>
                    </div>
                    @if($user->id === auth()->id())
                        <div class="sm:pt-4">
                            <a href="{{ route('profile.edit') }}" class="inline-flex rounded-xl bg-slate-900 px-5 py-2.5 text-sm font-bold text-white hover:bg-slate-800 transition">تعديل الملف</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-8 grid lg:grid-cols-3 gap-6">
            {{-- Posts --}}
            <div class="lg:col-span-2">
                <div class="flex items-center justify-between">
                    <h3 class="font-black text-slate-900">أسئلة {{ $user->name }} ({{ $posts->total() }})</h3>
                    <a href="{{ route('posts.index', ['search' => $user->username]) }}" class="text-xs font-bold text-indigo-600 hover:underline">عرض في البحث</a>
                </div>
                <div class="mt-4 space-y-4">
                    @forelse($posts as $post)
                        <a href="{{ route('posts.show', $post) }}" class="block rounded-2xl bg-white border border-slate-200 p-5 hover:border-indigo-200 hover:shadow-md transition">
                            <div class="flex items-start justify-between gap-3">
                                <h4 class="font-bold text-slate-900 line-clamp-1">{{ $post->title }}</h4>
                                @if($post->is_solved)
                                    <span class="shrink-0 rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-black text-emerald-700 ring-1 ring-emerald-200">محلول ✓</span>
                                @else
                                    <span class="shrink-0 rounded-full bg-amber-50 px-2.5 py-1 text-xs font-bold text-amber-700 ring-1 ring-amber-200">مفتوح</span>
                                @endif
                            </div>
                            <p class="mt-2 text-sm text-slate-600 line-clamp-2">{{ Str::limit(strip_tags($post->body), 140) }}</p>
                            <div class="mt-3 flex items-center gap-3 text-xs text-slate-500">
                                <span>{{ $post->created_at->diffForHumans() }}</span>
                                <span>· {{ $post->answers_count }} إجابة</span>
                                @if($post->image_path) <span class="text-indigo-500">· صورة</span> @endif
                            </div>
                        </a>
                    @empty
                        <div class="rounded-2xl border-2 border-dashed border-slate-200 bg-white p-8 text-center">
                            <p class="text-sm font-bold text-slate-900">لا توجد أسئلة</p>
                            <p class="text-xs text-slate-500 mt-1">لم ينشر {{ $user->name }} أي سؤال بعد.</p>
                        </div>
                    @endforelse
                </div>
                <div class="mt-6">
                    {{ $posts->links() }}
                </div>
            </div>

            {{-- Reputation Logs --}}
            <div class="space-y-6">
                <div class="rounded-[1.5rem] bg-white border border-slate-200 p-6">
                    <h3 class="font-black text-slate-900">سجل النقاط</h3>
                    <p class="text-xs text-slate-500">من جدول <code>reputation_logs</code></p>
                    <div class="mt-4 space-y-3 max-h-96 overflow-auto">
                        @forelse($reputationLogs as $log)
                            <div class="rounded-xl bg-slate-50 border border-slate-200 px-3 py-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-black text-emerald-600">+{{ $log->points }}</span>
                                    <span class="text-[11px] text-slate-400">{{ $log->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-xs leading-5 text-slate-700 mt-1">{{ $log->reason }}</p>
                            </div>
                        @empty
                            <p class="text-sm text-slate-500 text-center py-8">لا يوجد سجل نقاط بعد.</p>
                        @endforelse
                    </div>
                </div>

                <div class="rounded-[1.5rem] bg-indigo-600 text-white p-6">
                    <h3 class="font-black">كيف تُحتسب النقاط؟</h3>
                    <p class="text-sm text-indigo-100 mt-2 leading-6">عند اعتماد إجابتك كحل، يُنشأ سجل في <code class="bg-white/20 px-1 rounded">reputation_logs</code> بالقيمة 10 والسبب، وتُضاف النقاط إلى <code>reputation_points</code>.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
