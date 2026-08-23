<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="size-14 rounded-2xl overflow-hidden bg-white border border-slate-200 shadow-sm">
                    @if($user->avatar_path)
                        <img src="{{ Str::startsWith($user->avatar_path, ['http://','https://']) ? $user->avatar_path : asset('storage/'.$user->avatar_path) }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                    @else
                        <div class="h-full w-full flex items-center justify-center bg-indigo-600 text-white font-black text-xl">{{ mb_substr($user->name,0,1) }}</div>
                    @endif
                </div>
                <div>
                    <h2 class="text-xl font-black text-slate-900 flex items-center gap-2">
                        {{ $user->name }}
                        <span class="rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-bold text-indigo-700 ring-1 ring-indigo-200">{{ '@'.$user->username }}</span>
                    </h2>
                    <p class="text-sm text-slate-500">{{ $user->email }} · <span class="font-bold text-emerald-600">{{ $user->reputation_points }} نقطة</span> · عضو منذ {{ $user->created_at->format('Y/m') }}</p>
                </div>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('posts.index', ['filter'=>'my']) }}" class="rounded-xl bg-white px-4 py-2 text-sm font-bold text-slate-700 ring-1 ring-slate-200 hover:bg-slate-50 transition">أسئلتي</a>
                <a href="{{ route('posts.create') }}" class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-bold text-white hover:bg-indigo-700 transition">سؤال جديد</a>
            </div>
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        {{-- Stats --}}
        <div class="grid grid-cols-3 gap-4 mb-8">
            <div class="rounded-2xl bg-white border border-slate-200 p-5 text-center">
                <p class="text-2xl font-black text-slate-900">{{ $user->posts()->count() }}</p>
                <p class="text-xs font-bold text-slate-500">سؤال</p>
            </div>
            <div class="rounded-2xl bg-white border border-slate-200 p-5 text-center">
                <p class="text-2xl font-black text-indigo-600">{{ $user->answers()->count() }}</p>
                <p class="text-xs font-bold text-slate-500">إجابة</p>
            </div>
            <div class="rounded-2xl bg-gradient-to-br from-amber-500 to-orange-600 p-5 text-center text-white">
                <p class="text-2xl font-black">{{ $user->reputation_points }}</p>
                <p class="text-xs font-bold text-white/80">نقطة سمعة</p>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-6">
            {{-- Profile Form --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="rounded-[1.75rem] bg-white border border-slate-200 shadow-sm p-6 sm:p-8">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="rounded-[1.75rem] bg-white border border-slate-200 shadow-sm p-6 sm:p-8">
                    @include('profile.partials.update-password-form')
                </div>

                <div class="rounded-[1.75rem] bg-red-50 border border-red-200 p-6 sm:p-8">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            {{-- Sidebar: Reputation Logs + Recent Posts --}}
            <div class="space-y-6">
                <div class="rounded-[1.75rem] bg-white border border-slate-200 p-6">
                    <h3 class="font-black text-slate-900 flex items-center gap-2">
                        <span class="size-7 rounded-lg bg-amber-100 flex items-center justify-center">⭐</span>
                        سجل النقاط
                    </h3>
                    <p class="text-xs text-slate-500 mt-1">جدول <code>reputation_logs</code> — الشفافية</p>
                    <div class="mt-4 space-y-3 max-h-72 overflow-auto">
                        @forelse($user->reputationLogs()->latest()->take(6)->get() as $log)
                            <div class="flex items-center justify-between rounded-xl bg-slate-50 px-3 py-2.5 border border-slate-200">
                                <div class="min-w-0 flex-1">
                                    <p class="truncate text-xs font-bold text-slate-900">+{{ $log->points }} نقطة</p>
                                    <p class="truncate text-[11px] text-slate-500">{{ $log->reason }}</p>
                                </div>
                                <span class="text-[11px] text-slate-400">{{ $log->created_at->diffForHumans() }}</span>
                            </div>
                        @empty
                            <p class="text-sm text-slate-500 text-center py-6">لا توجد نقاط بعد — اعتمد إجاباتك!</p>
                        @endforelse
                    </div>
                </div>

                <div class="rounded-[1.75rem] bg-slate-900 text-white p-6">
                    <h3 class="font-black">نصائح الملف</h3>
                    <ul class="mt-3 space-y-2 text-sm text-slate-300 leading-6">
                        <li>• استخدم اسم مستخدم فريد مثل <code>@ahmed_dev</code></li>
                        <li>• ارفع صورة واضحة — تظهر بجانب كل سؤال</li>
                        <li>• نقاطك تزداد تلقائياً عند اعتماد إجابتك</li>
                    </ul>
                    <a href="{{ route('faqs') }}" class="mt-4 inline-flex rounded-xl bg-white px-4 py-2 text-xs font-black text-slate-900 hover:bg-slate-100 transition">الأسئلة الشائعة</a>
                </div>

                <div class="rounded-[1.75rem] bg-white border border-slate-200 p-6">
                    <h3 class="font-black text-slate-900">أسئلتي الأخيرة</h3>
                    <div class="mt-4 space-y-3">
                        @forelse($user->posts()->latest()->take(3)->get() as $post)
                            <a href="{{ route('posts.show', $post) }}" class="block rounded-xl border border-slate-200 p-3 hover:border-indigo-200 hover:bg-indigo-50/50 transition">
                                <p class="text-sm font-bold text-slate-900 line-clamp-1">{{ $post->title }}</p>
                                <p class="text-xs text-slate-500 mt-1">{{ $post->created_at->diffForHumans() }} · {{ $post->is_solved ? 'محلول ✓' : 'مفتوح' }} · {{ $post->answers()->count() }} إجابة</p>
                            </a>
                        @empty
                            <p class="text-sm text-slate-500">لم تطرح أي سؤال بعد.</p>
                        @endforelse
                        <a href="{{ route('posts.index', ['filter'=>'my']) }}" class="block text-center text-xs font-bold text-indigo-600 hover:underline">عرض كل أسئلتي →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
