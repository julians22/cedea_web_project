<x-layouts.app>
    {{-- @dd($banners) --}}
    <x-header-banner class:wrapper="max-md:max-h-[100dvh] md:h-[650px]" :banners="$banners" type='news' />

    {{-- News Section --}}
    <livewire:news-list />


</x-layouts.app>
