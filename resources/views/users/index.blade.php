<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-indigo-600">المجتمع</p>
                <h1 class="text-2xl font-black text-slate-900 sm:text-3xl">المطورون</h1>
                <p class="mt-2 text-sm text-slate-500">استكشف أعضاء المنصة، سمعتهم، ومساهماتهم.</p>
            </div>
            <div class="flex items-center gap-2 text-xs">
                <span class="rounded-full bg-white px-3 py-1.5 font-bold text-slate-700 ring-1 ring-slate-200">{{ $users->total() }} عضو</span>
            </div>
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        {{-- Search --}}
        <div class="rounded-[1.5rem] bg-white border border-slate-200 p-4 sm:p-5">
            <form method="GET" action="{{ route('users.index') }}" class="flex gap-3">
                <div class="flex-1 relative">
                    <svg class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 size-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="ابحث بالاسم أو @username..." class="w-full rounded-xl border-slate-200 bg-slate-50 px-10 py-3 text-sm focus:border-indigo-500 focus:bg-white focus:ring-indigo-500">
                </div>
                <button type="submit" class="rounded-xl bg-slate-900 px-6 py-3 text-sm font-black text-white hover:bg-indigo-600 transition">بحث</button>
                @if(request('search'))
                    <a href="{{ route('users.index') }}" class="rounded-xl bg-white px-6 py-3 text-sm font-bold text-slate-700 ring-1 ring-slate-200 hover:bg-slate-50 transition">مسح</a>
                @endif
            </form>
        </div>

        {{-- Grid --}}
        <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($users as $user)
                <a href="{{ route('users.show', $user) }}" class="group relative overflow-hidden rounded-[1.5rem] bg-white border border-slate-200 p-6 hover:border-indigo-200 hover:shadow-xl hover:-translate-y-1 transition">
                    <div class="absolute top-0 inset-x-0 h-16 bg-gradient-to-l from-indigo-600 to-violet-600 opacity-90"></div>
                    <div class="relative flex flex-col items-center text-center">
                        <div class="size-20 rounded-2xl overflow-hidden bg-white border-4 border-white shadow -mt-2">
                            @if($user->avatar_path)
                                <img src="{{ Str::startsWith($user->avatar_path, ['http://','https://']) ? $user->avatar_path : asset('storage/'.$user->avatar_path) }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                            @else
                                <div class="h-full w-full flex items-center justify-center bg-slate-100 text-xl font-black text-slate-400">{{ mb_substr($user->name,0,1) }}</div>
                            @endif
                        </div>
                        <h3 class="mt-3 font-black text-slate-900 group-hover:text-indigo-600 transition">{{ $user->name }}</h3>
                        <p class="text-xs font-bold text-indigo-600">{{ '@'.$user->username }}</p>
                        <p class="text-xs text-slate-500 truncate max-w-full">{{ $user->email }}</p>

                        <div class="mt-4 grid grid-cols-3 gap-3 w-full">
                            <div class="rounded-xl bg-slate-50 border border-slate-200 py-2">
                                <p class="text-sm font-black text-slate-900">{{ $user->posts_count }}</p>
                                <p class="text-[11px] font-bold text-slate-500">سؤال</p>
                            </div>
                            <div class="rounded-xl bg-indigo-50 border border-indigo-200 py-2">
                                <p class="text-sm font-black text-indigo-600">{{ $user->answers_count }}</p>
                                <p class="text-[11px] font-bold text-slate-500">إجابة</p>
                            </div>
                            <div class="rounded-xl bg-amber-50 border border-amber-200 py-2">
                                <p class="text-sm font-black text-amber-600">{{ $user->reputation_points }}</p>
                                <p class="text-[11px] font-bold text-slate-500">نقطة</p>
                            </div>
                        </div>

                        <span class="mt-4 inline-flex items-center gap-1 text-xs font-bold text-indigo-600 group-hover:gap-2 transition">
                            عرض الملف
                            <svg class="size-3 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        </span>
                    </div>
                </a>
            @empty
                <div class="col-span-full rounded-[1.75rem] bg-white border-2 border-dashed border-slate-200 p-12 text-center">
                    <p class="font-black text-slate-900">لا يوجد مستخدمون</p>
                    <p class="text-sm text-slate-500 mt-1">جرب بحثاً آخر.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
