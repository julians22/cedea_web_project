<x-layouts.app>
    {{-- @dd($post->getFirstMediaUrl('featured_image')) --}}

    <section class="bg-cedea-red text-white">
        <div class="container py-12">
            <figure class="mb-8">
                <img src="{{ $post->getFirstMediaUrl('featured_image') }}" alt="">
                <figcaption class="caption leading-loose ~text-xxs/xs ~pt-2/4">
                    {{ $post->featured_image_caption }}
                </figcaption>
            </figure>

            <h1 class="~text-xl/4xl">{{ $post->title }}</h1>
        </div>
    </section>

    <article class="container mx-auto my-8 font-medium">
        {!! $post->content !!}
    </article>


</x-layouts.app>
