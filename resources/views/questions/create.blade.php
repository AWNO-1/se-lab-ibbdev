<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-indigo-600">مرحبًا {{ Auth::user()->name }}</p>
            <h1 class="text-2xl font-bold text-slate-950 sm:text-3xl">طرح سؤال جديد</h1>
            <p class="mt-2 text-sm leading-6 text-slate-500">شارك سؤالاً برمجياً مع المجتمع.</p>
        </div>
    </x-slot>

    <div class="mx-auto max-w-2xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg p-8 border border-slate-200">
            <form action="{{ route('questions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-slate-700 font-medium mb-2">عنوان السؤال <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('title') border-red-300 @enderror" required>
                    @error('title')
                        <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-slate-700 font-medium mb-2">وصف السؤال <span class="text-red-500">*</span></label>
                    <textarea name="body" rows="4" class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('body') border-red-300 @enderror" required>{{ old('body') }}</textarea>
                    @error('body')
                        <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-slate-700 font-medium mb-2">صورة إضافية (اختياري)</label>
                    <input type="file" name="image" accept="image/*" class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('image') border-red-300 @enderror">
                    @error('image')
                        <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                            class="flex-1 rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white transition hover:-translate-y-0.5 hover:bg-indigo-500">
                        طرح السؤال
                    </button>
                    <a href="{{ route('questions.index') }}"
                       class="flex-1 rounded-2xl bg-slate-100 px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-200 transition">
                        إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>