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
            <h1 class="mb-5 text-lg font-semibold">Восстановление пароля</h1>
            @error('credentials')
            <h2 class="mb-5 text-sm font-semibold text-red-300">{{ $message }}</h2>
            @enderror
            <form action="{{ route('password.update') }}" method="post" class="space-y-3">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                @error('email')
                <label for="email" class="text-red-300">
                    {{ $message }}
                </label>
                @enderror
                <input id="email" name="email" type="email" value="{{ old('email') }}"
                       class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
                       placeholder="E-mail" required>
                @error('password')
                <label for="password" class="text-red-300">
                    {{ $message }}
                </label>
                @enderror
                <input name="password" type="password"
                       class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
                       placeholder="Пароль" required>
                <input name="password_confirmation" type="password"
                       class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
                       placeholder="Повтор пароля" required>
                <button type="submit" class="w-full btn btn-pink">Сменить пароль</button>
            </form>
        </div>

    </div>
</main>

@include('parts.footer')
