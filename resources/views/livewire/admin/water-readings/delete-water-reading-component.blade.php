<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-body modal-body-lg text-center">
            <div class="nk-modal">
                <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                <h4 class="nk-modal-title">{{__('Confirm Water Reading Deletion!')}}</h4>
                <div class="nk-modal-text">
                    <p class="text-soft">
                        Proceed with caution.Deleting a water reading that is already consumed and billed will result to
                        the removal of water bill invoice and the payments associated with it.

                    </p>
                    <p class="text-soft">
                        You can add a new reading after deletion.
                    </p>
                </div>
                <div class="d-flex justify-content-center align-items-center mt-5">
                    <a href="#" class="btn btn-lg btn-mw btn-light me-3" data-bs-dismiss="modal">{{ __('Cancel')}}</a>
                    <x-button loading="{{ __('Deleting...') }}"
                              wire:click="deleteReading"
                              class="btn btn-lg btn-mw btn-danger">
                        {{ __('Delete Reading') }}
                    </x-button>
                </div>

            </div>
        </div><!-- .modal-body -->
    </div>
</div>

@script
<script>
    $wire.on('openModal', function () {
        $('#modalDeleteReading').modal('show');
    })
</script>
@endscript
