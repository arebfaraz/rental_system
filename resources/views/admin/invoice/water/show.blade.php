@extends('layouts.main')

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head">
                        <div class="nk-block-between g-3">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">{{ __('Water Bill Invoice')}} <strong
                                        class="text-primary small">#{{ $invoice->id }}</strong>
                                </h3>
                                <div class="nk-block-des text-soft">
                                    <ul class="list-inline">
                                        <li>Created At: <span
                                                class="text-base">{{ $invoice->invoice_date->toDayDateTimeString() }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <x-back_link href="{{ route('admin.water-invoice.index') }}"></x-back_link>


                            </div>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="invoice">
                            <div class="invoice-action">
                                <a class="btn btn-icon btn-lg btn-white btn-dim btn-outline-primary"
                                   href="{{ route('admin.water-invoice.print',$invoice->id) }}" target="_blank"><em
                                        class="icon ni ni-printer-fill"></em></a>
                            </div><!-- .invoice-actions -->
                            <div class="invoice-wrap">
                                <div class="invoice-brand text-center">
                                    <img src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="">
                                </div>
                                <div class="invoice-head">
                                    <div class="invoice-contact">
                                        <span class="overline-title">{{ __('Invoice To')}}</span>
                                        <div class="invoice-contact-info">
                                            <h4 class="title">{{ $invoice->tenant?->name }}</h4>
                                            <ul class="list-plain">
                                                <li>
                                                    <span>{{ $invoice->tenant?->email }}<br>
                                                        {{ $invoice->tenant?->phone }}<br>
                                                        {{ $invoice->tenant?->address }}
                                                    </span>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="invoice-desc">
                                        <h3 class="title">{{ __('Invoice')}}</h3>
                                        <ul class="list-plain">
                                            <li class="invoice-id">
                                                <span>{{ __('Invoice ID')}}</span>:<span>{{ $invoice->id }}</span>
                                            </li>
                                            <li class="invoice-date">
                                                <span>{{ __('Date')}}</span>:<span>{{ $invoice->invoice_date->format('M d,Y') }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- .invoice-head -->
                                <div class="invoice-bills">
                                    <div class="table-responsive">
                                        <table class="table table-striped datatable-wrap">
                                            <thead>
                                            <tr>
                                                <th class="w-150px">{{ __('Item ID')}}</th>
                                                <th>Previous Reading</th>
                                                <th>Current Reading</th>
                                                <th>Rate</th>
                                                <th class="w-60">{{ __('Description')}}</th>


                                                <th>{{ __('Amount')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    {{ $invoice->waterReading?->previous_reading }}
                                                </td>
                                                <td>
                                                    {{ $invoice->waterReading?->previous_reading }}
                                                </td>
                                                <td>
                                                    {{ setting('currency_symbol').' '.number_format($invoice->waterReading?->cost_per_unit,2) }}
                                                </td>
                                                <td>{{ __('Water bill payment for')}} {{ $invoice->property?->name??'' }}
                                                    ,{{ $invoice->house?->name??'' }} <br>
                                                    Units Consumed: {{ $invoice->waterReading?->consumption }}
                                                </td>

                                                <td>
                                                    {{ setting('currency_symbol').' '.number_format($invoice->amount,2) }}
                                                </td>
                                            </tr>

                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <td colspan="5"></td>
                                                <td>
                                                    {{ __('Total:')}} {{ setting('currency_symbol').' '.number_format($invoice->amount,2) }}
                                                </td>
                                            </tr>

                                            </tfoot>
                                        </table>

                                        @if($invoice->notes)
                                            <div class="nk-notes"> {!! $invoice->notes  !!}   </div>
                                        @endif


                                    </div>
                                </div>
                            </div><!-- .invoice-wrap -->
                        </div><!-- .invoice -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>

@endsection
