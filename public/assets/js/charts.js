"use strict";

!function (NioApp, $) {
    "use strict";


    //////// for developer - User Balance ////////
    // Avilable options to pass from outside
    // labels: array,
    // legend: false - boolean,
    // dataUnit: string, (Used in tooltip or other section for display)
    // datasets: [{label : string, color: string (color code with # or other format), data: array}]

    /* Expenses chart details */
    let salesRevenue = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        showLabel: true,
        dataUnit: 'Kes',
        stacked: true,
        datasets: [{
            label: "Sales Revenue",
            color: [NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), "#6576ff"],
            //@v2.0
            data: [11000, 8000, 12500, 5500, 9500, 14299, 11000, 8000, 12500, 5500, 9500, 14299]
        }]
    };
    /*New users chart details */
    let activeSubscription = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
        dataUnit: 'Users',
        stacked: true,
        datasets: [{
            label: "Active User",
            color: [NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), "#6576ff"],
            //@v2.0
            data: [4400, 7800, 9500, 5500, 9200, 9690]
        }]
    };

    /**?* Lease termination chart details */
    let totalSubscription = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
        dataUnit: 'USD',
        stacked: true,
        datasets: [{
            label: "Active User",
            color: [NioApp.hexRGB("#aea1ff", .2), NioApp.hexRGB("#aea1ff", .2), NioApp.hexRGB("#aea1ff", .2), NioApp.hexRGB("#aea1ff", .2), NioApp.hexRGB("#aea1ff", .2), "#aea1ff"],
            //@v2.0
            data: [8200, 7800, 9500, 5500, 9200, 9690]
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
                            display: false,
                            stacked: _get_data.stacked ? _get_data.stacked : false,
                            ticks: {
                                reverse: NioApp.State.isRTL
                            }
                        }
                    }
                }
            });
        });
    }


    // init chart
    NioApp.coms.docReady.push(function () {
        salesBarChart();
    });

    // //Payments collection chart details
    // let salesOverview = {
    //     labels: ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30"],//day labels
    //     dataUnit: 'Kes',
    //     lineTension: 0.1,
    //     datasets: [{
    //         label: "Payment Collection",
    //         color: "#798bff",
    //         background: NioApp.hexRGB('#798bff', .3),
    //         data: [8200, 7800, 9500, 5500, 9200, 9690, 8200, 7800, 9500, 5500, 9200, 9690, 8200, 7800, 9500, 5500, 9200, 9690, 8200, 7800, 9500, 5500, 9200, 9690, 8200, 7800, 9500, 5500, 9200, 9690]//aggregate labels
    //     }]
    // };
    //
    // function lineSalesOverview(selector, set_data) {
    //     let $selector = selector ? $(selector) : $('.sales-overview-chart');
    //     $selector.each(function () {
    //         let $self = $(this),
    //             _self_id = $self.attr('id'),
    //             _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data;
    //         let selectCanvas = document.getElementById(_self_id).getContext("2d");
    //         let chart_data = [];
    //         for (let i = 0; i < _get_data.datasets.length; i++) {
    //             chart_data.push({
    //                 label: _get_data.datasets[i].label,
    //                 tension: _get_data.lineTension,
    //                 backgroundColor: _get_data.datasets[i].background,
    //                 fill: true,
    //                 borderWidth: 2,
    //                 borderColor: _get_data.datasets[i].color,
    //                 pointBorderColor: "transparent",
    //                 pointBackgroundColor: "transparent",
    //                 pointHoverBackgroundColor: "#fff",
    //                 pointHoverBorderColor: _get_data.datasets[i].color,
    //                 pointBorderWidth: 2,
    //                 pointHoverRadius: 3,
    //                 pointHoverBorderWidth: 2,
    //                 pointRadius: 3,
    //                 pointHitRadius: 3,
    //                 data: _get_data.datasets[i].data
    //             });
    //         }
    //         let chart = new Chart(selectCanvas, {
    //             type: 'line',
    //             data: {
    //                 labels: _get_data.labels,
    //                 datasets: chart_data
    //             },
    //             options: {
    //                 plugins: {
    //                     legend: {
    //                         display: _get_data.legend ? _get_data.legend : false,
    //                         labels: {
    //                             boxWidth: 30,
    //                             padding: 20,
    //                             color: '#6783b8'
    //                         }
    //                     },
    //                     tooltip: {
    //                         enabled: true,
    //                         rtl: NioApp.State.isRTL,
    //                         callbacks: {
    //                             label: function label(context) {
    //                                 return "".concat(context.parsed.y, " ").concat(_get_data.dataUnit);
    //                             }
    //                         },
    //                         backgroundColor: '#eff6ff',
    //                         titleFont: {
    //                             size: 13
    //                         },
    //                         titleColor: '#6783b8',
    //                         titleMarginBottom: 6,
    //                         bodyColor: '#9eaecf',
    //                         bodyFont: {
    //                             size: 12
    //                         },
    //                         bodySpacing: 4,
    //                         padding: 10,
    //                         footerMarginTop: 0,
    //                         displayColors: false
    //                     }
    //                 },
    //                 maintainAspectRatio: false,
    //                 scales: {
    //                     y: {
    //                         display: true,
    //                         stacked: _get_data.stacked ? _get_data.stacked : false,
    //                         position: NioApp.State.isRTL ? "right" : "left",
    //                         ticks: {
    //                             beginAtZero: true,
    //                             font: {
    //                                 size: 11
    //                             },
    //                             color: '#9eaecf',
    //                             padding: 10,
    //                             callback: function callback(value, index, values) {
    //                                 return 'Kes ' + value;
    //                             },
    //                             min: 100,
    //                             stepSize: 3000
    //                         },
    //                         grid: {
    //                             color: NioApp.hexRGB("#526484", .2),
    //                             tickLength: 0,
    //                             zeroLineColor: NioApp.hexRGB("#526484", .2),
    //                             drawTicks: false
    //                         }
    //                     },
    //                     x: {
    //                         display: true,
    //                         stacked: _get_data.stacked ? _get_data.stacked : false,
    //                         ticks: {
    //                             font: {
    //                                 size: 9
    //                             },
    //                             color: '#9eaecf',
    //                             source: 'auto',
    //                             padding: 10,
    //                             reverse: NioApp.State.isRTL
    //                         },
    //                         grid: {
    //                             color: "transparent",
    //                             tickLength: 0,
    //                             zeroLineColor: 'transparent',
    //                             drawTicks: false
    //                         }
    //                     }
    //                 }
    //             }
    //         });
    //     });
    // }
    //
    // // init chart
    // NioApp.coms.docReady.push(function () {
    //     lineSalesOverview();
    // });

}(NioApp, jQuery);
