<div
    x-data="{ options: @entangle($attributes['options']).live, selectValue: @entangle($attributes->whereStartsWith('wire:model')->first()).live }"
    x-init="
        VirtualSelect.init({
            ele: $refs.select,
            options: options,
            hasOptionDescription: true,
            search: true,
            placeholder: 'Select',
            noOptionsText: 'No results found',
            maxWidth: '100%'
        })
        $refs.select.setValue(selectValue)
        $refs.select.addEventListener('change', () => {
            if ([null, undefined, ''].includes($refs.select.value)) {
                return
            }

            $wire.set('{{ $attributes->whereStartsWith('wire:model')->first() }}', $refs.select.value)
        })
        $watch('options', () => $refs.select.setOptions(options))
    ">
    <div x-ref="select" wire:ignore {{ $attributes }}></div>
</div>
