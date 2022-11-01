@extends('layouts.auth')

@section('title', 'Изменить пароль')


@section('content')
    <div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
        <h1 class="mb-5 text-lg font-semibold">Изменить пароль</h1>

        <x-forms.auth-form title="Изменить пароль" action="{{ route('auth.password-update') }}" method="POST">

            <input type="hidden" value="{{ $token }}" name="token"/>

            <x-forms.text-input :isError="$errors->has('email')"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                placeholder="E-mail"
                                required="true"></x-forms.text-input>

            @error('email')
            <x-forms.error>{{ $message }}</x-forms.error>
            @enderror

            <x-forms.text-input :isError="$errors->has('password')"
                                name="password"
                                type="password"
                                placeholder="Пароль"
                                required="true"></x-forms.text-input>

            @error('password')
            <x-forms.error>{{ $message }}</x-forms.error>
            @enderror

            <x-forms.text-input :isError="$errors->has('password')"
                                name="password_confirmation"
                                type="password"
                                placeholder="Повтор пароля"
                                required="true"></x-forms.text-input>

            <x-forms.primary-button>Изменить пароль</x-forms.primary-button>

            <x-slot:buttons></x-slot:buttons>
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