@props(['title', 'desc', 'imageUrl', 'id' => null, 'button' => null, 'gradient' => true])
<section class="relative grid grid-cols-1 md:grid-cols-2" {{ $id ? 'id=' . $id : '' }}>
    <div
        {{ $attributes->withoutTwMergeClasses()->twMerge(
                'grid h-full w-full items-center justify-center max-md:order-1',
                $gradient
                    ? 'from-[#ededed] via-[#ededed] max-md:pt-4 via-80% to-100% md:via-[53%] md:to-70% md:absolute md:left-0 bg-gradient-to-t md:top-0 md:z-1 md:bg-[linear-gradient(85deg,var(--tw-gradient-stops))]'
                    : 'md:order-2',
            ) }}>

        <div @class([
            'container  top-0 h-full w-full md:absolute md:grid  md:grid-cols-2',
            'left-1/2 md:-translate-x-1/2' => $gradient,
            'right-1/2 md:translate-x-1/2 ' => !$gradient,
        ])>
            <div @class([
                'ml-0 text-justify justify-center  flex flex-col ~gap-y-2/4 ~md:~p-4/20',
                // '~md:~ml-4/48 ~md:~pl-0/1 md:w-3/5' => $gradient,
                'md:~pl-0/1' => $gradient,
                'md:~pr-0/1 md:col-start-2' => !$gradient,
            ])>
                <h2 {{ $attributes->twMergeFor('title', 'font-great-vibes text-cedea-red ~text-2xl/5xl') }}>
                    {{ $title }}
                </h2>
                <div {{ $attributes->twMergeFor('desc', '~text-sm/base 2xl:w-[73%] leading-relaxed') }}>
                    {{ $desc }}</div>
                {{ $button }}
            </div>
        </div>
    </div>

    <div @class([
        'md:col-start-2 min-h-72 object-cover max-md:-mb-28 md:size-full object-center' => $gradient,
    ])>
        <img src="{{ $imageUrl }}" alt="">
    </div>

</section>


{{-- backup --}}
{{-- <section class="relative grid grid-cols-1 md:grid-cols-2">
    <div
        {{ $attributes->withoutTwMergeClasses()->twMerge(
                'grid h-full items-center justify-center max-md:order-1',
                $gradient
                    ? 'from-[#ededed] via-[#ededed] max-md:pt-4 via-80% to-100% md:absolute md:left-0 bg-gradient-to-t md:top-0 md:z-1 md:w-2/3 md:bg-gradient-to-r'
                    : 'md:order-2',
            ) }}>

        <div @class([
            'ml-0 text-justify flex flex-col ~gap-y-2/4 ~md:~p-4/20',
            // '~md:~ml-4/48 ~md:~pl-0/1 md:w-3/5' => $gradient,
            '~md:~ml-4/48 ~md:~pl-0/1 md:w-3/5' => $gradient,
            '~md:~mr-4/48 ~md:~pr-0/1' => !$gradient,
        ])>
            <h2 {{ $attributes->twMergeFor('title', 'font-great-vibes text-cedea-red ~text-2xl/5xl') }}>
                {{ $title }}
            </h2>

            <div {{ $attributes->twMergeFor('desc', '~text-xs/base lg:w-[70%] h-full leading-relaxed') }}>
                {{ $desc }}</div>

            {{ $button }}
        </div>

    </div>

    <div @class([
        'md:col-start-2 min-h-72 object-cover max-md:-mb-28 md:size-full object-center' => $gradient,
    ])>
        <img src="{{ $imageUrl }}" alt="">
    </div>

</section> --}}
