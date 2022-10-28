@props(['name'])

<label class="mb-2 ml-1 font-bold text-xs text-slate-700"
       for="{{ $name }}"
>
    {{ ucwords($name) }}
</label>
