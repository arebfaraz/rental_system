@props(['loading' => false])

@php
    $target = $attributes->wire('click')->value();
@endphp

<div>
    <button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn']) }}
            wire:loading.attr="disabled"
            wire:target="{{ $target }}"
            id="{{ uniqid() }}">
        <div wire:loading wire:target="{{ $target }}">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        </div>
        @if($loading !== false)
            <div wire:loading wire:target="{{ $target }}">
                <span>{{ $loading }}</span>
            </div>
            <div wire:loading.remove wire:target="{{ $target }}">
                <span>{{ $slot }}</span>
            </div>
        @else
            {{ $slot }}
        @endif
    </button>
</div>
