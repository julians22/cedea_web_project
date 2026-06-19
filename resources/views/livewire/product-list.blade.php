<div>

    <div wire:ignore>
        <x-video-player :autoplay="false" :loop="true" source_mp4="{{ asset('video/product_promo.mp4') }}" />
    </div>

    <section class="space-y-8 pb-8" x-init="$nextTick(() => {
        if ({{ $productSlug ? 'true' : 'false' }}) {
            document.getElementById('product-list').scrollIntoView({ behavior: 'smooth' })
        }
    })" x-data="productCatalog({{ $productSlug ? 'true' : 'false' }})"
        @click="handleProductTrigger($event, $wire)" @close-product-modal.window="closeProductModal()"
        x-resize="width = $width; height = $height">

        {{-- Brand --}}
        <div class="bg-products minh relative min-h-72 object-contain transition-all max-md:mb-4 lg:min-h-[450px]">

            <picture>
                <source class="block w-full" draggable="false" srcset="{{ asset('img/product-section-bg.jpg') }}"
                    media="(min-width: 1024px)" />

                <img class="w-full" draggable="false" src="{{ asset('img/product-section-bg-mobile.jpg') }}"
                    alt="Latar belakang bagian produk Cedea Seafood - menampilkan koleksi produk seafood berkualitas">
            </picture>

            <div class="container absolute ~top-4/8 md:top-1/4 lg:left-[10%] lg:top-1/2 lg:w-1/3 lg:-translate-y-1/2">
                <h1 class="section-title">{{ __('product.product.title') }}</h1>

                <p class="~text-sm/base">{{ __('product.product.detail') }}</p>
                <div class="my-4 mt-8 grid grid-cols-3 ~gap-x-2/8" type="button">
                    @foreach ($this->brands as $brand)
                        <x-product.brand-logo :brand="$brand" :active="$brand->slug == $activeBrand" />
                    @endforeach
                </div>
            </div>
        </div>

        <div class="container my-8 flex grid-cols-[25%_1fr] flex-col ~scroll-mt-24/36 ~gap-8/20 lg:grid"
            id="product-list">
            {{-- category side nav --}}
            <div class="top-28 flex h-fit flex-col gap-y-8 rounded-3xl bg-[#ebebec] ~p-4/8 lg:sticky">
                {{-- search form --}}
                <div class="lg:mt-4">
                    <label class="sr-only mb-2 text-sm font-medium" for="default-search">Search</label>
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
                            <x-lucide-search class="size-6 text-black" />
                        </div>

                        <input
                            class="block w-full rounded-full border border-black p-4 ps-10 text-sm placeholder:text-black"
                            id="product-search" wire:model.live.debounce.750ms='keyword' type="search"
                            placeholder="{{ __('Search product here') }}" />
                    </div>
                </div>

                <div class="flex flex-col gap-y-4 uppercase">
                    @foreach ($this->brands as $brand)
                        <x-product.brand-filter :brand="$brand" :active-brand="$activeBrand" />
                        <div class="mx-auto h-0.5 w-full bg-black last:hidden"></div>
                    @endforeach
                </div>
            </div>

            {{-- product grid --}}
            <div class="flex flex-col gap-4 ~scroll-mt-36/24" id="product-grid">
                <ul class="inline-grid grid-cols-2 content-center items-start ~gap-4/12 md:grid-cols-3"
                    wire:loading.delay.long.remove wire:target.except="handleChangeActiveProduct">

                    @forelse ($products as $item)
                        <x-product.card :item="$item" :index="($products->firstItem() ?? 1) + $loop->index - 1" />
                    @empty
                        <x-placeholder.empty label="{{ __('status.empty') }}" />
                    @endforelse
                </ul>

                {{--  TODO: exclude activeProductChange --}}
                <div wire:loading.delay.long wire:target.except="handleChangeActiveProduct">
                    <x-product-list-skeleton />
                </div>
                {{ $products->links('vendor.livewire.cedea', data: ['scrollTo' => false]) }}
            </div>

        </div>


        <x-modal-product-detail>

            <div class="pr-2 text-white" wire:loading.remove wire:target='handleChangeActiveProduct'>
                @if ($activeProduct)
                    <div data-active-product data-item-id="{{ $activeProduct->slug }}"
                        data-item-name="{{ $activeProduct->fullname }}"
                        data-item-brand="{{ $activeProduct->brand->name }}"
                        data-item-category="{{ $activeProduct->categories->first()?->name }}"
                        x-init="$nextTick(() => trackProductView($el.dataset))">
                        <p class="uppercase ~text-lg/xl">{{ $activeProduct->brand->name }}</p>
                        <h2 class="mt-2 uppercase ~text-xl/4xl">
                            {{ implode(' ', [$activeProduct->name, $activeProduct->size]) }}</h2>

                        <div class="mt-8 flex gap-6 max-lg:flex-col">
                            <div class="flex basis-1/5 flex-col items-center justify-center gap-y-4">
                                <img src="{{ $activeProduct->getFirstMediaUrl('packaging') }}"
                                    alt="{{ $activeProduct->fullname }} - produk {{ $activeProduct->brand->name }}">
                                <a class="w-max rounded-full bg-white px-6 py-1 text-sm font-semibold uppercase text-black"
                                    target="_blank"
                                    href="{{ $activeProduct->buy_link }}">{{ __('product.buy') }}</a>
                            </div>

                            <div class="flex flex-col gap-y-4 text-justify md:grow md:basis-2/5">
                                <div>{!! $activeProduct->description !!}</div>

                                <div>
                                    {{ $activeProduct->no_bpom }}
                                </div>

                                @if ($activeProduct->packaging)
                                    <div class="overflow-x-auto">
                                        <table class="table">
                                            {{-- <thead class="invisible">
                                                <tr>
                                                    <th>Unit</th>
                                                    <th>size</th>
                                                </tr>
                                            </thead> --}}

                                            <tbody>
                                                @foreach ($activeProduct->packaging as $package)
                                                    <tr class="table-row">
                                                        <td>{{ $package['unit'] }}&nbsp;</td>
                                                        <td>:&nbsp;{{ $package['size'] }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif

                                <div>
                                    {{ __('product.froze') }}
                                </div>

                            </div>

                            @if ($activeProduct->have_video)
                                <div class="flex basis-2/5 flex-col items-center gap-y-4">
                                    <template x-if="modalOpen">
                                        <div class="relative aspect-video w-full overflow-hidden rounded-lg">
                                            <x-matinee::embed :data="$activeProduct->video" />
                                        </div>
                                    </template>
                                    <a class="w-fit rounded-full bg-white bg-gradient-radial from-[#fdd000] to-[#fdb400] to-50% px-8 py-1 text-sm font-semibold uppercase text-black"
                                        target="_blank" href="{{ $activeProduct->video['url'] }}">Tonton
                                        videonya</a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            {{-- skeleton --}}
            <div class="space-y-4 pr-2 text-white" wire:loading wire:target='handleChangeActiveProduct'>

                <x-text-skeleton />
                <x-text-skeleton />

                <div class="grid grid-cols-1 items-center gap-6 lg:grid-cols-3">
                    <x-image-skeleton />

                    <x-paragraph-skeleton />

                    <x-video-skeleton />
                </div>

            </div>

        </x-modal-product-detail>

    </section>


    {{-- recipe --}}
    <section class="container mt-8" wire:ignore>
        <h2 class="section-title">{!! __('product.creation.title') !!}</h2>

        <p>{{ __('product.creation.detail') }}</p>

        <div>
            @use('App\Enums\RecipeType')

            @php

                $times = [
                    [
                        'label' => __('meal.breakfast'),
                        'icon' => asset('img/icons/time/sarapan.svg'),
                        'background' => asset('img/time/sarapan.jpg'),
                        'recipe_type' => RecipeType::BREAKFAST->value,
                    ],
                    [
                        'label' => __('meal.lunch'),
                        'icon' => asset('img/icons/time/makan_siang.svg'),
                        'background' => asset('img/time/makan_siang.jpg'),
                        'recipe_type' => RecipeType::LUNCH->value,
                    ],
                    [
                        'label' => __('meal.dinner'),
                        'icon' => asset('img/icons/time/makan_malam.svg'),
                        'background' => asset('img/time/makan_malam.jpg'),
                        'recipe_type' => RecipeType::DINNER->value,
                    ],
                    [
                        'label' => __('meal.snack'),
                        'icon' => asset('img/icons/time/snack.svg'),
                        'background' => asset('img/time/snack.jpg'),
                        'recipe_type' => RecipeType::SNACK->value,
                    ],
                ];
            @endphp

            <x-meals-container>
                @foreach ($times as $time)
                    <a href="{{ route('recipe', ['type' => $time['recipe_type']]) }}">
                        <x-meal-card class="cursor-pointer" :background="$time['background']" :icon="$time['icon']" :label="$time['label']" />
                    </a>
                @endforeach
            </x-meals-container>
        </div>
    </section>
</div>

@script
    <script>
        const {
            animate,
            stagger
        } = window.Motion


        Alpine.data('productCatalog', (initialModalOpen) => ({
            modalOpen: initialModalOpen,
            viewedProductId: null,
            width: window.innerWidth,
            height: window.innerHeight,
            analyticsItem(product) {
                const item = {
                    item_id: product.itemId,
                    item_name: product.itemName,
                    item_list_id: 'product_catalog',
                    item_list_name: 'Product Catalog',
                };

                if (product.itemBrand) item.item_brand = product.itemBrand;
                if (product.itemCategory) item.item_category = product.itemCategory;

                const index = Number(product.itemIndex);
                if (Number.isFinite(index)) item.index = index;

                return item;
            },
            trackProductSelection(product) {
                if (typeof window.gtag !== 'function') return;

                const item = this.analyticsItem(product);

                window.gtag('event', 'select_item', {
                    item_list_id: item.item_list_id,
                    item_list_name: item.item_list_name,
                    items: [item],
                });
            },
            trackProductView(product) {
                if (this.viewedProductId === product.itemId || typeof window.gtag !== 'function') return;

                this.viewedProductId = product.itemId;

                window.gtag('event', 'view_item', {
                    items: [this.analyticsItem(product)],
                });
            },
            handleProductTrigger(event, wire) {
                const trigger = event.target.closest('[data-product-modal-trigger]');

                if (!trigger || !this.$root.contains(trigger)) return;

                const product = trigger.closest('[data-product-item]');

                if (!product) return;

                event.preventDefault();

                this.openProductModal(product.dataset);
                wire.handleChangeActiveProduct(product.dataset.itemId);
            },
            openProductModal(product) {
                this.modalOpen = true;
                this.trackProductSelection(product);
            },
            closeProductModal() {
                this.modalOpen = false;
                this.viewedProductId = null;
            },
        }))

        $wire.on('animate-product-list', () => {
            animate("#product-grid li", {
                opacity: [0, 1],
                y: [50, 0]
            }, {
                delay: stagger(0.10, {
                    ease: "easeIn"
                })
            })
        });

        $wire.on('update-page-title', ({
            title
        }) => {
            document.title = title;
        });
    </script>
@endscript
