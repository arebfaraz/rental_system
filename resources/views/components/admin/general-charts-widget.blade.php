<div class="col-xxl-6">
    <div class="row g-gs">
        <div class="col-lg-6 col-xxl-12">
            <div class="card card-bordered">
                <div class="card-inner">
                    <div class="card-title-group align-start mb-2">
                        <div class="card-title">
                            <h6 class="title">Expenses tracking</h6>
                            <p>In last one year expenses from subscription.</p>
                        </div>
                        <div class="card-tools">
                            <em class="card-hint icon ni ni-help-fill"
                                data-bs-toggle="tooltip" data-bs-placement="left"
                                title="Recorded expenses"></em>
                        </div>
                    </div>
                    <div
                        class="align-end gy-3 gx-5 flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
                        <div class="nk-sale-data-group flex-md-nowrap g-4">
                            <div class="nk-sale-data">
                                <span class="amount">
                                    {{ number_format($expensesThisMonth,2) }}
                                </span>
                                <span class="sub-title">This Month</span>
                            </div>
                            <div class="nk-sale-data">
                                <span class="amount">
                                    {{ number_format($expensesThisWeek,2) }}
                                </span>
                                <span class="sub-title">This Week</span>
                            </div>
                        </div>
                        <div class="nk-sales-ck sales-revenue">
                            <canvas class="sales-bar-chart" id="expensesTracking"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .col -->
        <div class="col-lg-6 col-xxl-12">
            <div class="row g-gs">
                <div class="col-sm-6 col-lg-12 col-xxl-6">
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <div class="card-title-group align-start mb-2">
                                <div class="card-title">
                                    <h6 class="title">User Registrations</h6>
                                </div>
                                <div class="card-tools">
                                    <em class="card-hint icon ni ni-help-fill"
                                        data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="User registrations"></em>
                                </div>
                            </div>
                            <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                <div class="nk-sale-data">
                                    <span class="amount">
                                        {{ $usersCount }}
                                    </span>
                                    <span class="sub-title">
                                                                    Over entire period
                                                                </span>
                                </div>
                                <div class="nk-sales-ck">
                                    <canvas class="sales-bar-chart"
                                            id="usersRegistrations"></canvas>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </div><!-- .col -->
                <div class="col-sm-6 col-lg-12 col-xxl-6">
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <div class="card-title-group align-start mb-2">
                                <div class="card-title">
                                    <h6 class="title">Lease Terminations</h6>
                                </div>
                                <div class="card-tools">
                                    <em class="card-hint icon ni ni-help-fill"
                                        data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="Lease Terminations"></em>
                                </div>
                            </div>
                            <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                <div class="nk-sale-data">
                                    <span class="amount">
                                        {{ $terminatedLeasesCount }}
                                    </span>
                                    <span class="sub-title">
                                                                    Over entire period.
                                                                </span>
                                </div>
                                <div class="nk-sales-ck">
                                    <canvas class="sales-bar-chart"
                                            id="totalSubscription"></canvas>
                                </div>
                            </div>
                        </div>
                    </div><!-- .card -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .col -->
    </div><!-- .row -->
</div><!-- .col -->

@push('scripts')
    <script>
        let expensesData = @json($expensesTrends);
        let usersData = @json($usersRegistrationTrends);
        let leasesData = @json($terminatedLeaseTrends);

        //define expenseLabels
        let expenseLabels = expensesData.map(item => {
            let date = new Date(item.date);
            return date.toLocaleString('default', {month: 'short'});
        });
        let expenseAggregates = expensesData.map(item => item.aggregate);

        let usersLabels = usersData.map(item => {
            let date = new Date(item.date);
            return date.toLocaleString('default', {month: 'short'});
        });
        let usersAggregates = usersData.map(item => item.aggregate);


        let leasesLabels = leasesData.map(item => {
            let date = new Date(item.date);
            return date.toLocaleString('default', {month: 'short'});
        });
        let leasesAggregates = leasesData.map(item => item.aggregate);


        /* Expenses chart details */
        let expensesTracking = {
            labels: expenseLabels,
            showLabels: true,
            dataUnit: 'Kes',
            stacked: true,
            datasets: [{
                label: "Expenses Revenue",
                color: [NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), "#6576ff"],
                //@v2.0
                data: expenseAggregates
            }]
        };
        /*New users chart details */
        let usersRegistrations = {
            labels: usersLabels,
            dataUnit: 'Users',
            stacked: true,
            datasets: [{
                label: "Active User",
                color: [NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), "#6576ff"],
                //@v2.0
                data: usersAggregates
            }]
        };

        /**?* Lease termination chart details */
        let totalSubscription = {
            labels: leasesLabels,
            dataUnit: 'USD',
            stacked: true,
            datasets: [{
                label: "Active User",
                color: [NioApp.hexRGB("#aea1ff", .2), NioApp.hexRGB("#aea1ff", .2), NioApp.hexRGB("#aea1ff", .2), NioApp.hexRGB("#aea1ff", .2), NioApp.hexRGB("#aea1ff", .2), "#aea1ff"],
                //@v2.0
                data: leasesAggregates
            }]
        };

        function salesBarChart(selector, set_data) {
            var $selector = selector ? $(selector) : $('.sales-bar-chart');
            $selector.each(function () {
                var $self = $(this),
                    _self_id = $self.attr('id'),
                    _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data,
                    _d_legend = typeof _get_data.legend === 'undefined' ? false : _get_data.legend;
                var selectCanvas = document.getElementById(_self_id).getContext("2d");
                var chart_data = [];
                for (var i = 0; i < _get_data.datasets.length; i++) {
                    chart_data.push({
                        label: _get_data.datasets[i].label,
                        data: _get_data.datasets[i].data,
                        // Styles
                        backgroundColor: _get_data.datasets[i].color,
                        borderWidth: 2,
                        borderColor: 'transparent',
                        hoverBorderColor: 'transparent',
                        borderSkipped: 'bottom',
                        barPercentage: .7,
                        categoryPercentage: .7
                    });
                }
                var chart = new Chart(selectCanvas, {
                        type: 'bar',
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
                                        title: function title() {
                                            return false;
                                        },
                                        label: function label(context) {
                                            return "".concat(context.parsed.y, " ").concat(_get_data.dataUnit);
                                        }
                                    },
                                    backgroundColor: '#eff6ff',
                                    titleFont: {
                                        size: 11
                                    },
                                    titleColor: '#6783b8',
                                    titleMarginBottom: 4,
                                    bodyColor: '#9eaecf',
                                    bodyFont: {
                                        size: 10
                                    },
                                    bodySpacing: 3,
                                    padding: 8,
                                    footerMarginTop: 0,
                                    displayColors: false
                                }
                            },
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    display: false,
                                    stacked: _get_data.stacked ? _get_data.stacked : false,
                                    ticks: {
                                        beginAtZero: true
                                    }
                                },
                                x: {
                                    display: true,
                                    stacked: _get_data.stacked ? _get_data.stacked : false,
                                    ticks: {
                                        reverse: NioApp.State.isRTL,
                                        color: '#9eaecf',
                                        font: {
                                            size: 10
                                        }
                                    },
                                    grid: {
                                        display: false
                                    },
                                    border: {
                                        display: false
                                    }
                                }
                            }
                        }
                    })
                ;
            });
        }

        document.addEventListener("DOMContentLoaded", function () {
            salesBarChart();
        })
    </script>
@endpush
