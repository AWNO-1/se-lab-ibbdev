<section x-data="{ avatarPreview: null }">
    <header class="mb-6">
        <h2 class="text-lg font-black text-slate-900">المعلومات الشخصية</h2>
        <p class="mt-1 text-sm text-slate-500">حدّث اسمك، اسم المستخدم، بريدك، وصورتك. سيتم حفظ <code>avatar_path</code> في التخزين.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('patch')

        {{-- Avatar --}}
        <div>
            <x-input-label for="avatar" value="الصورة الشخصية (avatar_path)" />
            <div class="mt-3 flex items-center gap-5">
                <div class="relative size-20 rounded-2xl overflow-hidden bg-slate-100 ring-1 ring-slate-200">
                    <template x-if="avatarPreview">
                        <img :src="avatarPreview" class="h-full w-full object-cover">
                    </template>
                    <template x-if="!avatarPreview">
                        <div class="h-full w-full flex items-center justify-center">
                            @if($user->avatar_path)
                                <img src="{{ Str::startsWith($user->avatar_path, ['http://','https://']) ? $user->avatar_path : asset('storage/'.$user->avatar_path) }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                            @else
                                <span class="text-xl font-black text-slate-400">{{ mb_substr($user->name,0,1) }}</span>
                            @endif
                        </div>
                    </template>
                </div>
                <div class="flex-1">
                    <input id="avatar" name="avatar" type="file" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:rounded-xl file:border-0 file:bg-slate-900 file:px-4 file:py-2 file:text-xs file:font-bold file:text-white hover:file:bg-slate-800 file:transition" @change="avatarPreview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null" />
                    <p class="mt-2 text-xs text-slate-500">PNG, JPG حتى 2MB — تُحفظ في <code>avatars/</code></p>
                    <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
                    <x-input-error class="mt-2" :messages="$errors->get('avatar_path')" />
                </div>
            </div>
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <x-input-label for="name" value="الاسم" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full rounded-xl" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
            <div>
                <x-input-label for="username" value="اسم المستخدم (username) *" />
                <div class="relative mt-1">
                    <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-slate-400">@</span>
                    <x-text-input id="username" name="username" type="text" class="block w-full rounded-xl ps-8" :value="old('username', $user->username)" required pattern="[a-zA-Z0-9_]+" placeholder="ahmed_dev" />
                </div>
                <p class="mt-1 text-xs text-slate-500">أحرف وأرقام و _ فقط — فريد</p>
                <x-input-error class="mt-2" :messages="$errors->get('username')" />
            </div>
        </div>

        <div>
            <x-input-label for="email" value="البريد الإلكتروني" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full rounded-xl" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <x-primary-button class="rounded-xl bg-indigo-600 hover:bg-indigo-700">حفظ التغييرات</x-primary-button>
        </div>
    </form>
</section>
