<ul class="nk-tb-actions gx-1">
    <li>
        <div class="drodown">
            <a href="#"
               class="dropdown-toggle btn btn-icon btn-trigger"
               data-bs-toggle="dropdown"><em
                    class="icon ni ni-more-h"></em></a>
            <div
                class="dropdown-menu dropdown-menu-end">
                <ul class="link-list-opt no-bdr">

                    @can(config('permission.permissions.read_rent_invoice'))

                        <li>
                            <a href="{{ route('admin.rent-invoice.show',$invoice->id) }}">
                                <em class="icon ni ni-eye"></em>
                                <span>{{ __('View Invoice')}}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.rent-invoice.print',$invoice->id) }}" target="_blank" download>
                                <em class="icon ni ni-printer"></em>
                                <span>{{ __('Print Invoice')}}</span>
                            </a>
                        </li>
                    @endcan

                    <li>
                        <a href="{{ route('admin.rent-invoice.edit',$invoice->id) }}">
                            <em class="icon ni ni-edit-fill"></em>
                            <span>{{ __('Modify Invoice Bills')}}</span>
                        </a>
                    </li>

                    @if($invoice->status == \App\Enums\PaymentStatusEnum::PENDING || $invoice->status == \App\Enums\PaymentStatusEnum::PARTIALLY_PAID)
                        @can(config('permission.permissions.notify_rent_invoice'))
                            <li>
                                <a href="javascript:void(0);"
                                   x-data x-on:click="$dispatch('notifyTenantPayment', { id: '{{ $invoice->id }}' })">
                                    <em class="icon ni ni-repeat"></em>
                                    <span>{{ __('Notify Tenant')}}</span>
                                </a>
                            </li>
                        @endcan

                            @can(config('permission.permissions.pay_rent_invoice'))
                            <li>
                                <a href="javascript:void(0);"
                                   x-data
                                   x-on:click="$dispatch('payInvoice', { id: '{{ $invoice->id }}' })">
                                    <em class="icon ni ni-activity-round"></em>
                                    <span>{{ __('Record Payment')}}</span>
                                </a>
                            </li>
                        @endcan
                    @endif

                </ul>
            </div>
        </div>
    </li>
</ul>
