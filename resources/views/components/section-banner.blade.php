@props(['title', 'desc', 'imageUrl', 'button' => null, 'gradient' => true])
<section class="relative grid grid-cols-1 md:grid-cols-2">
    <div
        {{ $attributes->withoutTwMergeClasses()->twMerge(
                'grid h-full items-center justify-center',
                $gradient
                    ? 'from-white via-white via-80% to-100% md:absolute md:left-0 md:top-0 md:z-1 md:w-2/3 md:bg-gradient-to-r'
                    : 'md:order-2',
            ) }}>

        <div @class([
            'ml-0 text-justify ~space-y-2/8 ~md:~p-4/20',
            '~md:~pl-4/44 md:w-9/12' => $gradient,
            '~md:~pr-4/44' => !$gradient,
        ])>
            <h2 {{ $attributes->twMergeFor('title', 'font-great-vibes text-cedea-red ~text-2xl/5xl') }}>
                {{ $title }}
            </h2>

            <div {{ $attributes->twMergeFor('desc', '~text-sm/base') }}>{{ $desc }}</div>

            {{ $button }}
        </div>

    </div>

    <div @class(['md:col-start-2' => $gradient])>
        <img src="{{ $imageUrl }}" alt="">
    </div>

</section>
