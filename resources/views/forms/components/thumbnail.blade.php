<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }">
        <img class="aspect-video w-full max-w-none rounded object-cover object-center ring-white dark:ring-gray-900"
            :src="state" alt="video thumbnail">
    </div>
</x-dynamic-component>
