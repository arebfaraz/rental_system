<div wire:ignore>
    <select
        x-data="{
            tomSelect: null,
            options: {{ json_encode($attributes['options']) }},
            selectValue: @entangle($attributes->whereStartsWith('wire:model')->first()),
           }"
        x-init="tomSelect = new TomSelect($refs.select, {
                options: options,
                items: selectValue,
                valueField: 'value',
                labelField: 'text',
                hidePlaceholder: true,
                searchField: ['text'],
                maxItems: 1,
            })

            tomSelect.on('change', function() {
                $wire.set('{{ $attributes->whereStartsWith('wire:model')->first() }}', tomSelect.getValue())
            })

            $watch('selectValue', value => {
                if ([null, undefined, ''].includes(value)) {
                     tomSelect.clear();
                     return;
                }
                tomSelect.setValue(value);
            })
            "
        x-ref="select"
        x-cloak
        {!! $attributes->except(['options', 'wire:model']) !!}
    >
    </select>
</div>

@pushonce('css')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
@endpushonce

@pushonce('scripts')

    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
@endpushonce

