<x-layouts.app>
    <section class="min-h-dvh bg-brick">

        <div class="bg-cedea-red-500 pb-12">

            <div class="container ~pt-14/28">
                <form action="{{ route('search') }}" method="GET"
                    @keyup.enter="$event.target.submit(); seachModalOpen=false">
                    <div
                        class="relative mx-auto flex w-11/12 gap-x-4 rounded-full border border-white bg-transparent bg-white px-4 text-sm placeholder:text-white sm:w-3/4">
                        <button type="submit">
                            <x-icon.magnifying-glass class="text-cedea-red-500" />
                        </button>

                        <input
                            class="block h-10 w-full px-2 py-1 text-cedea-red-500 outline-none placeholder:text-cedea-red-500"
                            id="query" name="query" type="search" value="{{ $query }}" maxlength="100"
                            placeholder="{{ __('search.placeholder') }}" />

                    </div>
                </form>
                <p class="pt-4 text-center text-white">
                    {{ __('search.desc') }}: <span class="font-semibold">{{ $query }}</span>
                </p>
            </div>
        </div>

        <div class="container my-4">

            {{-- search language changer --}}

            <div class="flex flex-wrap gap-2 py-4">
                <a @class([
                    'rounded-full px-3 py-1 flex items-center justify-center',
                    'bg-cedea-red-500 text-white' => $lang == '*',
                    'bg-white border-2 text-black' => $lang != '*',
                ]) href="{{ request()->fullUrlWithQuery(['lang' => null]) }}">All</a>
                @foreach (config('localizer.locale_names') as $localeCode => $localeName)
                    <a @class([
                        'rounded-full px-3 py-1 flex items-center justify-center',
                        'bg-cedea-red-500 text-white' => $lang == $localeCode,
                        'bg-white border-2 text-black' => $lang != $localeCode,
                    ])
                        href="{{ request()->fullUrlWithQuery(['lang' => $localeCode]) }}">{{ $localeName }}</a>
                @endforeach
            </div>


            {{-- Recipe --}}
            <x-search.item-group class="mt-4" title="{{ __('nav.recipe') }}" :showReadmore="$hasMoreRecipes"
                readmoreRoute="{{ route('recipe', ['locale' => $resultLocale, 'keyword' => $query]) }}">

                @forelse ($recipes as $item)
                    <x-search.item :imageurl="$item->getFirstMediaUrl('featured_image')" :alt="$item->getFirstMedia('featured_image')?->name ?? strip_tags((string) $item->title)" :title="$item->title" :desc="$item->description"
                        :url="route('recipe.show', ['locale' => $resultLocale, 'recipe' => $item->slug])" />
                @empty
                    <x-placeholder.empty class:text="~text-lg/2xl" class:icon="~size-14/24"
                        text="{{ __('status.empty') }}" />
                @endforelse

                {{-- <p>More result</p> --}}

            </x-search.item-group>

            {{-- news --}}
            <x-search.item-group title="{{ __('nav.news') }}" :showReadmore="$hasMoreNews"
                readmoreRoute="{{ route('news', ['locale' => $resultLocale, 'keyword' => $query]) }}">

                @forelse ($news as $item)
                    <x-search.item :imageurl="$item->getFirstMediaUrl('featured_image')" :alt="$item->getFirstMedia('featured_image')?->name ?? strip_tags((string) $item->title)" :title="$item->title" :desc="strip_tags($item->excerpt)"
                        :url="route('news.show', ['locale' => $resultLocale, 'post' => $item->slug])" />
                @empty
                    <x-placeholder.empty class:text="~text-lg/2xl" class:icon="~size-14/24"
                        text="{{ __('status.empty') }}" />
                @endforelse


            </x-search.item-group>

            {{-- product --}}
            <x-search.item-group title="{{ __('nav.product') }}" :showReadmore="$hasMoreProducts"
                readmoreRoute="{{ route('product', ['locale' => $resultLocale, 'keyword' => $query]) }}#product-grid">

                @forelse ($products as $item)
                    <x-search.item class:image="h-full" :imageurl="$item->getFirstMediaUrl('packaging')" :alt="$item->getFirstMedia('packaging')?->name ?? $item->fullname" :title="$item->name"
                        :desc="$item->description" :url="route('product', ['locale' => $resultLocale, 'product' => $item->slug]) . '#product-grid'" />
                @empty
                    <x-placeholder.empty class:text="~text-lg/2xl" class:icon="~size-14/24"
                        text="{{ __('status.empty') }}" />
                @endforelse

            </x-search.item-group>

            {{-- pages --}}
            <x-search.item-group class:content="flex-row gap-2 flex-wrap" title="Halaman Terkait Lainnya">

                @forelse ($scrape_results as $name => $url)
                    <a class="flex items-center justify-center rounded-full bg-cedea-red px-3 py-1 text-white"
                        href="{{ $url }}">{{ __('search.' . $name) }}</a>
                @empty
                    <x-placeholder.empty class:text="~text-lg/2xl" class:icon="~size-14/24"
                        text="{{ __('status.empty') }}" />
                @endforelse
            </x-search.item-group>
        </div>
    </section>
</x-layouts.app>
