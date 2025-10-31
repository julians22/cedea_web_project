@props(['show'])

<div class="container pointer-events-none grid lg:grid-cols-2" x-show="{{ $show }}" x-cloak>
    <div class="pointer-events-auto relative bg-white lg:col-start-2">

        <div class="top-12 flex flex-col items-start justify-center gap-12 rounded-md px-10 py-14 font-medium lg:sticky">

            <h2 class="section-title">
                Terima kasih sudah menghubungi kami, pesan anda sedang kami proses.
            </h2>

            <button
                class="h-10 w-40 cursor-pointer items-center justify-center overflow-hidden rounded-full border-none bg-cedea-red-500 text-white shadow-md"
                type="button" @click="{{ $show }}=false">
                Tutup Pesan
            </button>
        </div>
    </div>
</div>
