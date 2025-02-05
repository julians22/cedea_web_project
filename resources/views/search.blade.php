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
                            id="query" name="query" type="search" value="{{ request()->query('query') }}"
                            placeholder="{{ __('search.placeholder') }}" />

                    </div>
                </form>
                <p class="pt-4 text-center text-white">
                    {{ __('search.desc') }}: <span class="font-semibold">{{ request()->query('query') }}</span>
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
                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a @class([
                        'rounded-full px-3 py-1 flex items-center justify-center',
                        'bg-cedea-red-500 text-white' => $lang == $localeCode,
                        'bg-white border-2 text-black' => $lang != $localeCode,
                    ])
                        href="{{ request()->fullUrlWithQuery(['lang' => $localeCode]) }} ">{{ $properties['native'] }}</a>
                @endforeach
            </div>


            {{-- Recipe --}}
            <x-search.item-group class="mt-4" title="{{ __('nav.recipe') }}" :showReadmore="count($recipes) > 3"
                readmoreRoute="{{ route('news', ['keyword' => request('query')]) }}">

                @forelse ($recipes as $item)
                    <x-search.item :imageurl="$item->getFirstMediaUrl('featured_image')" :alt="$item->getFirstMedia('featured_image')->name" :title="$item->title" :desc="$item->excerpt"
                        :url="route('recipe.show', ['recipe' => $item->slug])" />
                @empty
                    <x-placeholder.empty class:text="~text-lg/2xl" class:icon="~size-14/24"
                        text="{{ __('status.empty') }}" />
                @endforelse

                <p>More result</p>

            </x-search.item-group>

            {{-- news --}}
            <x-search.item-group title="{{ __('nav.news') }}" :showReadmore="count($news) > 3"
                readmoreRoute="{{ route('news', ['keyword' => request('query')]) }}">

                @forelse ($news as $item)
                    <x-search.item :imageurl="$item->getFirstMediaUrl('featured_image')" :alt="$item->getFirstMedia('featured_image')->name" :title="$item->title" :desc="strip_tags($item->excerpt)"
                        :url="route('news.show', ['post' => $item->slug])" />
                @empty
                    <x-placeholder.empty class:text="~text-lg/2xl" class:icon="~size-14/24"
                        text="{{ __('status.empty') }}" />
                @endforelse


            </x-search.item-group>

            {{-- product --}}
            <x-search.item-group title="{{ __('nav.product') }}" :showReadmore="count($products) > 3"
                readmoreRoute="{{ route('news', ['keyword' => request('query')]) }}">

                @forelse ($products as $item)
                    <x-search.item class:image="h-full" :imageurl="$item->getFirstMediaUrl('packaging')" :alt="$item->getFirstMedia('packaging')->name" :title="$item->name"
                        :desc="$item->description" :url="route('product', [
                            '#product-grid',
                            'keyword' => $item->name,
                            'brand' => $item->brand->slug,
                        ])" />
                @empty
                    <x-placeholder.empty class:text="~text-lg/2xl" class:icon="~size-14/24"
                        text="{{ __('status.empty') }}" />
                @endforelse

            </x-search.item-group>
        </div>
    </section>
</x-layouts.app>
