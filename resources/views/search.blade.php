<x-layouts.app>
    <section class="min-h-dvh bg-brick">

        <div class="bg-cedea-red-500 ~h-48/80">

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
                            placeholder="Cari di sini" />

                    </div>
                </form>
                <p class="pt-4 text-center text-white">
                    Berikut hasil pencarian untuk <span class="font-semibold">{{ request()->query('query') }}</span>:
                </p>
            </div>
        </div>

        <div class="container my-4">
            {{-- Recipe --}}
            <x-search.item-group title="Kreasi Resep" :showReadmore="count($recipes) > 3"
                readmoreRoute="{{ route('news', ['keyword' => request('query')]) }}">

                @foreach ($recipes as $item)
                    <x-search.item :imageurl="$item->getFirstMediaUrl('featured_image')" :alt="$item->getFirstMedia('featured_image')->name" :title="$item->title" :desc="$item->excerpt"
                        :url="route('news.show', ['post' => $item->slug])" />
                @endforeach

            </x-search.item-group>

            {{-- news --}}
            <x-search.item-group title="berita" :showReadmore="count($news) > 3"
                readmoreRoute="{{ route('news', ['keyword' => request('query')]) }}">

                @foreach ($news as $item)
                    <x-search.item :imageurl="$item->getFirstMediaUrl('featured_image')" :alt="$item->getFirstMedia('featured_image')->name" :title="$item->title" :desc="$item->excerpt"
                        :url="route('news.show', ['post' => $item->slug])" />
                @endforeach

            </x-search.item-group>

            {{-- product --}}
            <x-search.item-group title="Product" :showReadmore="count($products) > 3"
                readmoreRoute="{{ route('news', ['keyword' => request('query')]) }}">

                @foreach ($products as $item)
                    <x-search.item :imageurl="$item->getFirstMediaUrl('packaging')" :alt="$item->getFirstMedia('packaging')->name" :title="$item->name" :desc="$item->description"
                        :url="route('product', [
                            '#product-grid',
                            'keyword' => $item->name,
                            'brand' => $item->brand->slug,
                        ])" />
                @endforeach

            </x-search.item-group>
        </div>
    </section>
</x-layouts.app>
