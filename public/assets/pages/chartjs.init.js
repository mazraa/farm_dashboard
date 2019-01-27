/*
 Template Name: MAZRAA - Responsive Bootstrap 4 Admin Dashboard
 Author: Themesbrand
 File: Chart js 
 */

!function($) {
    "use strict";

    var ChartJs = function() {};

    ChartJs.prototype.respChart = function(selector,type,data, options) {
        // get selector by context
        var ctx = selector.get(0).getContext("2d");
        // pointing parent container to make chart js inherit its width
        var container = $(selector).parent();

        // enable resizing matter
        $(window).resize( generateChart );

        // this function produce the responsive Chart JS
        function generateChart(){
            // make chart width fit with its container
            var ww = selector.attr('width', $(container).width() );
            switch(type){
                case 'Line':
                    new Chart(ctx, {type: 'line', data: data, options: options});
                    break;
                case 'Doughnut':
                    new Chart(ctx, {type: 'doughnut', data: data, options: options});
                    break;
                case 'Pie':
                    new Chart(ctx, {type: 'pie', data: data, options: options});
                    break;
                case 'Bar':
                    new Chart(ctx, {type: 'bar', data: data, options: options});
                    break;
                case 'Radar':
                    new Chart(ctx, {type: 'radar', data: data, options: options});
                    break;
                case 'PolarArea':
                    new Chart(ctx, {data: data, type: 'polarArea', options: options});
                    break;
            }
            // Initiate new chart or Redraw

        };
        // run function - render chart at first load
        generateChart();

    },
    //init
    ChartJs.prototype.init = function() {

        //Polar area  chart
        var polarChart = {
            datasets: [{
                data: [
                    // 11,
                    40,
                     7,
                    50
                ],
                backgroundColor: [
                    "#46cd93",
                    // "#1699dd",
                    "#fff",
                    "#040ed6",
                ],
                label: 'My dataset', // for legend
                hoverBorderColor: "#fff"
            }],
            labels: [
                "Light",
                // "Series 2",
                 "",
                ""
            ]
        };
        this.respChart($("#polarArea"),'PolarArea',polarChart);
        $(window).scroll(function (event) {
            var scroll = $(window).scrollTop();
            // console.log(scroll);
            if (scroll >= 1850 && scroll <= 2200) {
                // $.ChartJs.respChart($("#polarArea"),'PolarArea',polarChart);
            }
            // Do something
        });

    },
    $.ChartJs = new ChartJs, $.ChartJs.Constructor = ChartJs

}(window.jQuery),

//initializing
function($) {
    "use strict";
    $.ChartJs.init()
}(window.jQuery);
