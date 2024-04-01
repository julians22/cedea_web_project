@extends('layouts.app')

@section('content')


<section class="bg-repeat bg-left-top py-10 relative" style="background-image: url('{{asset('img/bata-pattern.png')}}'); background-size: 50%;">

    <div class="container space-y-8">

        <h1 class="text-center text-cedea-red cedea-title">Produk</h1>


        <livewire:frontend.product-component :tags="$tags" :categories="$categories"/>


    </div>

</section>


@endsection
