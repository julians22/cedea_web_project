<x-layouts.app>
    <section class="h-dvh container bg-brick">

        {{-- Recipe --}}
        <div>
            <h1 class="text-left font-androgyne text-cedea-red-dark ~text-xl/5xl">Kreasi Resep</h1>
            <ul class="flex flex-col gap-y-4">
                @foreach ($news as $item)
                    <x-search.item :imageurl="$item->getFirstMediaUrl('featured_image')" :alt="$item->getFirstMedia('featured_image')->name" :title="$item->title" :desc="$item->excerpt"
                        :url="route('news.show', ['post' => $item->slug])" />
                @endforeach
                @if (count($recipes) > 2)
                    <li class="text-right">
                        <a href="{{ route('recipe', ['keyword' => request('query')]) }}">More results</a>
                    </li>
                @endif
            </ul>
        </div>

        {{-- news --}}
        <div>
            <h1 class="text-left font-androgyne text-cedea-red-dark ~text-xl/5xl">Berita</h1>
            <ul class="flex flex-col gap-y-4">
                @foreach ($recipes as $item)
                    <x-search.item :imageurl="$item->getFirstMediaUrl('featured_image')" :alt="$item->getFirstMedia('featured_image')->name" :title="$item->title" :desc="$item->excerpt"
                        :url="route('news.show', ['post' => $item->slug])" />
                @endforeach
                @if (count($news) > 2)
                    <li class="text-right">
                        <a href="{{ route('news', ['keyword' => request('query')]) }}">More results</a>
                    </li>
                @endif
            </ul>
        </div>

        {{-- product --}}
        <div>
            <h1 class="text-left font-androgyne text-cedea-red-dark ~text-xl/5xl">Product</h1>
            <ul class="flex flex-col gap-y-4">
                @foreach ($products as $item)
                    <x-search.item :imageurl="$item->getFirstMediaUrl('packaging')" :alt="$item->getFirstMedia('packaging')->name" :title="$item->name" :desc="$item->description"
                        :url="route('product', ['keyword' => $item->slug])" />
                @endforeach
                @if (count($products) > 2)
                    <li class="text-right">
                        <a href="{{ route('product', ['keyword' => request('query')]) }}">More results</a>
                    </li>
                @endif
            </ul>
        </div>
    </section>
</x-layouts.app>
