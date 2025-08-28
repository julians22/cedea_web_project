<section class="relative bg-cedea-red bg-shippo bg-left-top bg-repeat bg-blend-multiply ~pt-12/14 ~pb-16/20">

    <div class="container">
        <h2 class="section-title text-white">
            {{ __('news.section.latest') }}
        </h2>

        <div class="mb-8 mt-2 flex justify-between gap-y-8 max-md:flex-col">

            <div class="flex basis-3/4 flex-wrap gap-8">
                @use('App\Enums\NewsType')

                @foreach (NewsType::cases() as $type)
                    <button type="button" cla wire:click='handleChangeType("{{ $type }}")'
                        @class([
                            'relative  text-white font-medium transition-colors after:absolute cursor-pointer after:left-0 after:top-8 after:h-1 after:w-0 after:bg-transparent after:transition-all after:duration-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50',
                            'after:!bg-white after:!w-1/2' => $type->value === $currentType,
                        ]) {{-- @class([
                            'cursor-pointer text-white',
                            'after:bg-white after:w-1/2' => $type->value === $currentType,
                            ])
                            --}}>
                        {{ $type->getLabel() }}</button>
                @endforeach
            </div>

            <div class="h-auto text-end text-white md:basis-72">
                <a class="rounded-full bg-white px-4 py-2 text-cedea-red" href="{{ route('news') }}">
                    {{ __('news.section.all') }}
                </a>
            </div>

        </div>

        <div class="grid grid-flow-dense grid-cols-1 ~gap-4/8 md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
            @forelse ($news as $item)
                {{-- featured news --}}
                @if ($loop->first)
                    <div
                        class="col-span-1 row-span-1 overflow-hidden rounded-xl shadow-top md:col-span-2 md:row-span-1 lg:row-span-3 2xl:[&:not(:only-child)]:mr-8">
                        <img class="max-h-64 w-full object-cover max-md:max-h-52"
                            src="{{ $item->getFirstMediaUrl('featured_image') }}" alt="">
                        <div class="flex h-full w-full flex-col gap-y-4 bg-white font-semibold ~p-4/8">
                            <p class="text-[#919497]">{{ $item->published_at }}</p>
                            <h2 class="line-clamp-3 ~text-lg/2xl"> {!! $item->title !!}</h2>
                            <a class="w-fit cursor-pointer rounded-xl bg-cedea-yellow-1 px-8 py-1 uppercase text-cedea-red"
                                href="{{ route('news.show', ['post' => $item->slug]) }}">
                                {{ __('news.read') }}
                            </a>
                        </div>
                    </div>
                @else
                    {{-- news list --}}
                    <div class="flex overflow-hidden rounded-xl shadow-top max-md:flex-col">
                        <div
                            class="grid max-h-80 items-center justify-center overflow-hidden md:aspect-[6/2] md:max-h-40 md:w-52 md:max-w-28">
                            <img class="size-full object-cover object-center"
                                src="{{ $item->getFirstMediaUrl('featured_image') }}" alt="">
                        </div>
                        <div class="flex h-full w-full flex-col justify-center gap-y-4 bg-white font-semibold ~p-2/4">
                            <p class="cursor-pointer text-[#919497] ~text-xs/xs">{{ $item->published_at }}</p>
                            <a class="line-clamp-3 ~text-base/xs"
                                href="{{ route('news.show', ['post' => $item->slug]) }}">
                                {!! $item->title !!}
                            </a>
                        </div>
                    </div>
                @endif



            @empty
                <x-placeholder.empty :text="__('status.empty')" />
            @endforelse
        </div>
    </div>
</section>
