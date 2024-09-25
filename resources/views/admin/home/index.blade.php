@extends('layouts.main')

@push('css')
    <style>
        .order-card {
            color: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: all 0.3s ease-in-out;
        }

        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .bg-c-blue {
            background: linear-gradient(45deg, #4099ff, #73b4ff);
        }

        .bg-c-green {
            background: linear-gradient(45deg, #2ed8b6, #59e0c5);
        }

        .bg-c-yellow {
            background: linear-gradient(45deg, #FFB64D, #ffcb80);
        }

        .bg-c-pink {
            background: linear-gradient(45deg, #FF5370, #ff869a);
        }

        .card-block {
            padding: 1.5rem;
        }

        .order-card i {
            font-size: 2rem;
        }

        .m-b-0 {
            margin-bottom: 0;
        }

        .text-right {
            text-align: right;
        }
    </style>

@endpush

@section('content')

    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">{{ __('Dashboard Overview')}}</h3>
                                <div class="nk-block-des text-soft">
                                    <p>{{ __('Welcome to Rentals management Dashboard.')}}</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                       data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li>
                                            </li>
                                            <li class="nk-block-tools-opt">
                                                <a href="{{ route('admin.reports.company_income') }}"
                                                   class="btn btn-primary">
                                                    <em class="icon ni ni-reports"></em>
                                                    <span>{{ __('Reports')}}</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <x-admin.top-widgets/>

                        <div class="row g-gs mt-4">

                            <x-admin.general-charts-widget/>


                            <x-admin.rent-collections-graph-widget/>

                            <div class="col-md-6 col-xxl-6">
                                <x-admin.latest-notifications-widget/>
                            </div><!-- .col -->

                            @can(config('permission.permissions.read_support_tickets'))
                                <div class="col-md-6 col-xxl-6">
                                    <x-admin.latest-support-tickets-widget/>
                                </div>
                            @endcan

                            @can(config('permission.permissions.access_reports'))
                                <div class="col-xxl-12 col-md-12">
                                    <x-admin.outstanding-payments-widget/>
                                </div>
                            @endcan


                            @can(config('permission.permissions.access_reports'))
                                <div class="col-xxl-12 col-md-12">
                                    <livewire:admin.reports.expiring-leases-component/>
                                </div>
                            @endcan

                        </div><!-- .row -->


                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>

@endsection


{{--@push('scripts')--}}
{{--    --}}{{--    --}}

{{--    <script>--}}

{{--        let chartData = @json($rentCollectedTrends);--}}


{{--        let salesOverview = {--}}
{{--            labels: chartData.map(item => item.date.slice(-2)),--}}
{{--            dataUnit: 'Kes',--}}
{{--            lineTension: 0.1,--}}
{{--            datasets: [{--}}
{{--                label: "Payment Collection",--}}
{{--                color: "#798bff",--}}
{{--                background: NioApp.hexRGB('#798bff', .3),--}}
{{--                data: chartData.map(item => item.aggregate)--}}
{{--            }]--}}
{{--        };--}}

{{--        document.addEventListener("DOMContentLoaded", function () {--}}
{{--            lineSalesOverview("#salesOverview", salesOverview);--}}
{{--        });--}}

{{--        function lineSalesOverview(selector, set_data) {--}}
{{--            let $selector = selector ? $(selector) : $('.sales-overview-chart');--}}
{{--            $selector.each(function () {--}}
{{--                let $self = $(this),--}}
{{--                    _self_id = $self.attr('id'),--}}
{{--                    _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data;--}}
{{--                let selectCanvas = document.getElementById(_self_id).getContext("2d");--}}
{{--                let chart_data = [];--}}
{{--                for (let i = 0; i < _get_data.datasets.length; i++) {--}}
{{--                    chart_data.push({--}}
{{--                        label: _get_data.datasets[i].label,--}}
{{--                        tension: _get_data.lineTension,--}}
{{--                        backgroundColor: _get_data.datasets[i].background,--}}
{{--                        fill: true,--}}
{{--                        borderWidth: 2,--}}
{{--                        borderColor: _get_data.datasets[i].color,--}}
{{--                        pointBorderColor: "transparent",--}}
{{--                        pointBackgroundColor: "transparent",--}}
{{--                        pointHoverBackgroundColor: "#fff",--}}
{{--                        pointHoverBorderColor: _get_data.datasets[i].color,--}}
{{--                        pointBorderWidth: 2,--}}
{{--                        pointHoverRadius: 3,--}}
{{--                        pointHoverBorderWidth: 2,--}}
{{--                        pointRadius: 3,--}}
{{--                        pointHitRadius: 3,--}}
{{--                        data: _get_data.datasets[i].data--}}
{{--                    });--}}
{{--                }--}}
{{--                let chart = new Chart(selectCanvas, {--}}
{{--                    type: 'line',--}}
{{--                    data: {--}}
{{--                        labels: _get_data.labels,--}}
{{--                        datasets: chart_data--}}
{{--                    },--}}
{{--                    options: {--}}
{{--                        plugins: {--}}
{{--                            legend: {--}}
{{--                                display: _get_data.legend ? _get_data.legend : false,--}}
{{--                                labels: {--}}
{{--                                    boxWidth: 30,--}}
{{--                                    padding: 20,--}}
{{--                                    color: '#6783b8'--}}
{{--                                }--}}
{{--                            },--}}
{{--                            tooltip: {--}}
{{--                                enabled: true,--}}
{{--                                rtl: NioApp.State.isRTL,--}}
{{--                                callbacks: {--}}
{{--                                    label: function label(context) {--}}
{{--                                        return "".concat(context.parsed.y, " ").concat(_get_data.dataUnit);--}}
{{--                                    }--}}
{{--                                },--}}
{{--                                backgroundColor: '#eff6ff',--}}
{{--                                titleFont: {--}}
{{--                                    size: 13--}}
{{--                                },--}}
{{--                                titleColor: '#6783b8',--}}
{{--                                titleMarginBottom: 6,--}}
{{--                                bodyColor: '#9eaecf',--}}
{{--                                bodyFont: {--}}
{{--                                    size: 12--}}
{{--                                },--}}
{{--                                bodySpacing: 4,--}}
{{--                                padding: 10,--}}
{{--                                footerMarginTop: 0,--}}
{{--                                displayColors: false--}}
{{--                            }--}}
{{--                        },--}}
{{--                        maintainAspectRatio: false,--}}
{{--                        scales: {--}}
{{--                            y: {--}}
{{--                                display: true,--}}
{{--                                stacked: _get_data.stacked ? _get_data.stacked : false,--}}
{{--                                position: NioApp.State.isRTL ? "right" : "left",--}}
{{--                                ticks: {--}}
{{--                                    beginAtZero: true,--}}
{{--                                    font: {--}}
{{--                                        size: 11--}}
{{--                                    },--}}
{{--                                    color: '#9eaecf',--}}
{{--                                    padding: 10,--}}
{{--                                    callback: function callback(value, index, values) {--}}
{{--                                        return 'Kes ' + value;--}}
{{--                                    },--}}
{{--                                    min: 100,--}}
{{--                                    stepSize: 3000--}}
{{--                                },--}}
{{--                                grid: {--}}
{{--                                    color: NioApp.hexRGB("#526484", .2),--}}
{{--                                    tickLength: 0,--}}
{{--                                    zeroLineColor: NioApp.hexRGB("#526484", .2),--}}
{{--                                    drawTicks: false--}}
{{--                                }--}}
{{--                            },--}}
{{--                            x: {--}}
{{--                                display: true,--}}
{{--                                stacked: _get_data.stacked ? _get_data.stacked : false,--}}
{{--                                ticks: {--}}
{{--                                    font: {--}}
{{--                                        size: 9--}}
{{--                                    },--}}
{{--                                    color: '#9eaecf',--}}
{{--                                    source: 'auto',--}}
{{--                                    padding: 10,--}}
{{--                                    reverse: NioApp.State.isRTL--}}
{{--                                },--}}
{{--                                grid: {--}}
{{--                                    color: "transparent",--}}
{{--                                    tickLength: 0,--}}
{{--                                    zeroLineColor: 'transparent',--}}
{{--                                    drawTicks: false--}}
{{--                                }--}}
{{--                            }--}}
{{--                        }--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--        }--}}


{{--    </script>--}}

{{--@endpush--}}
