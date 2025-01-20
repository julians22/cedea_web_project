@props(['name', 'label' => null, 'placeholder', 'options' => [], 'model'])

<div>
    <label for="{{ $name }}">{{ $label ?? $name }}</label>
    <select class="block w-full text-black [&:not(:focus)]:has-[:disabled:checked]:text-gray-500/50"
        id="{{ $name }}" wire:model="{{ $model }}">
        <option value="0" readonly="true" hidden="true" disabled selected>{{ $placeholder }}</option>
        @foreach ($options as $value => $label)
            <option value="{{ $value }}">{{ $label }}</option>
        @endforeach
    </select>
</div>
