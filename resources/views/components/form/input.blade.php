@props(['name', 'label' => ''])

<x-form.field>
    <x-form.label name="{{ $label }}" />
    <div class="mb-2">

        <input
            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
            name="{{ $name }}" id="{{ $name }}"
            {{ $attributes(['value' => old($name)]) }}>
    </div>

    <x-form.error name="{{ $name }}" />
</x-form.field>
