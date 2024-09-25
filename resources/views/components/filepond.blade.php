@pushonce('css')

    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">

    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
          rel="stylesheet"/>

    <style>
        /*Filepond styles*/
        .filepond--item {
            width: calc(50% - 0.5em);
        }

        @media (min-width: 30em) {
            .filepond--item {
                width: calc(50% - 0.5em);
            }
        }

        @media (min-width: 50em) {
            .filepond--item {
                width: calc(33.33% - 0.5em);
            }
        }
    </style>
@endpushonce

<div wire:ignore x-data x-init="document.addEventListener('livewire:initialized',()=> {
    const pond = FilePond.create($refs.input, {
        allowMultiple: {{ isset($attributes['multiple']) ? 'true' : 'false' }},
        allowReorder: true,
        credits: false,
        allowImagePreview:true,
        imagePreviewHeight: 180,
        imagePreviewMaxFileSize: '5MB',
        imagePreviewTransparencyIndicator: 'grid',
        maxFiles: {{ isset($attributes['maxFiles'])? $attributes['maxFiles'] : 'null' }},
        server: {
            process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                @this.upload('{{ $attributes['wire:model'] }}', file, load, error, progress)
            },
            revert: (filename, load) => {
                @this.removeUpload('{{ $attributes['wire:model'] }}', filename, load)
            },
        },
        imageTransformOutputQuality: 50,
        imageResizeTargetWidth: 1200,
    });
    this.addEventListener('pondReset', e => {
        pond.removeFiles();
    });

     this.addEventListener('clear-files', e => {
        pond.removeFiles();
    });

});">
    <input type="file"
           x-ref="input" {!! isset($attributes['accept']) ? 'accept="' . $attributes['accept'] . '"' : '' !!}>
</div>

@pushonce('scripts')
    <script
        src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script
        src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script>
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        FilePond.registerPlugin(FilePondPluginFileValidateSize);
        FilePond.registerPlugin(FilePondPluginImagePreview);
    </script>
@endpushonce
