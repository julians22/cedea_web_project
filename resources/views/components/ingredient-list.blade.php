<div class="relative w-full max-w-sm" x-data="{
    tabSelected: 1,
    tabId: $id('tabs'),
    tabButtonClicked(tabButton) {
        this.tabSelected = tabButton.id.replace(this.tabId + '-', '');
        this.tabRepositionMarker(tabButton);
    },
    tabRepositionMarker(tabButton) {
        this.$refs.tabMarker.style.width = tabButton.offsetWidth + 'px';
        this.$refs.tabMarker.style.height = tabButton.offsetHeight + 'px';
        this.$refs.tabMarker.style.left = tabButton.offsetLeft + 'px';
    },
    tabContentActive(tabContent) {
        return this.tabSelected == tabContent.id.replace(this.tabId + '-content-', '');
    }
}" x-init="tabRepositionMarker($refs.tabButtons.firstElementChild);">

    @php
        $ingredients = [];
    @endphp

    <div class="relative inline-grid h-10 w-full select-none grid-cols-2 items-center justify-center rounded-lg bg-gray-100 p-1 text-gray-500"
        x-ref="tabButtons">
        <button
            class="relative z-20 inline-flex h-8 w-full cursor-pointer items-center justify-center whitespace-nowrap rounded-md px-3 text-sm font-medium transition-all"
            :id="$id(tabId)" @click="tabButtonClicked($el);" type="button">Bahan Utama</button>
        <button
            class="relative z-20 inline-flex h-8 w-full cursor-pointer items-center justify-center whitespace-nowrap rounded-md px-3 text-sm font-medium transition-all"
            :id="$id(tabId)" @click="tabButtonClicked($el);" type="button">Bahan Saus</button>
        <div class="absolute left-0 z-10 h-full w-1/2 duration-300 ease-out" x-ref="tabMarker" x-cloak>
            <div class="h-full w-full rounded-md bg-white shadow-sm"></div>
        </div>
    </div>

    <div class="content relative mt-2 w-full">
        <div class="relative" :id="$id(tabId + '-content')" x-show="tabContentActive($el)">
            <!-- Tab Content 1 - Replace with your content -->

            <!-- End Tab Content 1 -->
        </div>

        <div class="relative" :id="$id(tabId + '-content')" x-show="tabContentActive($el)" x-cloak>
            <!-- Tab Content 2 - Replace with your content -->
            <div class="bg-card rounded-lg border text-neutral-900 shadow-sm">
                <div class="flex flex-col space-y-1.5 p-6">
                    <h3 class="text-lg font-semibold leading-none tracking-tight">Password</h3>
                    <p class="text-sm text-neutral-500">Change your password here. After saving, you'll be logged out.
                    </p>
                </div>
                <div class="space-y-2 p-6 pt-0">
                    <div class="space-y-1"><label
                            class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                            for="password">Current Password</label><input
                            class="ring-offset-background peer flex h-10 w-full rounded-md border border-neutral-300 bg-white px-3 py-2 text-sm placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-neutral-400 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                            id="password" type="password" placeholder="Current Password" /></div>
                    <div class="space-y-1"><label
                            class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                            for="password_new">New Password</label><input
                            class="ring-offset-background flex h-10 w-full rounded-md border border-neutral-300 bg-white px-3 py-2 text-sm placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-neutral-400 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                            id="password_new" type="password" placeholder="New Password" /></div>
                </div>
                <div class="flex items-center p-6 pt-0"><button
                        class="focus:shadow-outline inline-flex items-center justify-center rounded-md bg-neutral-950 px-4 py-2 text-sm font-medium tracking-wide text-white transition-colors duration-200 hover:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2"
                        type="button">Save password</button></div>
            </div>
            <!-- End Tab Content 2 -->
        </div>

    </div>
</div>
