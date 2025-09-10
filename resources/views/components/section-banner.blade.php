@props([
    'title',
    'desc',
    'imageUrl',
    'imageAlt' => null,
    'id' => null,
    'button' => null,
    'gradient' => true,
    'imageLeft' => true,
])
<section
    {{ $attributes->withoutTwMergeClasses()->twMerge('relative grid grid-cols-1 ~scroll-mt-12/14 md:grid-cols-2 md:~scroll-mt-16/20 lg:~scroll-mt-12/20') }}
    {{ $id ? 'id=' . $id : '' }}>

    {{-- text --}}
    <div
        {{ $attributes->twMergeFor(
            'content',
            'grid h-full w-full items-center justify-center  max-md:order-1',
            $gradient
                ? 'from-[#ededed] via-[#ededed] max-md:pt-4 via-80% to-100% md:via-[53%] md:to-70% md:absolute md:left-0 bg-gradient-to-t md:top-0 md:z-1 '
                : '',
            $imageLeft
                ? 'md:order-2 md:bg-[linear-gradient(-85deg,var(--tw-gradient-stops))]'
                : 'md:bg-[linear-gradient(85deg,var(--tw-gradient-stops))]',
        ) }}>

        <div @class([
            'container top-0 h-full w-full md:absolute md:grid md:grid-cols-2',
            'left-1/2 md:-translate-x-1/2' => $imageLeft,
            'right-1/2 md:translate-x-1/2' => !$imageLeft,
        ])>
            <div @class([
                'ml-0 text-justify justify-center flex flex-col ~gap-y-2/4 ~md:~p-2/20 ~md:~mb-4/0',
                // '~md:~ml-4/48 ~md:~pl-0/1 md:w-3/5' => $imageLeft
                'md:~pr-0/1 col-start-2' => $imageLeft,
                'md:~pl-0/1' => !$imageLeft,
            ])>
                <h2 {{ $attributes->twMergeFor('title', 'section-title text-left text-cedea-red-dark ') }}>
                    {!! $title !!}
                </h2>

                <div
                    {{ $attributes->twMergeFor('desc', '~text-sm/base 2xl:w-[85%] xl:w-[95%] leading-relaxed md:leading-snug lg:leading-relaxed') }}>
                    {!! $desc !!}
                </div>

                {{ $button }}
            </div>
        </div>
    </div>


    {{-- image --}}
    <div @class([
        'md:col-start-2' => !$imageLeft,
        '~min-h-72/96 object-cover max-md:-mb-28 md:size-full object-center' => $gradient,
    ])>
        <img class="w-full" src="{{ $imageUrl }}" alt="{{ $imageAlt }}">
    </div>

</section>
