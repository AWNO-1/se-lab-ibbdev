<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="mx-auto size-12 rounded-2xl bg-gradient-to-br from-indigo-600 to-violet-600 flex items-center justify-center text-white shadow-lg">
            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
        </div>
        <h1 class="mt-4 text-2xl font-black text-slate-900">إنشاء حساب جديد</h1>
        <p class="mt-2 text-sm text-slate-500">انضم إلى IBBDev — اسم مستخدم فريد، صورة شخصية، وابدأ رحلتك</p>
    </div>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-5" x-data="{ avatarPreview: null }">
        @csrf

        {{-- Avatar --}}
        <div>
            <label class="block text-sm font-bold text-slate-900">الصورة الشخصية <span class="font-medium text-slate-500">(اختياري)</span></label>
            <div class="mt-2 flex items-center gap-4">
                <div class="size-16 rounded-2xl overflow-hidden bg-slate-100 border border-slate-200 flex items-center justify-center">
                    <template x-if="avatarPreview">
                        <img :src="avatarPreview" class="h-full w-full object-cover">
                    </template>
                    <template x-if="!avatarPreview">
                        <svg class="size-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 19.5a2.25 2.25 0 002.25 2.25h10.5A2.25 2.25 0 0019.5 19.5v-1.5a3.75 3.75 0 00-3.75-3.75H8.25A3.75 3.75 0 004.5 18v1.5z"/></svg>
                    </template>
                </div>
                <input type="file" name="avatar" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:rounded-xl file:border-0 file:bg-slate-900 file:px-4 file:py-2 file:text-xs file:font-bold file:text-white hover:file:bg-slate-800" @change="avatarPreview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null">
            </div>
            <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" value="الاسم الكامل" />
            <x-text-input id="name" class="block mt-1 w-full rounded-xl" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="مثال: ساهر قايد" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Username -->
        <div>
            <x-input-label for="username" value="اسم المستخدم (username) *" />
            <div class="relative mt-1">
                <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">@</span>
                <x-text-input id="username" class="block w-full rounded-xl ps-8" type="text" name="username" :value="old('username')" required placeholder="ahmed_dev" pattern="[a-zA-Z0-9_]+" />
            </div>
            <p class="mt-1 text-xs text-slate-500">أحرف إنجليزية وأرقام و _ فقط — فريد</p>
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="البريد الإلكتروني" />
            <x-text-input id="email" class="block mt-1 w-full rounded-xl" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="saher@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="كلمة المرور" />
            <x-text-input id="password" class="block mt-1 w-full rounded-xl" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" value="تأكيد كلمة المرور" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-xl" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between pt-2">
            <a class="text-sm font-bold text-slate-600 hover:text-slate-900 underline" href="{{ route('login') }}">
                لديك حساب؟ تسجيل الدخول
            </a>
            <x-primary-button class="rounded-xl bg-indigo-600 hover:bg-indigo-700 px-8 py-3">
                إنشاء الحساب
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
