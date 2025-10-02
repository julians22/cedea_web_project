@props(['item'])

@php
    $url = $item->link
        ? (Str::startsWith($item->link, ['http://', 'https://'])
            ? $item->link
            : 'https://' . $item->link)
        : null;

    $banner_uid = Str::uuid();
@endphp

<div @class([
    'h-full max-h-full bg-white',
    'bg-brick-2 bg-cover bg-no-repeat' =>
        $item->banner_type === \App\Enums\BannerType::PARALLAX1,
])>
    <div @class([
        'h-full max-h-full bg-no-repeat',
        'bg-paralax-1 bg-cover bg-[25%_50dvh] lg:bg-[25%_max(25dvw,_130%)]' =>
            $item->banner_type === \App\Enums\BannerType::PARALLAX1,
    ])>
        <div class="mx-auto grid h-full max-h-full max-w-[145rem] grid-cols-2 px-8">
            <div class="flex flex-col items-start justify-center gap-4 p-8 lg:p-16">
                <p class="text-8xl font-bold text-cedea-red drop-shadow-lg">
                    {{ $item->title }}
                </p>
                <p class="text-cedea-red">
                    {{ $item->desc }}
                </p>
            </div>
            <div class="atropos my-atropos" id="atropos-banner-{{ $banner_uid }}">
                <!-- scale container (required) -->
                <div class="atropos-scale">
                    <!-- rotate container (required) -->
                    <div class="atropos-rotate">
                        <!-- inner container (required) -->
                        <div class="atropos-inner overflow-visible">
                            <div class="relative h-full p-4">
                                <div class="max-lg:hidden">
                                    @foreach ($item->getMedia('banner_particle_back') as $particle_back)
                                        @for ($i = 1; $i <= rand(1, 3); $i++)
                                            @php
                                                $top_1 = rand(15, 35);
                                                $top_2 = rand(65, 70);
                                                $top_array = [$top_1, $top_2];
                                                $top = $top_array[array_rand($top_array)];
                                                $left_1 = rand(-25, 2);
                                                $left_2 = rand(25, 55);
                                                $left_array = [$left_1, $left_2];
                                                $left = $left_array[array_rand($left_array)];
                                            @endphp
                                            <div class="absolute h-auto max-w-40 drop-shadow-md"
                                                data-atropos-offset="{{ rand(-80, 0) }}"
                                                style="top: {{ $top }}%; left: {{ $left }}%; width: {{ rand(50, 90) }}px; rotate: {{ rand(-30, 30) }}deg; filter: blur({{ rand(1, 3) }}px);">
                                                <img class="banner-particle" src="{{ $particle_back->getUrl() }}"
                                                    alt="{{ $particle_back->name }}" />
                                            </div>
                                        @endfor
                                    @endforeach
                                </div>
                                <div
                                    class="absolute left-[55%] top-1/2 inline-block h-auto max-h-full w-3/5 -translate-x-full -translate-y-1/2 -rotate-12 drop-shadow-2xl">
                                    <img class="product scale-0 opacity-0"
                                        src="{{ $item->getFirstMediaUrl('banner_product') }}"
                                        alt="{{ $item->title ? $item->title : $item->getFirstMedia('banner_product')->name }}" />
                                </div>
                                <div class="max-lg:hidden">
                                    @foreach ($item->getMedia('banner_particle_front') as $particle_front)
                                        @for ($i = 1; $i <= rand(1, 3); $i++)
                                            @php
                                                $top_1 = rand(15, 35);
                                                $top_2 = rand(65, 70);
                                                $top_array = [$top_1, $top_2];
                                                $top = $top_array[array_rand($top_array)];
                                                $left_1 = rand(-25, 2);
                                                $left_2 = rand(45, 55);
                                                $left_array = [$left_1, $left_2];
                                                $left = $left_array[array_rand($left_array)];
                                            @endphp
                                            <div class="absolute h-auto max-w-40 drop-shadow-lg"
                                                data-atropos-offset="{{ rand(0, 80) }}"
                                                style="top: {{ $top }}%; left: {{ $left }}%; width: {{ rand(80, 160) }}px; rotate: {{ rand(-30, 30) }}deg; filter: blur({{ rand(0, 1.5) }}px);">
                                                <img class="banner-particle scale-0 opacity-0"
                                                    src="{{ $particle_front->getUrl() }}"
                                                    alt="{{ $particle_front->name }}" />
                                            </div>
                                        @endfor
                                    @endforeach
                                </div>
                                @if ($item->banner_type === \App\Enums\BannerType::PARALLAX2)
                                    <img class="absolute -bottom-1/4 -right-1/4 h-3/5 max-h-full w-auto blur-sm drop-shadow-2xl"
                                        data-atropos-offset="1"
                                        src="{{ $item->getFirstMediaUrl('banner_particle_front') }}"
                                        alt="{{ $item->title ? $item->title : $item->getFirstMedia('banner_product')->name }}" />
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('after-scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.Atropos({
                el: "{{ '#atropos-banner-' . $banner_uid }}",
                highlight: false,
                shadow: false,
                rotateXMax: 10,
                rotateYMax: 10,
                easing: "cubic-bezier(0.03, 0.98, 0.52, 0.99)",
                onEnter() {
                    // console.log('Enter');
                },
                onLeave() {
                    // console.log('Leave');
                },
                onRotate(x, y) {
                    // console.log('Rotate', x, y);
                }
            });
        });
    </script>
@endpush
