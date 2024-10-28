@props(['text' => ''])

<div class="col-span-full flex flex-col items-center justify-center self-center justify-self-center">
    <lord-icon class="~size-20/40 inline-blsock" src="https://cdn.lordicon.com/rmkpgtpt.json" trigger="in" delay="500"
        state="in-reveal" colors="primary:#e4e4e4,secondary:#e4e4e4">
    </lord-icon>

    <h2 class="section-title">
        {{ $text }}
    </h2>
</div>
