<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-body modal-body-lg text-center">
            <div class="nk-modal">
                <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                <h4 class="nk-modal-title">{{__('Confirm Payment Deletion!')}}</h4>
                <div class="nk-modal-text">
                    <p class="text-soft">
                        {{ __('Are you sure you want to delete this payment?') }}
                        .</p>
                    <p class="text-soft">{{ __('If you really want to delete the payment,proceed.')}}</p>
                </div>
                <div class="d-flex justify-content-center align-items-center mt-5">
                    <a href="#" class="btn btn-lg btn-mw btn-light me-3" data-bs-dismiss="modal">{{ __('Cancel')}}</a>
                    <x-button loading="{{ __('Deleting...') }}"
                              wire:click="submit"
                              class="btn btn-lg btn-mw btn-danger">
                        {{ __('Delete Payment') }}
                    </x-button>
                </div>

            </div>
        </div><!-- .modal-body -->
    </div>
</div>
@script
<script>
    $wire.on('openDeletePaymentModal', () => {
        $('#deletePaymentModal').modal('show');
    })

    $('#deletePaymentModal').on("hidden.bs.modal", function () {
        $wire.resetAll();
    });
</script>
@endscript
