<div class="col-xxl-6">
    <div class="card card-bordered h-100">
        <div class="card-inner">
            <div class="card-title-group align-start gx-3 mb-3">
                <div class="card-title">
                    <h6 class="title">Rent Collections</h6>
                    <p>In 30 days of the last month. <a
                            href="{{ route('admin.payments.list') }}">See Details</a>
                    </p>
                </div>
                <div class="card-tools">

                </div>
            </div>
            <div class="nk-sale-data-group align-center justify-between gy-3 gx-5">
                <div class="nk-sale-data">
                    <span class="amount">
                       {{ setting('currency_symbol') }} {{ number_format($sum,2) }}
                    </span>
                </div>
                <div class="nk-sale-data">
                    <span class="amount sm">{{ $count }} <small>Individual payments</small></span>
                </div>
            </div>
            <div class="nk-sales-ck large pt-4">
                <canvas class="sales-overview-chart" id="salesOverview"></canvas>
            </div>
        </div>
    </div><!-- .card -->
</div><!-- .col -->
@push('scripts')
    {{--    <script src="{{ asset('assets/js/charts.js')}}"></script>--}}

    <script>

        let chartData = @json($rentCollectedTrends);

        let salesOverview = {
            labels: chartData.map(item => item.date.slice(-2)),
            dataUnit: 'Kes',
            lineTension: 0.1,
            datasets: [{
                label: "Payment Collection",
                color: "#798bff",
                background: NioApp.hexRGB('#798bff', .3),
                data: chartData.map(item => item.aggregate)
            }]
        };

        document.addEventListener("DOMContentLoaded", function () {
            lineSalesOverview("#salesOverview", salesOverview);
        });

        function lineSalesOverview(selector, set_data) {
            let $selector = selector ? $(selector) : $('.sales-overview-chart');
            $selector.each(function () {
                let $self = $(this),
                    _self_id = $self.attr('id'),
                    _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data;
                let selectCanvas = document.getElementById(_self_id).getContext("2d");
                let chart_data = [];
                for (let i = 0; i < _get_data.datasets.length; i++) {
                    chart_data.push({
                        label: _get_data.datasets[i].label,
                        tension: _get_data.lineTension,
                        backgroundColor: _get_data.datasets[i].background,
                        fill: true,
                        borderWidth: 2,
                        borderColor: _get_data.datasets[i].color,
                        pointBorderColor: "transparent",
                        pointBackgroundColor: "transparent",
                        pointHoverBackgroundColor: "#fff",
                        pointHoverBorderColor: _get_data.datasets[i].color,
                        pointBorderWidth: 2,
                        pointHoverRadius: 3,
                        pointHoverBorderWidth: 2,
                        pointRadius: 3,
                        pointHitRadius: 3,
                        data: _get_data.datasets[i].data
                    });
                }
                let chart = new Chart(selectCanvas, {
                    type: 'line',
                    data: {
                        labels: _get_data.labels,
                        datasets: chart_data
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: _get_data.legend ? _get_data.legend : false,
                                labels: {
                                    boxWidth: 30,
                                    padding: 20,
                                    color: '#6783b8'
                                }
                            },
                            tooltip: {
                                enabled: true,
                                rtl: NioApp.State.isRTL,
                                callbacks: {
                                    label: function label(context) {
                                        return "".concat(context.parsed.y, " ").concat(_get_data.dataUnit);
                                    }
                                },
                                backgroundColor: '#eff6ff',
                                titleFont: {
                                    size: 13
                                },
                                titleColor: '#6783b8',
                                titleMarginBottom: 6,
                                bodyColor: '#9eaecf',
                                bodyFont: {
                                    size: 12
                                },
                                bodySpacing: 4,
                                padding: 10,
                                footerMarginTop: 0,
                                displayColors: false
                            }
                        },
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                display: true,
                                stacked: _get_data.stacked ? _get_data.stacked : false,
                                position: NioApp.State.isRTL ? "right" : "left",
                                ticks: {
                                    beginAtZero: true,
                                    font: {
                                        size: 11
                                    },
                                    color: '#9eaecf',
                                    padding: 10,
                                    callback: function callback(value, index, values) {
                                        return 'Kes ' + value;
                                    },
                                    min: 100,
                                    stepSize: 3000
                                },
                                grid: {
                                    color: NioApp.hexRGB("#526484", .2),
                                    tickLength: 0,
                                    zeroLineColor: NioApp.hexRGB("#526484", .2),
                                    drawTicks: false
                                }
                            },
                            x: {
                                display: true,
                                stacked: _get_data.stacked ? _get_data.stacked : false,
                                ticks: {
                                    font: {
                                        size: 9
                                    },
                                    color: '#9eaecf',
                                    source: 'auto',
                                    padding: 10,
                                    reverse: NioApp.State.isRTL
                                },
                                grid: {
                                    color: "transparent",
                                    tickLength: 0,
                                    zeroLineColor: 'transparent',
                                    drawTicks: false
                                }
                            }
                        }
                    }
                });
            });
        }

    </script>

@endpush
