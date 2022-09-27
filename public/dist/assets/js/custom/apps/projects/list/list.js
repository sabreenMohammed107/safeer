"use strict";

// Class definition
var KTProjectList = function () {    
    var initChart = function () {
        // init chart
        var element = document.getElementById("kt_project_list_chart");

        if (!element) {
            return;
        }

        var config = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [35, 65],
                    backgroundColor: ['#50CD89', '#E4E6EF']
                }],
                labels: ['Registered', 'Guests']
            },
            options: {
                chart: {
                    fontFamily: 'inherit'
                },
                cutout: '75%',
                cutoutPercentage: 65,
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: false
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                },
                tooltips: {
                    enabled: true,
                    intersect: false,
                    mode: 'nearest',
                    bodySpacing: 5,
                    yPadding: 10,
                    xPadding: 10,
                    caretPadding: 0,
                    displayColors: false,
                    backgroundColor: '#20D489',
                    titleFontColor: '#ffffff',
                    cornerRadius: 4,
                    footerSpacing: 0,
                    titleSpacing: 0
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }                
            }
        };

        var ctx = element.getContext('2d');
        var myDoughnut = new Chart(ctx, config);
    }

    // Public methods
    return {
        init: function () {
            initChart();
        }
    }
}();

var chart_pie_bundles = function () {    
    var initChart = function () {
        // init chart
        var element = document.getElementById("kt_project_pie_bundle");

        if (!element) {
            return;
        }

        var config = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [35, 40, 25],
                    backgroundColor: ['#50CD89', '#E4E6EF', '#aa0d0d']
                }],
                labels: ['1 Month', 'Quarter Year', 'Year']
            },
            options: {
                chart: {
                    fontFamily: 'inherit'
                },
                cutout: '75%',
                cutoutPercentage: 65,
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: false
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                },
                tooltips: {
                    enabled: true,
                    intersect: false,
                    mode: 'nearest',
                    bodySpacing: 5,
                    yPadding: 10,
                    xPadding: 10,
                    caretPadding: 0,
                    displayColors: false,
                    backgroundColor: '#20D489',
                    titleFontColor: '#ffffff',
                    cornerRadius: 4,
                    footerSpacing: 0,
                    titleSpacing: 0
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }                
            }
        };

        var ctx = element.getContext('2d');
        var myDoughnut = new Chart(ctx, config);
    }

    // Public methods
    return {
        init: function () {
            initChart();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTProjectList.init();
    chart_pie_bundles.init();
});
