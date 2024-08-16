@props(['url' => null])
<section {{ $attributes->withoutTwMergeClasses()->twMerge('w-full') }}>
    <video class="w-full object-center" src="{{ $url }}" autoplay muted loop></video>
</section>
