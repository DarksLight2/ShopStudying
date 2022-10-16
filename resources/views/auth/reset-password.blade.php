@include('parts.header')

<main class="md:min-h-screen md:flex md:items-center md:justify-center py-16 lg:py-20">
    <div class="container">

        <!-- Page heading -->
        <div class="text-center">
            <a href="{{ route('home') }}" class="inline-block" rel="home">
                <img src="{{ \Illuminate\Support\Facades\Vite::asset('resources/images/logo.svg', null) }}"
                     class="w-[148px] md:w-[201px] h-[36px] md:h-[50px]" alt="CutCode">
            </a>
        </div>

        <div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
            <h1 class="mb-5 text-lg font-semibold">Восстановить пароль</h1>
            <form method="POST" action="{{ route('password.update') }}" class="space-y-3">

                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div>
                    @error('email')
                    <div class="mt-3 text-pink text-xxs xs:text-xs">{{ $message }}</div>
                    @enderror
                    <input name="email" type="email"
                           class="@error('email') _is-error @enderror w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
                           placeholder="E-mail" required value="{{ old('email', $request->email) }}">
                </div>
                <div>
                    @error('password')
                    <div class="mt-3 text-pink text-xxs xs:text-xs">{{ $message }}</div>
                    @enderror
                    <input name="password" type="password"
                           class="@error('password') _is-error @enderror w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
                           placeholder="Пароль" required>
                </div>
                <div>
                    <input name="password_confirmation" type="password"
                           class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
                           placeholder="Повтор пароля" required>
                </div>

                <button type="submit" class="w-full btn btn-pink">Изменить пароль</button>

            </form>
        </div>

    </div>
</main>

@include('parts.footer')