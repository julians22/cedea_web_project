@props(['name', 'label' => null, 'type' => 'text', 'placeholder', 'element' => 'input', 'model'])

<div>
    <label for="{{ $name }}">{{ $label ?? $name }}</label>

    <{{ $element }} wire:loading.attr="disabled" placeholder="{{ $placeholder }}" type="{{ $type }}"
        name="{{ $name }}" wire:model="{{ $model }}" {{ $attributes }}>
        </{{ $element }}>

        <span class="text-sm font-normal">
            @error($name)
                {{ $message }}
            @enderror
        </span>
</div>
