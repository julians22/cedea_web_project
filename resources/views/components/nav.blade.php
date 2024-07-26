{{-- ? Main Menu --}}
<div class="flex items-center justify-end gap-4 lg:justify-center" x-data="{ openNav: false, hoverPosition: null }">

    <nav class="relative z-10 w-auto bg-cedea-red text-white" x-data="{
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
            this.$refs.navigationDropdown.style.marginLeft = (navElement.offsetWidth / 2) + 'px';
        },
        navigationMenuClearCloseTimeout() {
            clearTimeout(this.navigationMenuCloseTimeout);
        },
        navigationMenuClose() {
            this.navigationMenuOpen = false;
            this.navigationMenu = '';
        }
    }">

        {{-- Desktop nav --}}
        <div class="relative max-lg:hidden">
            {{-- nav --}}
            <div class="relative">
                <ul class="group flex flex-1 list-none items-center justify-center gap-x-12">
                    @foreach ($nav_items as $item)
                        @if (array_key_exists('submenu', $item))
                            <li>
                                <a class="group relative inline-flex cursor-pointer flex-col rounded-md font-medium transition-colors after:absolute after:-bottom-2 after:h-0.5 after:px-2 after:transition-all after:duration-500 focus:outline-none disabled:pointer-events-none disabled:opacity-50"
                                    :class="{ 'after:bg-white after:w-1/2': navigationMenu=='{{ Str::kebab($item['label']) }}', 'after:bg-transparent after:w-0 ': navigationMenu!='{{ Str::kebab($item['label']) }}' }"
                                    href="{{ $item['route'] }}"
                                    @mouseover="navigationMenuOpen=true; navigationMenuReposition($el); navigationMenu='{{ Str::kebab($item['label']) }}'"
                                    @mouseleave="navigationMenuLeave()">
                                    {{ $item['label'] }}
                                </a>
                            </li>
                        @else
                            <li
                                class="flex cursor-pointer flex-col after:h-0.5 after:w-0 after:bg-transparent after:transition-all after:duration-700 hover:after:w-1/2 hover:after:bg-white">
                                <a class="inline-flex items-center justify-center font-medium transition-colors focus:outline-none disabled:pointer-events-none disabled:opacity-50"
                                    href="{{ $item['route'] }}">
                                    {{ $item['label'] }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            {{-- submenu --}}
            <div class="absolute top-2 -translate-x-1/2 translate-y-6 pt-3 text-center duration-200 ease-out"
                x-ref="navigationDropdown" x-show="navigationMenuOpen"
                x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                @mouseover="navigationMenuClearCloseTimeout()" @mouseleave="navigationMenuLeave()" x-cloak>
                <div class="flex h-auto w-auto justify-center bg-cedea-red shadow-sm">
                    @foreach ($nav_items as $item)
                        @if (array_key_exists('submenu', $item) && count($item['submenu']))
                            <div class="flex w-full max-w-sm items-stretch justify-center gap-x-3 py-4"
                                x-show="navigationMenu == '{{ Str::kebab($item['label']) }}'">
                                <div class="w-52">
                                    @foreach ($item['submenu'] as $item_submenu)
                                        @if (array_key_exists('submenu', $item_submenu) && count($item_submenu['submenu']))
                                            <div class="group relative w-full">
                                                <a class="group-hover:after flex cursor-pointer select-none items-center justify-center rounded py-3 group-hover:shadow-xl"
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
                                                        class="animate-in slide-in-from-top-1 z-50 w-52 min-w-[8rem] max-w-sm overflow-hidden bg-cedea-red p-1 text-center shadow-md">
                                                        @foreach ($item_submenu['submenu'] as $sub_submenu)
                                                            <a class="relative flex cursor-pointer select-none items-center justify-center rounded px-2 py-1.5 outline-none hover:shadow-xl data-[disabled]:pointer-events-none data-[disabled]:opacity-50"
                                                                href="{{ $sub_submenu['route'] }}">{{ $sub_submenu['label'] }}</a>
                                                            <div class="mx-auto h-px w-2/6 bg-neutral-200 last:hidden">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <a class="block cursor-pointer rounded px-3.5 py-3 hover:shadow-xl"
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

        {{-- Mobile nav --}}
        <div class="lg:hidden">
            {{-- burger menu --}}
            <label class="flex h-10 w-9 cursor-pointer flex-col items-center justify-center">
                <input class="peer hidden" type="checkbox" x-model="openNav" />
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

    </nav>

    {{-- Mobile Nav --}}
    <nav class="max-lg:t-8 top-full max-h-[91vh] gap-y-4 overflow-auto px-4 duration-700 max-lg:absolute max-lg:left-0 max-lg:-z-1 max-lg:flex max-lg:w-full max-lg:flex-col max-lg:bg-cedea-red max-lg:transition-all"
        x-trap.inert.noscroll="openNav"
        :class="{
            'animate-in h-auto slide-in-from-top-1 max-lg:py-4': openNav,
            'max-lg:h-0 p-0':
                !openNav
        }">

        {{-- nav items --}}
        <ul class="flex h-auto w-auto list-none flex-col justify-center bg-cedea-red lg:hidden">
            @foreach ($nav_items as $item)
                @if (array_key_exists('submenu', $item))
                    <li>
                        <a class="group relative inline-flex cursor-pointer flex-col rounded-md font-medium transition-colors after:absolute after:-bottom-2 after:h-0.5 after:px-2 after:transition-all after:duration-500 focus:outline-none disabled:pointer-events-none disabled:opacity-50"
                            :class="{ 'after:bg-white after:w-1/2': navigationMenu=='{{ Str::kebab($item['label']) }}', 'after:bg-transparent after:w-0 ': navigationMenu!='{{ Str::kebab($item['label']) }}' }"
                            href="{{ $item['route'] }}"
                            @mouseover="navigationMenuOpen=true; navigationMenuReposition($el); navigationMenu='{{ Str::kebab($item['label']) }}'"
                            @mouseleave="navigationMenuLeave()">
                            {{ $item['label'] }}
                        </a>

                        @if (array_key_exists('submenu', $item) && count($item['submenu']))
                    <li>
                        @foreach ($item['submenu'] as $item_submenu)
                            @if (array_key_exists('submenu', $item_submenu) && count($item_submenu['submenu']))
                                <div class="group relative w-full">
                                    <a class="group-hover:after flex cursor-pointer select-none items-center rounded py-3"
                                        href="{{ $item_submenu['route'] }}">
                                        <span class="mb-1 block font-medium">{{ $item_submenu['label'] }}</span>
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="9 18 15 12 9 6"></polyline>
                                        </svg>
                                    </a>
                                    {{-- sub-submenu --}}

                                    <div
                                        class="animate-in slide-in-from-top-1 p-1s z-50 w-52 min-w-[8rem] max-w-sm overflow-hidden bg-cedea-red">
                                        @foreach ($item_submenu['submenu'] as $sub_submenu)
                                            <a class="relative flex cursor-pointer select-none items-center rounded px-3.5 py-3 outline-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50"
                                                href="{{ $sub_submenu['route'] }}">{{ $sub_submenu['label'] }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <a class="block cursor-pointer rounded px-3.5 py-3"
                                    href="{{ $item_submenu['route'] }}">
                                    <span class="mb-1 block font-medium">{{ $item_submenu['label'] }}</span>
                                </a>
                            @endif
                        @endforeach
                    </li>
                @endif

                </li>
            @else
                <li
                    class="flex cursor-pointer flex-col after:h-0.5 after:w-0 after:bg-transparent after:transition-all after:duration-700 hover:after:w-1/2 hover:after:bg-white">
                    <a class="inline-flex items-center justify-center font-medium transition-colors focus:outline-none disabled:pointer-events-none disabled:opacity-50"
                        href="{{ $item['route'] }}">
                        {{ $item['label'] }}
                    </a>
                </li>
            @endif
            @endforeach
        </ul>

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
        </div>

    </nav>


    {{-- language & search --}}


</div>
