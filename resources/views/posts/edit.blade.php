<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-amber-600">تعديل السؤال</p>
                <h1 class="text-2xl font-black text-slate-900 sm:text-3xl">تعديل: {{ Str::limit($post->title, 50) }}</h1>
                <p class="mt-2 text-sm text-slate-500">قم بتحديث عنوان أو وصف سؤالك — التغييرات تظهر فوراً.</p>
            </div>
            <a href="{{ route('posts.show', $post) }}" class="hidden sm:inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-bold text-slate-700 ring-1 ring-slate-200 hover:bg-slate-50 transition">
                <svg class="size-4 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 19.5L3 12m0 0l-7.5-7.5M3 12h18"/></svg>
                عرض السؤال
            </a>
        </div>
    </x-slot>

    <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="rounded-[1.75rem] bg-white border border-slate-200 shadow-sm overflow-hidden">
                    <div class="bg-gradient-to-l from-amber-500 to-orange-600 px-6 py-5">
                        <h2 class="font-black text-white flex items-center gap-2">
                            <span class="size-8 rounded-xl bg-white/20 flex items-center justify-center">
                                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </span>
                            تعديل البيانات
                        </h2>
                    </div>

                    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-sm font-black text-slate-900">العنوان</label>
                            <input type="text" name="title" value="{{ old('title', $post->title) }}" class="mt-2 w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-amber-500 focus:bg-white focus:ring-amber-500 @error('title') border-red-300 bg-red-50 @enderror" required>
                            @error('title') <p class="mt-2 text-xs font-bold text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-black text-slate-900">الوصف</label>
                            <textarea name="body" rows="7" class="mt-2 w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-amber-500 focus:bg-white focus:ring-amber-500 resize-none @error('body') border-red-300 bg-red-50 @enderror" required>{{ old('body', $post->body) }}</textarea>
                            @error('body') <p class="mt-2 text-xs font-bold text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-black text-slate-900">الصورة الحالية</label>
                            @if($post->image_path)
                                <div class="mt-3 rounded-xl overflow-hidden border border-slate-200">
                                    @if(Str::startsWith($post->image_path, ['http://','https://']))
                                        <img src="{{ $post->image_path }}" class="w-full max-h-64 object-cover">
                                    @else
                                        <img src="{{ asset('storage/'.$post->image_path) }}" class="w-full max-h-64 object-cover">
                                    @endif
                                    <p class="bg-slate-50 px-3 py-2 text-xs text-slate-500"><code>image_path:</code> {{ $post->image_path }}</p>
                                </div>
                            @else
                                <p class="mt-2 text-xs text-slate-500">لا توجد صورة مرفقة حالياً.</p>
                            @endif
                        </div>

                        <div x-data="{ preview: null }">
                            <label class="block text-sm font-black text-slate-900">استبدال الصورة (اختياري)</label>
                            <input type="file" name="image_path" accept="image/*" class="mt-2 w-full rounded-xl border-slate-200 bg-white px-4 py-3 text-sm file:mr-4 file:rounded-lg file:border-0 file:bg-slate-900 file:px-4 file:py-2 file:text-xs file:font-bold file:text-white hover:file:bg-slate-800" @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null">
                            <template x-if="preview">
                                <img :src="preview" class="mt-3 max-h-48 rounded-xl border border-slate-200">
                            </template>
                            <p class="mt-2 text-xs text-slate-500">اتركه فارغاً للاحتفاظ بالصورة الحالية. سيتم حذف القديمة تلقائياً.</p>
                            @error('image_path') <p class="mt-2 text-xs font-bold text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex items-center gap-3 rounded-xl bg-slate-50 border border-slate-200 p-4">
                            <input type="hidden" name="is_solved" value="0">
                            <input type="checkbox" name="is_solved" value="1" {{ old('is_solved', $post->is_solved) ? 'checked' : '' }} class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                            <div>
                                <p class="text-sm font-bold text-slate-900">وضع علامة محلول؟</p>
                                <p class="text-xs text-slate-500"><code>is_solved</code> — يُحدث تلقائياً عند اعتماد إجابة، لكن يمكنك تعديله يدوياً.</p>
                            </div>
                        </div>

                        <div class="flex gap-3 pt-2">
                            <button type="submit" class="flex-1 rounded-xl bg-amber-500 px-6 py-3.5 text-sm font-black text-white shadow-lg shadow-amber-500/20 hover:bg-amber-600 transition">
                                حفظ التعديلات
                            </button>
                            <a href="{{ route('posts.show', $post) }}" class="rounded-xl bg-white px-6 py-3.5 text-sm font-bold text-slate-700 ring-1 ring-slate-200 hover:bg-slate-50 transition">إلغاء</a>
                        </div>
                    </form>
                </div>

                {{-- Danger Zone --}}
                <div class="mt-6 rounded-[1.5rem] bg-red-50 border border-red-200 p-6">
                    <h3 class="font-black text-red-900 flex items-center gap-2">
                        <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                        منطقة الخطر
                    </h3>
                    <p class="text-sm text-red-700 mt-2">حذف السؤال سيحذف جميع إجاباته وسجلات النقاط المرتبطة بشكل نهائي.</p>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="mt-4" onsubmit="return confirm('هل أنت متأكد من حذف السؤال؟ لا يمكن التراجع.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-xl bg-red-600 px-5 py-2.5 text-sm font-bold text-white hover:bg-red-700 transition">حذف السؤال نهائياً</button>
                    </form>
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-[1.5rem] bg-white border border-slate-200 p-6">
                    <h3 class="font-black text-slate-900">معلومات السؤال</h3>
                    <dl class="mt-4 space-y-3 text-sm">
                        <div class="flex justify-between"><dt class="text-slate-500">المعرف</dt><dd class="font-mono font-bold">#{{ $post->id }}</dd></div>
                        <div class="flex justify-between"><dt class="text-slate-500">الحالة</dt><dd class="font-bold {{ $post->is_solved ? 'text-emerald-600' : 'text-amber-600' }}">{{ $post->is_solved ? 'محلول ✓' : 'مفتوح' }}</dd></div>
                        <div class="flex justify-between"><dt class="text-slate-500">الإجابات</dt><dd class="font-bold">{{ $post->answers->count() }}</dd></div>
                        <div class="flex justify-between"><dt class="text-slate-500">تاريخ الإنشاء</dt><dd class="text-slate-700">{{ $post->created_at->format('Y-m-d') }}</dd></div>
                        <div class="flex justify-between"><dt class="text-slate-500">صاحب السؤال</dt><dd class="font-bold">{{ $post->user->name }}</dd></div>
                    </dl>
                </div>
                <div class="rounded-[1.5rem] bg-indigo-50 border border-indigo-200 p-5">
                    <p class="text-xs font-black text-indigo-900">💡 تلميح</p>
                    <p class="text-xs leading-5 text-indigo-800 mt-1">تعديل السؤال لا يؤثر على النقاط الممنوحة سابقاً. النقاط تُسجل في <code>reputation_logs</code> للشفافية.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
