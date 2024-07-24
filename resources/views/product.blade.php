<x-layouts.app>

    <section class="relative bg-left-top bg-repeat py-10"
        style="background-image: url('{{ asset('img/bata-pattern.png') }}'); background-size: 50%;">

        <div class="container space-y-8">

            <h1 class="cedea-title text-center text-cedea-red">Produk</h1>


            <livewire:frontend.products :tags="$tags" :categories="$categories" />


        </div>

    </section>
</x-layouts.app>
