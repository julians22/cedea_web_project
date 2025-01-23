<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }">
        <img :src="state" alt="video thumbnail">
    </div>
</x-dynamic-component>
