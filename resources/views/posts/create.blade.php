<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-indigo-600">إنشاء محتوى جديد</p>
                <h1 class="text-2xl font-black text-slate-900 sm:text-3xl">اطرح سؤالاً جديداً</h1>
                <p class="mt-2 text-sm leading-6 text-slate-500">شارك سؤالك البرمجي مع المجتمع واحصل على إجابات موثوقة.</p>
            </div>
            <a href="{{ route('posts.index') }}" class="hidden sm:inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-bold text-slate-700 ring-1 ring-slate-200 hover:bg-slate-50 transition">
                <svg class="size-4 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 19.5L3 12m0 0l-7.5-7.5M3 12h18"/></svg>
                العودة
            </a>
        </div>
    </x-slot>

    <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-8">
            {{-- Form --}}
            <div class="lg:col-span-2">
                <div class="rounded-[1.75rem] bg-white border border-slate-200 shadow-sm overflow-hidden">
                    <div class="bg-gradient-to-l from-indigo-600 to-violet-600 px-6 py-5">
                        <h2 class="font-black text-white flex items-center gap-2">
                            <span class="size-8 rounded-xl bg-white/20 flex items-center justify-center">
                                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                            </span>
                            بيانات السؤال
                        </h2>
                        <p class="text-xs text-indigo-100 mt-1">املأ الحقول التالية بدقة لمساعدة المجتمع على فهم مشكلتك</p>
                    </div>

                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6" x-data="{ title: '{{ old('title') }}', body: `{{ old('body') }}` }">
                        @csrf

                        <div>
                            <label class="block text-sm font-black text-slate-900">عنوان السؤال <span class="text-red-500">*</span></label>
                            <p class="text-xs text-slate-500 mt-1">كن واضحاً ومحدداً — مثال: "كيف أحل خطأ NullPointer في Java؟"</p>
                            <input type="text" name="title" x-model="title" value="{{ old('title') }}" maxlength="255" placeholder="اكتب عنواناً يلخص مشكلتك..." class="mt-3 w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-indigo-500 transition @error('title') border-red-300 bg-red-50 @enderror" required>
                            <div class="mt-2 flex justify-between text-xs">
                                <span class="font-medium" :class="title.length > 250 ? 'text-red-600' : 'text-slate-400'" x-text="title.length + '/255'"></span>
                                @error('title') <span class="font-bold text-red-600">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-black text-slate-900">وصف المشكلة <span class="text-red-500">*</span></label>
                            <p class="text-xs text-slate-500 mt-1">اشرح ما جربته، وما تتوقعه، وأرفق كود إن أمكن</p>
                            <textarea name="body" x-model="body" rows="7" placeholder="مثال: أواجه خطأ عند تشغيل الكود التالي...&#10;الكود: ...&#10;الخطأ: ..." class="mt-3 w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-3 text-sm placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-indigo-500 transition resize-none @error('body') border-red-300 bg-red-50 @enderror" required>{{ old('body') }}</textarea>
                            <div class="mt-2 flex justify-between text-xs">
                                <span class="font-medium" :class="body.length < 10 ? 'text-amber-600' : 'text-slate-400'" x-text="body.length + ' حرف (الحد الأدنى 10)'"></span>
                                @error('body') <span class="font-bold text-red-600">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div x-data="{ preview: null, dragover: false }">
                            <label class="block text-sm font-black text-slate-900">صورة توضيحية <span class="text-slate-400 font-medium">(اختياري)</span></label>
                            <p class="text-xs text-slate-500 mt-1">ارفع لقطة شاشة للخطأ — PNG, JPG حتى 2MB — سيتم حفظها في <code class="bg-slate-100 px-1 rounded">image_path</code></p>

                            <div @dragover.prevent="dragover=true" @dragleave="dragover=false" @drop.prevent="dragover=false; const f=$event.dataTransfer.files[0]; if(f){ $refs.input.files=$event.dataTransfer.files; preview=URL.createObjectURL(f) }"
                                 :class="dragover ? 'border-indigo-500 bg-indigo-50' : 'border-slate-200 bg-slate-50'"
                                 class="mt-3 relative rounded-2xl border-2 border-dashed p-6 text-center hover:border-indigo-300 hover:bg-indigo-50/50 transition">
                                <input x-ref="input" type="file" name="image_path" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer" @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null">
                                
                                <template x-if="!preview">
                                    <div class="pointer-events-none">
                                        <div class="mx-auto size-12 rounded-xl bg-white border border-slate-200 flex items-center justify-center shadow-sm">
                                            <svg class="size-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                                        </div>
                                        <p class="mt-3 text-sm font-bold text-slate-900">اسحب الصورة هنا أو اضغط للاختيار</p>
                                        <p class="text-xs text-slate-500">PNG, JPG, WEBP حتى 2MB</p>
                                    </div>
                                </template>

                                <template x-if="preview">
                                    <div class="relative">
                                        <img :src="preview" class="mx-auto max-h-64 rounded-xl border border-slate-200 shadow-sm">
                                        <button type="button" @click="preview=null; $refs.input.value=''" class="absolute -top-2 -right-2 size-8 rounded-full bg-red-600 text-white flex items-center justify-center shadow hover:bg-red-700 transition">×</button>
                                        <p class="mt-2 text-xs font-medium text-emerald-600">✓ تم اختيار الصورة — سيتم رفعها عند الإرسال</p>
                                    </div>
                                </template>
                            </div>
                            @error('image_path') <p class="mt-2 text-xs font-bold text-red-600">{{ $message }}</p> @enderror
                            @error('image') <p class="mt-2 text-xs font-bold text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex gap-3 pt-4">
                            <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-6 py-3.5 text-sm font-black text-white shadow-lg shadow-indigo-500/20 hover:bg-indigo-700 hover:-translate-y-0.5 transition">
                                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
                                نشر السؤال
                            </button>
                            <a href="{{ route('posts.index') }}" class="rounded-xl bg-white px-6 py-3.5 text-sm font-bold text-slate-700 ring-1 ring-slate-200 hover:bg-slate-50 transition">إلغاء</a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Sidebar Tips --}}
            <div class="space-y-6">
                <div class="rounded-[1.5rem] bg-slate-900 text-white p-6">
                    <h3 class="font-black flex items-center gap-2">
                        <span class="size-7 rounded-lg bg-white/10 flex items-center justify-center">💡</span>
                        نصائح لسؤال مميز
                    </h3>
                    <ul class="mt-4 space-y-3 text-sm leading-6 text-slate-300">
                        <li class="flex gap-2"><span class="text-emerald-400">•</span> اكتب عنواناً يصف المشكلة بدقة، لا "ساعدوني"</li>
                        <li class="flex gap-2"><span class="text-emerald-400">•</span> أضف الكود والخطأ كاملاً مع لقطة شاشة</li>
                        <li class="flex gap-2"><span class="text-emerald-400">•</span> اذكر ما جربته وما تتوقعه</li>
                        <li class="flex gap-2"><span class="text-emerald-400">•</span> سيحصل المجيب على +10 نقاط عند اعتماد حله</li>
                    </ul>
                </div>

                <div class="rounded-[1.5rem] bg-white border border-slate-200 p-6">
                    <h3 class="font-black text-slate-900">كيف يعمل النظام؟</h3>
                    <ol class="mt-4 space-y-3">
                        <li class="flex gap-3">
                            <span class="size-7 rounded-full bg-indigo-600 text-white flex items-center justify-center text-xs font-black">1</span>
                            <p class="text-sm text-slate-600"><span class="font-bold text-slate-900">تطرح سؤالك</span> مع <code>image_path</code> إن وجد</p>
                        </li>
                        <li class="flex gap-3">
                            <span class="size-7 rounded-full bg-violet-600 text-white flex items-center justify-center text-xs font-black">2</span>
                            <p class="text-sm text-slate-600"><span class="font-bold text-slate-900">يجيب المجتمع</span> ويُناقش الحلول</p>
                        </li>
                        <li class="flex gap-3">
                            <span class="size-7 rounded-full bg-emerald-600 text-white flex items-center justify-center text-xs font-black">3</span>
                            <p class="text-sm text-slate-600"><span class="font-bold text-slate-900">تعتمد الحل</span> → <code>is_solved=true</code> + <code>reputation_logs</code></p>
                        </li>
                    </ol>
                </div>

                <div class="rounded-[1.5rem] bg-amber-50 border border-amber-200 p-5">
                    <p class="text-xs font-black text-amber-900">ℹ️ ملاحظة</p>
                    <p class="text-xs leading-5 text-amber-800 mt-1">سيتم حفظ الصورة في <code>storage/app/public/posts</code> وعرضها عبر <code>asset('storage/'.image_path)</code>. الحقل <code>is_solved</code> يبقى <code>false</code> حتى تعتمد إجابة.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
