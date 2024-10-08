<section class="relative bg-left-top bg-repeat bg-blend-multiply ~pt-12/14 ~pb-16/20">

    <div class="container">
        <div class="mx-auto mb-12 text-center md:w-1/2">
            <h2 class="section-title mb-4 text-cedea-red-500">
                {!! __('news.heading') !!}
            </h2>
            <p>
                {{ __('news.subheading') }}
            </p>
        </div>

        <div class="mb-8 mt-2 flex justify-between gap-y-8 max-md:flex-col">

            <div class="flex basis-3/4 flex-wrap gap-x-8 gap-y-4">
                @foreach ($types as $type)
                    <button type="button" cla wire:click='handleChangeType("{{ $type }}")'
                        @class([
                            'cursor-pointer px-6 py-0.5 border border-cedea-red text-cedea-red rounded-full',
                            'bg-cedea-red text-white' => $type === $currentType,
                        ])>
                        {{ $type }}</button>
                @endforeach
            </div>

            <div class="h-auto md:basis-72">
                <div class="relative ~pr-0/20">
                    <x-lucide-search class="size-6 absolute left-2 top-1/2 -translate-y-1/2 md:left-3" />
                    <input
                        class="block w-full rounded-full border border-black bg-transparent px-1 py-3 ps-10 text-sm placeholder:text-black"
                        id="recipe-search" wire:model.live='keyword' type="search"
                        placeholder="{{ __('news.search') }}" />
                </div>
            </div>

        </div>

        <div class="grid grid-flow-dense grid-cols-1 ~gap-4/8 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">

            @foreach ($news as $item)
                {{-- featured news --}}
                @if ($loop->first)
                    <div
                        class="col-span-1 row-span-1 overflow-hidden rounded-xl shadow-top md:col-span-2 md:row-span-1 lg:row-span-3 2xl:[&:not(:only-child)]:mr-8">
                        <img class="w-full object-cover" src="{{ $item->getFirstMediaUrl('featured_image') }}"
                            alt="">
                        <div class="flex h-full w-full flex-col gap-y-4 bg-white font-semibold ~p-4/8">
                            <p class="text-[#919497]">{{ $item->published_at }}</p>
                            <h2 class="line-clamp-3 ~text-lg/2xl"> {{ $item->title }}</h2>
                            <a
                                class="w-fit cursor-pointer rounded-xl bg-cedea-yellow-1 px-8 py-1 uppercase text-cedea-red">
                                Baca Beritanya
                            </a>
                        </div>
                    </div>
                @else
                    {{-- news list --}}
                    <div class="flex overflow-hidden rounded-xl shadow-top">
                        <img class="h-full w-40 object-cover" src="{{ $item->getFirstMediaUrl('featured_image') }}"
                            alt="">
                        <div class="flex h-full w-full flex-col justify-center gap-y-4 bg-white p-4 font-semibold">
                            <p class="cursor-pointer text-[#919497] ~text-xs/sm">{{ $item->published_at }}</p>
                            <h2 class="line-clamp-3 ~text-xxs/xs">
                                {{ $item->title }}
                            </h2>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
