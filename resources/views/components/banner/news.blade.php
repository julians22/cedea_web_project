@props(['item'])

<div class="grid-overlay relative grid h-full">
    <picture
        class="h-full overflow-hidden after:absolute after:bottom-0 after:block after:size-full after:bg-gradient-to-t after:from-black/70 after:via-black/35 after:to-50%">
        <source class="h-full w-full" srcset="{{ $item->getFirstMediaUrl('featured_image') }}"
            media="(min-width: 1024px)" />
        <img class="mx-auto block h-full w-full object-cover" src="{{ $item->getFirstMediaUrl('featured_image') }}" />
    </picture>

    <div class="container z-1 flex max-h-[90%] flex-col justify-end gap-4 text-white md:max-h-[80%]">
        <div class="font-semibold ~text-xl/5xl">
            {!! $item->title !!}
        </div>
        <a class="w-fit rounded-full bg-cedea-red px-4 py-2 font-androgyne"
            href="{{ route('news.show', ['post' => $item->slug]) }}">Baca
            Berita</a>
    </div>
</div>
