<section class="mt-16 lg:mt-24">
    <!-- Section heading -->
    <h2 class="text-lg lg:text-[42px] font-black">Категории</h2>

    <!-- Categories -->
    <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-5 gap-3 sm:gap-4 md:gap-5 mt-8">
        @forelse($categories as $category)
            <a href="{{ $category->id }}"
               class="p-3 sm:p-4 2xl:p-6 rounded-xl bg-card hover:bg-pink text-xxs sm:text-xs lg:text-sm text-white font-semibold">{{ $category->title }}</a>
        @empty
            <span class="p-3 sm:p-4 2xl:p-6 rounded-xl bg-card hover:bg-pink text-xxs sm:text-xs lg:text-sm text-white font-semibold">Пусто</span>
        @endforelse
    </div>
</section>