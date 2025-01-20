@props(['name', 'label' => null, 'options' => [], 'model'])

<div class="flex !flex-row flex-wrap gap-4">
    <label>{{ $label }}</label>

    @foreach ($options as $value => $label)
        <div class="inline-flex w-fit items-center">
            <input class="h-4 w-4 rounded-full text-cedea-red focus:ring-cedea-red"
                id="{{ $name }}-{{ $value }}" wire:model="{{ $model }}" type="radio"
                value="{{ $value }}" name="{{ $name }}" />
            <label class="ml-1 block text-sm font-medium text-black" for="{{ $name }}-{{ $value }}">
                {{ $label }}
            </label>
        </div>
    @endforeach
</div>
