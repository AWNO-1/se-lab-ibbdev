<x-app-layout>
    {{-- Hero Section --}}
    <section class="relative overflow-hidden">
        <div class="absolute inset-0 -z-10 bg-gradient-to-b from-indigo-50 via-violet-50/50 to-white"></div>
        <div class="absolute -top-32 -left-32 size-[500px] rounded-full bg-indigo-200/30 blur-[100px]"></div>
        <div class="absolute -bottom-32 -right-32 size-[500px] rounded-full bg-violet-200/30 blur-[100px]"></div>

        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-20">
            <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center">
                {{-- Text --}}
                <div class="text-center lg:text-start">
                    <div class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-1.5 text-xs font-bold text-indigo-600 shadow-sm ring-1 ring-slate-200">
                        <span class="size-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        منصة جديدة كلياً — انضم لأكثر من 1,200 مطور
                    </div>
                    <h1 class="mt-6 text-4xl font-black leading-tight tracking-tight text-slate-900 sm:text-5xl lg:text-[48px]">
                        اطرح سؤالك.<br>
                        <span class="bg-gradient-to-l from-indigo-600 to-violet-600 bg-clip-text text-transparent">احصل على إجابة.</span><br>
                        اكسب السمعة.
                    </h1>
                    <p class="mt-5 text-base leading-8 text-slate-600 sm:text-lg">
                        IBBDev هي المساحة التفاعلية لطلاب علوم الحاسوب لتبادل الخبرات البرمجية — أسئلة حقيقية، إجابات مُجربة، ونظام نقاط يكافئ مساهمتك.
                    </p>

                    <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center lg:justify-start">
                        @auth
                            <a href="{{ route('questions.create') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-slate-900 px-7 py-3.5 text-sm font-bold text-white shadow-lg shadow-slate-900/20 hover:bg-indigo-600 transition hover:-translate-y-0.5">
                                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                                اطرح سؤالاً الآن
                            </a>
                            <a href="{{ route('questions.index') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-white px-7 py-3.5 text-sm font-bold text-slate-900 ring-1 ring-slate-200 hover:bg-slate-50 transition">
                                تصفح الأسئلة
                                <svg class="size-4 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-7 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-500/30 hover:bg-indigo-700 transition hover:-translate-y-0.5">
                                ابدأ مجاناً — سجل الآن
                                <svg class="size-4 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                            </a>
                            <a href="{{ route('questions.index') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-white px-7 py-3.5 text-sm font-bold text-slate-900 ring-1 ring-slate-200 hover:bg-slate-50 transition">
                                <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                                استعرض الأسئلة
                            </a>
                        @endauth
                    </div>

                    <div class="mt-8 flex items-center gap-6 justify-center lg:justify-start">
                        <div class="flex -space-x-2 rtl:space-x-reverse">
                            <img src="https://i.pravatar.cc/100?img=11" class="size-9 rounded-full ring-2 ring-white" alt="">
                            <img src="https://i.pravatar.cc/100?img=22" class="size-9 rounded-full ring-2 ring-white" alt="">
                            <img src="https://i.pravatar.cc/100?img=33" class="size-9 rounded-full ring-2 ring-white" alt="">
                            <span class="flex size-9 items-center justify-center rounded-full bg-slate-900 text-xs font-bold text-white ring-2 ring-white">+2k</span>
                        </div>
                        <div class="text-start">
                            <div class="flex items-center gap-1">
                                <svg class="size-4 text-amber-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                <span class="text-sm font-bold text-slate-900">4.9/5</span>
                                <span class="text-xs text-slate-500">من 847 تقييم</span>
                            </div>
                            <p class="text-xs text-slate-500">يثق بنا طلاب من 15 جامعة</p>
                        </div>
                    </div>
                </div>

                {{-- Mockup / Code Card --}}
                <div class="relative lg:ps-6">
                    <div class="relative rounded-[2rem] bg-white p-3 shadow-2xl shadow-slate-200 ring-1 ring-slate-200">
                        <div class="rounded-[1.5rem] bg-slate-950 p-6 text-start">
                            <div class="flex items-center gap-2 mb-5">
                                <span class="size-3 rounded-full bg-red-500"></span>
                                <span class="size-3 rounded-full bg-yellow-500"></span>
                                <span class="size-3 rounded-full bg-green-500"></span>
                                <span class="ms-auto text-xs font-mono text-slate-500">QuestionController.php</span>
                            </div>
                            <pre class="text-xs leading-6 font-mono overflow-hidden"><code class="text-slate-300"><span class="text-violet-400">public function</span> <span class="text-emerald-400">store</span>(StoreQuestionRequest <span class="text-sky-300">$request</span>) {
  <span class="text-violet-400">$question</span> = <span class="text-sky-300">$this</span>->service-><span class="text-emerald-400">create</span>([
    <span class="text-amber-300">'title'</span> => <span class="text-sky-300">$request</span>->title,
    <span class="text-amber-300">'body'</span>  => <span class="text-sky-300">$request</span>->body,
  ]);
  <span class="text-violet-400">return</span> <span class="text-sky-300">to_route</span>(<span class="text-amber-300">'questions.show'</span>, <span class="text-sky-300">$question</span>);
}</code></pre>
                            <div class="mt-6 flex items-center gap-3 rounded-xl bg-white/5 p-3 ring-1 ring-white/10">
                                <div class="size-8 rounded-lg bg-emerald-500 flex items-center justify-center">✓</div>
                                <div>
                                    <p class="text-xs font-bold text-white">تم اعتماد إجابتك!</p>
                                    <p class="text-[11px] text-slate-400">حصلت على +10 نقاط سمعة</p>
                                </div>
                                <span class="ms-auto text-xs font-mono text-emerald-400">+10</span>
                            </div>
                        </div>
                        {{-- Floating stats --}}
                        <div class="absolute -bottom-6 -left-6 hidden sm:flex items-center gap-3 rounded-2xl bg-white px-5 py-4 shadow-xl ring-1 ring-slate-200">
                            <div class="size-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white">
                                <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500">إجابات اليوم</p>
                                <p class="text-sm font-black text-slate-900">+127 إجابة</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Bar --}}
    <section class="border-y border-slate-200 bg-white/80 backdrop-blur">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 divide-x divide-slate-200 rtl:divide-x-reverse">
                @php
                    $stats = [
                        ['value' => \App\Models\User::count().'+', 'label' => 'مطور مسجل', 'sub' => 'من 15 جامعة'],
                        ['value' => \App\Models\Question::count().'+', 'label' => 'سؤال مطروح', 'sub' => 'يومياً +12'],
                        ['value' => \App\Models\Answer::count().'+', 'label' => 'إجابة موثقة', 'sub' => 'بنسبة 92% حل'],
                        ['value' => '4.9', 'label' => 'رضا المستخدمين', 'sub' => '847 تقييم'],
                    ];
                @endphp
                @foreach($stats as $stat)
                    <div class="px-6 py-8 text-center">
                        <p class="text-2xl font-black text-slate-900">{{ $stat['value'] }}</p>
                        <p class="text-sm font-bold text-slate-900">{{ $stat['label'] }}</p>
                        <p class="text-xs text-slate-500">{{ $stat['sub'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Features --}}
    <section class="py-16 sm:py-24 bg-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <span class="inline-flex rounded-full bg-indigo-50 px-3 py-1 text-xs font-bold text-indigo-600 ring-1 ring-indigo-200">المميزات</span>
                <h2 class="mt-4 text-3xl font-black text-slate-900 sm:text-4xl">كل ما تحتاجه للنمو كمطور</h2>
                <p class="mt-4 text-slate-600">منصة متكاملة بنيت بمبادئ هندسة البرمجيات — سريعة، آمنة، ومصممة للطلاب.</p>
            </div>

            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @php
                    $features = [
                        ['icon'=>'M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z','bg'=>'bg-indigo-600','title'=>'أسئلة مع صور','desc'=>'ارفع لقطات الأخطاء والكود ليحصل زملاؤك على سياق كامل ويساعدوك أسرع.'],
                        ['icon'=>'M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z','bg'=>'bg-violet-600','title'=>'ردود فورية','desc'=>'نظام إشعارات وتنبيهات يضمن وصول إجاباتك بسرعة وتفاعل المجتمع لحظياً.'],
                        ['icon'=>'M16.5 18.75h-9m9 0a3 3 0 013 3m-3-3a3 3 0 00-3 3m3-3v-6a3 3 0 00-3-3h-9a3 3 0 00-3 3v6a3 3 0 013 3m-3-3a3 3 0 003 3','bg'=>'bg-emerald-600','title'=>'سمعة ومكافآت','desc'=>'احصل على 10 نقاط عند اعتماد إجابتك كحل، وارتقِ في لوحة الشرف.'],
                        ['icon'=>'M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 16.5','bg'=>'bg-sky-600','title'=>'كود منسق','desc'=>'دعم لعرض الأكواد بألوان وتحديد لغة البرمجة لتسهيل القراءة والنسخ.'],
                        ['icon'=>'M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z','bg'=>'bg-amber-500','title'=>'حماية وسياسات','desc'=>'صلاحيات دقيقة عبر Policies: لا إجابة على سؤالك الخاص ولا اعتماد إلا لصاحب السؤال.'],
                        ['icon'=>'M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625c0-.621.504-1.125 1.125-1.125h17.25c.621 0 1.125.504 1.125 1.125v12.75c0 .621-.504 1.125-1.125 1.125H3.375a1.125 1.125 0 01-1.125-1.125V5.625c0-.621.504-1.125 1.125-1.125h17.25c.621 0 1.125.504 1.125 1.125v12.75c0 .621-.504 1.125-1.125 1.125H3.375z','bg'=>'bg-rose-600','title'=>'Blade + Tailwind','desc'=>'واجهات Blade سريعة وخفيفة بدون React الثقيل — تجربة مستخدم فورية ومتجاوبة.'],
                    ];
                @endphp
                @foreach($features as $f)
                    <div class="group rounded-[1.5rem] border border-slate-200 bg-slate-50/50 p-6 hover:bg-white hover:shadow-xl hover:-translate-y-1 transition">
                        <div class="size-11 rounded-xl {{ $f['bg'] }} flex items-center justify-center text-white shadow-lg">
                            <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $f['icon'] }}"/></svg>
                        </div>
                        <h3 class="mt-4 font-bold text-slate-900">{{ $f['title'] }}</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-600">{{ $f['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- How it works --}}
    <section class="py-16 bg-slate-950 text-white rounded-[2.5rem] mx-4 sm:mx-6 lg:mx-8 overflow-hidden relative">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/20 via-violet-600/20 to-transparent"></div>
        <div class="relative mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <span class="rounded-full bg-white/10 px-3 py-1 text-xs font-bold text-indigo-200 ring-1 ring-white/10">كيف يعمل</span>
                <h2 class="mt-4 text-3xl font-black sm:text-4xl">3 خطوات لتصبح خبيراً</h2>
            </div>
            <div class="mt-12 grid gap-8 md:grid-cols-3">
                @php
                    $steps = [
                        ['n'=>'01','t'=>'اطرح سؤالك','d'=>'اكتب عنواناً واضحاً، أضف تفاصيل الكود، وارفع صورة الخطأ إن وجدت.'],
                        ['n'=>'02','t'=>'احصل على إجابات','d'=>'المجتمع يراجع سؤالك ويقدم حلولاً مجربة مع شروحات مفصلة.'],
                        ['n'=>'03','t'=>'اعتمد الحل واكسب','d'=>'اختر الإجابة الأفضل كحل معتمد وامنح صاحبها 10 نقاط سمعة.'],
                    ];
                @endphp
                @foreach($steps as $i => $s)
                    <div class="relative rounded-2xl bg-white/5 p-6 ring-1 ring-white/10 backdrop-blur">
                        <span class="text-5xl font-black text-white/10">{{ $s['n'] }}</span>
                        <h3 class="mt-2 font-bold">{{ $s['t'] }}</h3>
                        <p class="mt-2 text-sm leading-6 text-slate-300">{{ $s['d'] }}</p>
                        @if($i < 2)
                            <div class="hidden md:block absolute top-1/2 -left-4 rtl:-right-4 w-8 h-0.5 bg-white/20"></div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Latest Questions --}}
    <section class="py-16 sm:py-24 bg-slate-50">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-end justify-between gap-4">
                <div>
                    <span class="rounded-full bg-white px-3 py-1 text-xs font-bold text-indigo-600 ring-1 ring-slate-200">الأسئلة الحديثة</span>
                    <h2 class="mt-3 text-2xl font-black text-slate-900">نقاشات حية الآن</h2>
                </div>
                <a href="{{ route('questions.index') }}" class="rounded-xl bg-white px-5 py-2.5 text-sm font-bold text-slate-900 ring-1 ring-slate-200 hover:bg-slate-900 hover:text-white transition">عرض كل الأسئلة</a>
            </div>

            @php
                $latestQuestions = \App\Models\Question::with(['user','answers'])->latest()->take(3)->get();
            @endphp
            <div class="mt-8 grid gap-6 md:grid-cols-3">
                @forelse($latestQuestions as $q)
                    <a href="{{ route('questions.show', $q) }}" class="group rounded-2xl bg-white p-6 border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition">
                        <div class="flex items-center gap-2 text-xs text-slate-500">
                            <span class="size-7 rounded-full bg-indigo-100 flex items-center justify-center font-bold text-indigo-600">{{ mb_substr($q->user->name,0,1) }}</span>
                            {{ $q->user->name }} · {{ $q->created_at->diffForHumans() }}
                        </div>
                        <h3 class="mt-3 font-bold text-slate-900 line-clamp-2 group-hover:text-indigo-600 transition">{{ $q->title }}</h3>
                        <p class="mt-2 text-sm text-slate-600 line-clamp-2">{{ Str::limit(strip_tags($q->body), 100) }}</p>
                        <div class="mt-4 flex items-center gap-3 text-xs">
                            <span class="rounded-full bg-slate-100 px-2.5 py-1 font-bold">{{ $q->answers->count() }} إجابة</span>
                            @if($q->answers->where('is_accepted', true)->count()) <span class="rounded-full bg-emerald-100 text-emerald-700 px-2.5 py-1 font-bold">محلول ✓</span> @endif
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 rounded-2xl border border-dashed p-8 text-center text-slate-500">لا توجد أسئلة بعد</div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-indigo-600 to-violet-600 px-6 py-12 sm:px-12 sm:py-16 text-white">
                <div class="absolute -top-20 -left-20 size-64 rounded-full bg-white/10 blur-3xl"></div>
                <div class="relative grid lg:grid-cols-2 gap-8 items-center">
                    <div>
                        <h2 class="text-3xl font-black sm:text-4xl">جاهز للانطلاق؟</h2>
                        <p class="mt-3 text-indigo-100">أنشئ حسابك في أقل من 30 ثانية وابدأ بطرح أول سؤال لك. المجتمع بانتظارك.</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3 lg:justify-end">
                        @guest
                            <a href="{{ route('register') }}" class="rounded-2xl bg-white px-8 py-3.5 text-center text-sm font-black text-indigo-600 hover:bg-indigo-50 transition">إنشاء حساب مجاني</a>
                            <a href="{{ route('login') }}" class="rounded-2xl bg-indigo-700 px-8 py-3.5 text-center text-sm font-bold text-white ring-1 ring-white/20 hover:bg-indigo-800 transition">تسجيل الدخول</a>
                        @else
                            <a href="{{ route('questions.create') }}" class="rounded-2xl bg-white px-8 py-3.5 text-center text-sm font-black text-indigo-600">اطرح سؤالك الآن</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
