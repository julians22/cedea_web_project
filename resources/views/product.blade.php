@extends('layouts.app')

@section('content')


<section class="bg-repeat bg-left-top py-8 xl:py-10 relative" style="background-image: url('{{asset('img/bata-pattern.png')}}'); background-size: 50%;">

    <div class="container space-y-8" x-data="productState">

        <h1 class="text-center text-cedea-red cedea-title">Produk</h1>

        <div class="max-w-full lg:max-w-2xl mx-auto relative flex w-full items-center justify-center space-x-0 lg:space-x-8 px-4 lg:px-0">
            @foreach ($categories as $item)
                <div class="category-item" :class="(activeCategory == '{{$item->slug}}') ? 'active' : ''" @click="toggleActiveCategory('{{$item->slug}}')">
                    <div class="category-box">
                        <img src="{{ $item->media[0]->original_url }}" alt="" class="w-10/12 mx-auto">
                    </div>
                </div>
            @endforeach
        </div>

        <div class="relative w-full">
            <div class="flex flex-wrap items-center justify-center gap-y-3 gap-x-2 lg:gap-x-4">
                @foreach ($tags as $item)
                    <div class="tag-link" :class="(activeTag == '{{$item->slug}}') ? 'active' : ''" @click="toggleActiveTag('{{$item->slug}}')"">{{ $item->name }}</div>
                @endforeach
            </div>
        </div>


        <div class="relative w-full">

        </div>



    </div>

</section>


@endsection

@push('after-scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('productState', (initialTagState = null, initialCategoryState = null) => ({
                activeCategory : initialCategoryState,
                activeTag: initialTagState,

                toggleActiveTag(tag){
                    if (tag != this.activeTag) {
                        this.activeTag = tag;
                    }else{
                        this.activeTag = null;
                    }
                },

                toggleActiveCategory(category){
                    if (category != this.activeCategory) {
                        this.activeCategory = category;
                    }else{
                        this.activeCategory = null;
                    }
                },
            }));
        })
    </script>
@endpush
