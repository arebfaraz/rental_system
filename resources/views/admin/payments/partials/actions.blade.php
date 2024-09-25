<ul class="nk-tb-actions gx-1">

    <li>
        <div class="dropdown">
            <a href="#"
               class="dropdown-toggle btn btn-icon btn-trigger"
               data-bs-toggle="dropdown"><em
                    class="icon ni ni-more-h"></em>
            </a>


            <div
                class="dropdown-menu dropdown-menu-end">
                <ul class="link-list-opt no-bdr">
                    @if($payment->status==\App\Enums\PaymentStatusEnum::PENDING)

                        @can(config('permission.permissions.reject_payments'))

                            <li>

                                <a href="javascript:void(0);"
                                   x-data x-on:click.prevent="$dispatch('rejectPayment',{id:'{{$payment->id}}'})">
                                    <em class="icon ni ni-cross-circle text-danger"></em>
                                    <span>{{ __('Reject Payment')}}</span>
                                </a>

                            </li>
                        @endcan

                        @can(config('permission.permissions.approve_payments'))
                            <li>
                                <a href="javascript:void(0);"
                                   x-data x-on:click.prevent="$dispatch('approvePayment',{id:'{{$payment->id}}'})">
                                    <em class="icon ni ni-check-circle text-success"></em>
                                    <span>{{ __('Approve Payment')}}</span>
                                </a>
                            </li>
                        @endcan
                    @endif


                    @can(config('permission.permissions.update_payments'))
                        <li>
                            <a href="javascript:void(0);"
                               x-data x-on:click="$dispatch('editPayment', { id: '{{ $payment->id }}' })">
                                <em class="icon ni ni-edit-alt"></em>
                                <span>{{ __('Edit Payment')}}</span>
                            </a>
                        </li>
                    @endcan

                    @can(config('permission.permissions.delete_payments'))

                        <li>
                            <a href="javascript:void(0);"
                               x-data x-on:click="$dispatch('deletePayment', { id: '{{ $payment->id }}' })">
                                <em class="icon ni ni-delete text-danger"></em>
                                <span class="text-danger">{{ __('Delete Payment')}}</span>
                            </a>
                        </li>
                    @endcan

                </ul>
            </div>


        </div>
    </li>

</ul>
