@props(['content' => ''])
<div>
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }

        .trix-button--icon-link {
            display: none;
        }
    </style>

    <script>
        document.addEventListener('trix-file-accept', function (event) {
            event.preventDefault();
        })
    </script>
    <div class="trix-content"
         x-data="{
        value: @entangle($attributes->wire('model')),
        isFocused() { return document.activeElement !== this.$refs.trix },
        setValue() { this.$refs.trix.editor.loadHTML(this.value) },
    }"
         x-init="document.addEventListener('livewire.initialized',()=>{
            setValue();
            $watch('value', () => isFocused() && setValue())
        });        "
         x-on:trix-change="value = $event.target.value"
         @foo.window="value = $event.detail.content; setValue();"
         x-on:trix-initialize="$el.querySelector('.trix-button-group--file-tools')?.remove()"
         x-on:trix-attachment-add="$event.preventDefault();"
         x-on:trix-attachment-add.prevent="$event.attachment.file || $event.attachment.remove()"
         {{ $attributes->whereDoesntStartWith('wire:model') }}
         wire:ignore>
        <input id="x" type="hidden" value="{{$content}}">
        <trix-editor x-ref="trix" input="x" class="form-textarea trix-content"></trix-editor>
    </div>
</div>

@pushonce('css')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
@endpushonce
