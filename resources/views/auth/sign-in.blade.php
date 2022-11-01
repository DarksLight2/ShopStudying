@extends('layouts.auth')

@section('title', 'Вход в аккаунт')

@section('content')
    <div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
        <h1 class="mb-5 text-lg font-semibold">Вход в аккаунт</h1>

        <x-forms.auth-form title="Вход в аккаунт" action="{{ route('auth.signIn') }}" method="POST">
            <x-forms.text-input :isError="$errors->has('email')"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                placeholder="E-mail"
                                required="true"></x-forms.text-input>

            @error('email')
            <x-forms.error>{{ $message }}</x-forms.error>
            @enderror

            <x-forms.text-input :isError="$errors->has('email')"
                                name="password"
                                type="password"
                                placeholder="Пароль"
                                required="true"></x-forms.text-input>

            <x-forms.primary-button>Войти</x-forms.primary-button>

            <x-forms.github-button :url="route('auth.socialite', 'github')">Авторизоваться с помощью GitHub
            </x-forms.github-button>

            <x-slot:buttons>
                <div class="space-y-3 mt-5">
                    <div class="text-xxs md:text-xs"><a href="{{ route('auth.forgot-password') }}"
                                                        class="text-white hover:text-white/70 font-bold">Забыли
                            пароль?</a>
                    </div>
                    <div class="text-xxs md:text-xs"><a href="{{ route('auth.signUp') }}"
                                                        class="text-white hover:text-white/70 font-bold">Регистрация</a>
                    </div>
                </div>
            </x-slot:buttons>
        </x-forms.auth-form>

        <ul class="flex flex-col md:flex-row justify-between gap-3 md:gap-4 mt-14 md:mt-20">
            <li>
                <a href="#" class="inline-block text-white hover:text-white/70 text-xxs md:text-xs font-medium"
                   target="_blank" rel="noopener">Пользовательское соглашение</a>
            </li>
            <li class="hidden md:block">
                <div class="h-full w-[2px] bg-white/20"></div>
            </li>
            <li>
                <a href="#" class="inline-block text-white hover:text-white/70 text-xxs md:text-xs font-medium"
                   target="_blank" rel="noopener">Политика конфиденциальности</a>
            </li>
        </ul>
    </div>
@endsection