<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="mb-2 text-xs font-bold uppercase tracking-[0.2em] text-indigo-600">مرحبًا {{ Auth::user()->name }}</p>
            <h1 class="text-2xl font-bold text-slate-950 sm:text-3xl">تفاصيل السؤال</h1>
            <p class="mt-2 text-sm leading-6 text-slate-500">اقرأ السؤال وقدم إجابتك.</p>
        </div>
    </x-slot>

    <div class="mx-auto max-w-2xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg p-8 border border-slate-200">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-slate-900 mb-2">{{ $question->title }}</h2>
                <p class="text-slate-500 leading-relaxed">{{ strip_tags($question->body) }}</p>

                @if($question->image)
                    <div class="mt-4">
                        <img src="{{ asset('storage/'.$question->image) }}"
                             class="w-full rounded-lg my-4 border border-indigo-200"
                             alt="صورة السؤال">
                    </div>
                @endif

                <div class="mt-6 pt-6 border-t border-slate-100">
                    <h3 class="text-slate-700 font-medium mb-3">إجابات {{ $question->answers->count() }} {{ $question->answers->count() == 1 ? 'إجابة' : 'إجابات' }}</h3>

                    @foreach($question->answers as $answer)
                        <div class="mb-4 p-4 bg-slate-50 rounded-lg border-l-4 border-indigo-500">
                            <p class="text-slate-800">{{ nl2br(e($answer->body)) }}</p>
                            <div class="mt-2 text-slate-500 text-sm">
                                بواسطة <strong>{{ $answer->user->name }}</strong>
                                @can('accept', $answer)
                                    <a href="{{ route('answers.accept', $answer->id) }}"
                       class="text-indigo-600 hover underline small">اعتماد كحل</a>
                                @endcan
                            </div>
                        </div>
                    @endforeach

                    @if($question->user_id != auth()->id())
                        @if(!$question->answers->where('is_accepted', true)->first())
                            <form action="{{ route('answers.accept', $question->answers->first()) }}" method="POST" class="mt-4">
                                @csrf
                                <button type="submit"
                                        class="w-full rounded-xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white">
                                    اعتماد الإجابة الأولى
                                </button>
                            </form>
                        @endif
                        @unless($question->answers->where('is_accepted', true)->first())
                            <p class="mt-2 text-sm text-slate-400">يمكنك اعتماد إجابة واحدة فقط</p>
                        @endunless
                        @unless($question->answers->where('is_accepted', true)->first())
                            @if($question->answers->where('is_accepted', false)->first())
                                <p class="mt-2 text-sm text-slate-400">يمكنك اعتماد <strong>{{ $question->answers->where('is_accepted', false)->first()->user->name }}</strong>'s answer</p>
                            @endif
                        @unless
                        @endif
                        @if($question->user_id != auth()->id())
                            @if(!$question->answers->where('is_accepted', true)->first())
                                <p class="mt-2 text-sm text-slate-400">يمكنك اعتماد <strong>{{ $question->answers->where('is_accepted', false)->first()->user->name }}</strong>'s answer</p>
                            @endif
                        @endif
                    @endif
                </div>
            </div>

            @if(auth()->check() && auth()->id() != $question->user_id)
                <div class="mt-8 pt-8 border-t border-slate-100">
                    <h3 class="text-slate-700 font-medium mb-3">أضف إجابة جديدة</h3>
                    <form action="{{ route('answers.store', $question->id) }}" method="POST" class>
                        @csrf
                        <textarea name="body" rows="3"
                                  class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition required"
                                  placeholder="اكتب إجابتك هنا..."></textarea>
                        @error('body')
                            <p class="mt-2 text-red-600 text-sm">{{ $error }}</p>
                        @enderror
                        <div class="mt-4">
                            <button type="submit"
                                    class="w-full rounded-xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white">
                                إضافة إجابة
                            </button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>