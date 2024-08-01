<x-layouts.app>

    <section class="relative bg-left-top bg-repeat py-10"
        style="background-image: url('{{ asset('img/bata-pattern.png') }}'); background-size: 50%;">


    </section>


    <livewire:frontend.products :tags="$tags" :categories="$categories" />

</x-layouts.app>
