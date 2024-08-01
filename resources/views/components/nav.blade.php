@push('after-scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('navigation', () => ({
                navigationMenuOpen: false,
                navigationMenu: '',
                navigationMenuCloseDelay: 200,
                navigationMenuCloseTimeout: null,
                navigationMenuLeave() {
                    let that = this;
                    this.navigationMenuCloseTimeout = setTimeout(() => {
                        that.navigationMenuClose();
                    }, this.navigationMenuCloseDelay);
                },
                navigationMenuReposition(navElement) {
                    this.navigationMenuClearCloseTimeout();
                    this.$refs.navigationDropdown.style.left = navElement.offsetLeft + 'px';
                    this.$refs.navigationDropdown.style.marginLeft = (navElement.offsetWidth / 2) +
                        'px';
                },
                navigationMenuClearCloseTimeout() {
                    clearTimeout(this.navigationMenuCloseTimeout);
                },
                navigationMenuClose() {
                    this.navigationMenuOpen = false;
                    this.navigationMenu = '';
                }
            }))
        })
    </script>
@endpush

{{-- ? Main Menu --}}
<div class="flex items-center justify-end gap-4 lg:justify-center" data-mobile-nav-open
    x-bind:data-mobile-nav-open="mobileNavOpen ? 'true' : 'false'" x-data="{ mobileNavOpen: false, hoverPosition: null }"
    x-resize.document="if($width> 1024) mobileNavOpen=false;">

    <nav class="relative z-10 w-auto bg-cedea-red text-white" x-data="navigation">

        {{-- Desktop nav --}}
        <div class="relative ~lg:~text-xs/base max-lg:hidden">
            {{-- main nav --}}
            <div class="relative">
                <ul class="flex flex-1 list-none items-center justify-center">
                    {{-- home --}}
                    <li class="gap-y-1 px-5 py-7 font-medium transition-colors"
                        @mouseover="navigationMenuOpen=true; navigationMenuReposition($el); navigationMenu='home'"
                        @mouseleave="navigationMenuLeave()">
                        <a class="relative font-medium transition-colors after:absolute after:left-0 after:top-8 after:h-1 after:w-0 after:bg-transparent after:transition-all after:duration-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50"
                            :class="{
                                'after:bg-white after:w-1/2': navigationMenu=='home',
                                'after:bg-transparent after:w-0 ': navigationMenu!='home'
                            }"
                            href="{{ route('home') }}">
                            Beranda
                            {{-- <x-lucide-house class="size-4" /> --}}
                        </a>

                    </li>

                    @foreach ($nav_items as $item)
                        <li class="gap-y-1 px-5 py-7 font-medium transition-colors"
                            @mouseover="navigationMenuOpen=true; navigationMenuReposition($el); navigationMenu='{{ Str::kebab($item['label']) }}'"
                            @mouseleave="navigationMenuLeave()">
                            <a class="relative font-medium transition-colors after:absolute after:left-0 after:top-8 after:h-1 after:w-0 after:bg-transparent after:transition-all after:duration-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50"
                                :class="{
                                    'after:bg-white after:w-1/2': navigationMenu=='{{ Str::kebab($item['label']) }}',
                                    'after:bg-transparent after:w-0 ': navigationMenu!='{{ Str::kebab($item['label']) }}'
                                }"
                                href="{{ $item['route'] }}">
                                {{ $item['label'] }}
                            </a>

                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- submenu --}}
            <div class="absolute top-20 -translate-x-1/2 text-center duration-200 ease-out" x-ref="navigationDropdown"
                x-show="navigationMenuOpen" x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90" @mouseover="navigationMenuClearCloseTimeout()"
                @mouseleave="navigationMenuLeave()" x-cloak>
                <div class="flex h-auto w-auto justify-center bg-cedea-red shadow-sm">
                    @foreach ($nav_items as $item)
                        @if (array_key_exists('submenu', $item) && count($item['submenu']))
                            <div class="flex w-full max-w-sm items-stretch justify-center gap-x-3"
                                x-show="navigationMenu == '{{ Str::kebab($item['label']) }}'">
                                <div class="w-52">
                                    @foreach ($item['submenu'] as $item_submenu)
                                        @if (array_key_exists('submenu', $item_submenu) && count($item_submenu['submenu']))
                                            <div class="group relative w-full">
                                                <a class="after:animate-in after:slide-in-from-left-1 flex cursor-pointer select-none items-center justify-center rounded py-3 ease-out after:absolute after:-right-1 after:origin-left after:-translate-x-full after:bg-cedea-red after:opacity-0 after:duration-100 group-hover:shadow-nav group-hover:after:visible group-hover:after:h-full group-hover:after:w-2 group-hover:after:translate-x-0 group-hover:after:opacity-100"
                                                    href="{{ $item_submenu['route'] }}" @click="navigationMenuClose()">
                                                    <span
                                                        class="mb-1 block font-medium">{{ $item_submenu['label'] }}</span>
                                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <polyline points="9 18 15 12 9 6"></polyline>
                                                    </svg>
                                                </a>

                                                {{-- sub-submenu --}}
                                                <div class="invisible absolute -right-1 top-1/2 mr-1 -translate-y-1/2 translate-x-full opacity-0 duration-200 ease-out group-hover:visible group-hover:mr-0 group-hover:opacity-100"
                                                    data-submenu="">
                                                    <div
                                                        class="animate-in slide-in-from-left-1 z-50 w-52 min-w-[8rem] max-w-sm overflow-hidden bg-cedea-red text-center">
                                                        @foreach ($item_submenu['submenu'] as $sub_submenu)
                                                            <a class="relative flex cursor-pointer select-none items-center justify-center rounded px-2 py-3 outline-none hover:shadow-nav data-[disabled]:pointer-events-none data-[disabled]:opacity-50"
                                                                href="{{ $sub_submenu['route'] }}">{{ $sub_submenu['label'] }}</a>
                                                            <div class="mx-auto h-px w-2/6 bg-neutral-200 last:hidden">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <a class="block cursor-pointer rounded px-3.5 py-3 hover:shadow-nav"
                                                href="{{ $item_submenu['route'] }}" @click="navigationMenuClose()">
                                                <span
                                                    class="mb-1 block font-medium">{{ $item_submenu['label'] }}</span>
                                            </a>
                                        @endif
                                        <div class="mx-auto h-px w-2/6 bg-neutral-200 last:hidden"></div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </nav>

    <div class="flex justify-start gap-4 lg:flex-row lg:justify-end lg:gap-x-6 lg:gap-y-0">
        <button class="text-xl">
            <svg class="w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36.42 36.41">
                <g>
                    <path class="fill-current"
                        d="m15.67.07c1,.09,1.97.29,2.92.59,2.65.84,4.88,2.33,6.67,4.46,2.03,2.43,3.13,5.24,3.32,8.39.06.98.01,1.96-.14,2.93-.36,2.34-1.25,4.47-2.66,6.37q-.22.3.04.56c3.33,3.33,6.66,6.66,9.99,9.99.05.05.1.09.14.14.4.45.55.98.42,1.56-.19.85-1,1.42-1.86,1.32-.43-.05-.77-.24-1.08-.54-2.11-2.12-4.23-4.23-6.35-6.35-1.27-1.27-2.54-2.54-3.81-3.81-.15-.15-.15-.16-.32-.03-2.48,1.87-5.27,2.84-8.37,2.93-.94.03-1.87-.05-2.79-.22-3.23-.6-5.96-2.1-8.15-4.55C1.28,21.17.09,18.04,0,14.5c-.02-.9.05-1.79.22-2.68.6-3.26,2.12-6.02,4.6-8.21C7.51,1.22,10.69.04,14.28,0c.46,0,.93.02,1.39.07ZM3.44,14.29c0,6.04,4.89,10.87,10.86,10.87,5.94,0,10.86-4.78,10.86-10.87,0-6.17-5.04-10.88-10.85-10.85-5.88-.04-10.87,4.75-10.87,10.85Z" />
                </g>
            </svg>
        </button>

        <button class="flex flex-row items-center space-x-2" type="button">
            <span>
                ID
            </span>
            <span class="inline">
                <svg class="inline w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.96 11.07">
                    <g>
                        <polyline points="1.5 1.5 7.62 9.57 13.46 1.87"
                            style="fill: none; stroke: #fff; stroke-linecap: round; stroke-linejoin: round; stroke-width: 3px;" />
                    </g>
                </svg>
            </span>
        </button>

        {{-- burger menu --}}
        <label class="flex h-10 w-9 cursor-pointer flex-col items-center justify-center lg:hidden">
            <input class="peer hidden" type="checkbox" x-model="mobileNavOpen" />
            <div
                class="h-[2px] w-[50%] origin-left translate-y-[0.45rem] rounded-sm bg-white transition-all duration-300 peer-checked:rotate-[-45deg]">
            </div>
            <div
                class="h-[2px] w-[50%] origin-center rounded-md bg-white transition-all duration-300 peer-checked:hidden">
            </div>
            <div
                class="h-[2px] w-[50%] origin-left -translate-y-[0.45rem] rounded-md bg-white transition-all duration-300 peer-checked:rotate-[45deg]">
            </div>
        </label>
    </div>

    {{-- Mobile Nav --}}
    <nav class="absolute left-0 top-14 -z-1 flex w-full flex-col gap-y-4 overflow-auto bg-cedea-red px-4 transition-all duration-700 lg:hidden"
        x-trap.inert.noscroll.noautofocus="mobileNavOpen" x-cloak
        :class="{
            'animate-in max-h-dvh h-screen slide-in-from-top py-4': mobileNavOpen,
            'max-h-0 p-0':
                !mobileNavOpen
        }">

        {{-- nav items --}}
        <ul class="container flex w-full list-none flex-col justify-center gap-y-8 bg-cedea-red pb-16 pt-10 lg:hidden">
            <li>
                <a class="relative inline-flex cursor-pointer flex-col rounded-md font-medium transition-colors"
                    href="{{ route('home') }}">
                    Beranda
                </a>
            </li>
            @foreach ($nav_items as $item)
                <li class="focus:outline-none">
                    <a class="relative inline-flex cursor-pointer flex-col rounded-md font-medium transition-colors"
                        href="{{ $item['route'] }}">
                        {{ $item['label'] }}
                    </a>

                    @if (array_key_exists('submenu', $item) && count($item['submenu']))
                        <ul class="px-3.5">
                            @foreach ($item['submenu'] as $item_submenu)
                                <a class="flex cursor-pointer items-center py-3" href="{{ $item_submenu['route'] }}">
                                    <span class="mb-1 block font-medium">{{ $item_submenu['label'] }}</span>
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </a>
                                {{-- sub-submenu --}}

                                @if (array_key_exists('submenu', $item_submenu) && count($item_submenu['submenu']))
                                    <li class="relative w-full focus:outline-none">
                                        <ul
                                            class="animate-in slide-in-from-top-1 z-50 min-w-[8rem] max-w-sm overflow-hidden bg-cedea-red p-1 pl-6">
                                            @foreach ($item_submenu['submenu'] as $sub_submenu)
                                                <li class="relative cursor-pointer py-3 focus:outline-none">
                                                    <a class="data-[disabled]:pointer-events-none data-[disabled]:opacity-50"
                                                        href="{{ $sub_submenu['route'] }}">{{ $sub_submenu['label'] }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>

    </nav>

</div>
