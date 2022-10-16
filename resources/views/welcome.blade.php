@include('parts.header')

<main class="py-16 lg:py-20">
    <div class="container">

        @include('parts.benefits')

        @include('parts.categories')

        <section class="mt-16 lg:mt-24">
            <!-- Section heading -->
            <h2 class="text-lg lg:text-[42px] font-black">Каталог товаров</h2>

            <!-- Products list -->
            <div class="products grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-x-8 gap-y-8 lg:gap-y-10 2xl:gap-y-12 mt-8">
                {{--                @@include('parts/products/1.html')--}}
                {{--                @@include('parts/products/2.html')--}}
                {{--                @@include('parts/products/3.html')--}}
                {{--                @@include('parts/products/4.html')--}}
                {{--                @@include('parts/products/5.html')--}}
                {{--                @@include('parts/products/6.html')--}}
                {{--                @@include('parts/products/7.html')--}}
                {{--                @@include('parts/products/8.html')--}}
            </div>

            <div class="mt-12 text-center">
                <a href="catalog.html" class="btn btn-purple">Все товары &nbsp;→</a>
            </div>
        </section>

        <section class="mt-20">
            <!-- Section heading -->
            <h2 class="text-lg lg:text-[42px] font-black">Бренды</h2>

            <!-- Brands list -->
            <div class="grid grid-cols-2 md:grid-cols-3 2xl:grid-cols-6 gap-4 md:gap-8 mt-12">
                <a href="catalog.html" class="p-6 rounded-xl bg-card hover:bg-card/60">
                    <div class="h-12 md:h-16">

                        <img src="{{ \Illuminate\Support\Facades\Vite::asset('resources/images/brands/1.png', null) }}"
                             class="object-contain w-full h-full" alt="Steelseries">
                    </div>
                    <div class="mt-8 text-xs sm:text-sm lg:text-md font-semibold text-center">Steelseries</div>
                </a>
                <a href="catalog.html" class="p-6 rounded-xl bg-card hover:bg-card/60">
                    <div class="h-12 md:h-16">
                        <img src="{{ \Illuminate\Support\Facades\Vite::asset('resources/images/brands/2.png', null) }}"
                             class="object-contain w-full h-full" alt="Razer">
                    </div>
                    <div class="mt-8 text-xs sm:text-sm lg:text-md font-semibold text-center">Razer</div>
                </a>
                <a href="catalog.html" class="p-6 rounded-xl bg-card hover:bg-card/60">
                    <div class="h-12 md:h-16">
                        <img src="{{ \Illuminate\Support\Facades\Vite::asset('resources/images/brands/3.png', null) }}"
                             class="object-contain w-full h-full" alt="Logitech">
                    </div>
                    <div class="mt-8 text-xs sm:text-sm lg:text-md font-semibold text-center">Logitech</div>
                </a>
                <a href="catalog.html" class="p-6 rounded-xl bg-card hover:bg-card/60">
                    <div class="h-12 md:h-16">
                        <img src="{{ \Illuminate\Support\Facades\Vite::asset('resources/images/brands/4.png', null) }}"
                             class="object-contain w-full h-full" alt="HyperX">
                    </div>
                    <div class="mt-8 text-xs sm:text-sm lg:text-md font-semibold text-center">HyperX</div>
                </a>
                <a href="catalog.html" class="p-6 rounded-xl bg-card hover:bg-card/60">
                    <div class="h-12 md:h-16">
                        <img src="{{ \Illuminate\Support\Facades\Vite::asset('resources/images/brands/5.png', null) }}"
                             class="object-contain w-full h-full" alt="Playstation">
                    </div>
                    <div class="mt-8 text-xs sm:text-sm lg:text-md font-semibold text-center">Playstation</div>
                </a>
                <a href="catalog.html" class="p-6 rounded-xl bg-card hover:bg-card/60">
                    <div class="h-12 md:h-16">
                        <img src="{{ \Illuminate\Support\Facades\Vite::asset('resources/images/brands/6.png', null) }}"
                             class="object-contain w-full h-full" alt="XBOX">
                    </div>
                    <div class="mt-8 text-xs sm:text-sm lg:text-md font-semibold text-center">XBOX</div>
                </a>
            </div>
        </section>

    </div>
</main>

@include('parts.footer')
