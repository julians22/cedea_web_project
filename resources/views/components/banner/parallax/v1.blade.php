@props(['item'])

@php
    $url = $item->link
        ? (Str::startsWith($item->link, ['http://', 'https://'])
            ? $item->link
            : 'https://' . $item->link)
        : null;
@endphp

@if ($url)
    <a href="{{ $url }}" target="_blank">
@endif

<div class="grid max-h-[500px] grid-cols-2 lg:max-h-[600px]">
    <div>
        <p>
            {{ $item->title }}
        </p>
        <p>
            {{ $item->subtitle }}
        </p>
    </div>
    @php
        $banner_uid = Str::uuid();
    @endphp
    <div class="atropos my-atropos" id="atropos-banner-{{ $banner_uid }}">
        <!-- scale container (required) -->
        <div class="atropos-scale">
            <!-- rotate container (required) -->
            <div class="atropos-rotate">
                <!-- inner container (required) -->
                <div class="atropos-inner">
                    <div class="relative grid h-full p-4">
                        <img class="absolute size-1/3" src="{{ $item->getFirstMediaUrl('banner_particle_back') }}"
                            alt="{{ $item->title ? $item->title : $item->getFirstMedia('banner_particle_back')->name }}" />
                        <img class="max-h-96" src="{{ $item->getFirstMediaUrl('banner_product') }}"
                            alt="{{ $item->title ? $item->title : $item->getFirstMedia('banner_product')->name }}" />
                        <img class="absolute size-1/3" src="{{ $item->getFirstMediaUrl('banner_particle_front') }}"
                            alt="{{ $item->title ? $item->title : $item->getFirstMedia('banner_particle_front')->name }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if ($url)
    </a>
@endif

@push('after-scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            window.Atropos({
                el: "{{ '#atropos-banner-' . $banner_uid }}",
                highlight: false,
                shadow: false,
                // rotateXMax: 5,
                // rotateYMax: 5,
                easing: "cubic-bezier(0.03, 0.98, 0.52, 0.99)",
                // rest of parameters
            });
        });
    </script>
@endpush
