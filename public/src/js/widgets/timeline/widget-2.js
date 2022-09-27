"use strict";

// Class definition
var KTTimelineWidget2 = function () {
    // Private methods
    var initChart = function(tabSelector, chartSelector, data, initByDefault) {
        var element = document.querySelector(chartSelector);        

        if (!element) {
            return;
        }  
          
        var height = parseInt(KTUtil.css(element, 'height'));
        
        var options = {
            series: data,                 
            chart: {            
                type: 'donut',
                width: 200,
            },
            colors: [KTUtil.getCssVariableValue('--bs-info'), 
                KTUtil.getCssVariableValue('--bs-success'), 
                KTUtil.getCssVariableValue('--bs-primary'), 
                KTUtil.getCssVariableValue('--bs-danger') 
            ],           
            dataLabels: {
                style: {       
                    fontSize: '10px'                
                }
            },         
            stroke: {
              width: 0
            },
            labels: ['Sales', 'Sales', 'Sales', 'Sales'],
            legend: {
                show: false,
            },
            fill: {
                type: 'false',          
            }     
        };                     

        var chart = new ApexCharts(element, options);

        var init = false;
        var tab = document.querySelector(tabSelector);
        
        if (initByDefault === true) {
            chart.render();
            init = true;
        }        

        tab.addEventListener('shown.bs.tab', function (event) {
            if (init == false) {
                chart.render();
                init = true;
            }
        })
    }

    // Public methods
    return {
        init: function () {           
            initChart('#kt_timeline_widget_2_tab_1', '#kt_timeline_widget_2_chart_1', [10.6, 100, 6.8, 2], true);
            initChart('#kt_timeline_widget_2_tab_2', '#kt_timeline_widget_2_chart_2', [70, 13, 11, 2], false);              
        }   
    }
}();

// Webpack support
if (typeof module !== 'undefined') {
    module.exports = KTTimelineWidget2;
}

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTTimelineWidget2.init();
});


 