<section {{ $attributes->withoutTwMergeClasses()->twMerge('h-dvh w-full') }} x-data="{ width: 0, height: 0, headerHeight: 0, header: document.querySelector('header') }"
    x-resize.document="width = $width; height = $height; headerHeight = header.getBoundingClientRect()['height'];"
    :style="`height: ${width>1024 ? 'calc(100dvh - ' + Math.floor(headerHeight)+'px)': 'auto'};`">

    <video class="h-full w-full object-cover object-center" src="https://cdn.devdojo.com/pines/videos/coast.mp4" autoplay
        muted loop></video>
</section>
