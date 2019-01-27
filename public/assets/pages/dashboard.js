/*
 Template Name: MAZRAA - Responsive Bootstrap 4 Admin Dashboard
 File: Dashboard js
 */

!function ($) {
    "use strict";

    var Dashboard = function () {
    };
        var colorchange = '';
        //creates Stacked chart
        Dashboard.prototype.createStackedChart  = function(element, data, xkey, ykeys, labels, lineColors) {
            Morris.Bar({
                element: element,
                data: data,
                xkey: xkey,
                ykeys: ykeys,
                stacked: true,
                // ymax: 100,
                // ymin: 0,
                labels: labels,
                hideHover: 'auto',
                gridLineColor: '#eeeeee',
                xLabelMargin: 20,
                barColors: function(row,series,type){
                                if(colorchange=='barcolor'){
                                    colorchange = '';
                                    return "#1699dd";
                                } 
                                else {
                                    colorchange = 'barcolor';
                                    return "#ebeff2";
                                }
                            },
                 hoverCallback: function (index, options, content, row) {
                    return "<div class='morris-hover-row-label'>"+row.y+"</div><div class='morris-hover-point' style='color: #1699dd'>"+
                              row.a+"&#176;C"+
                            "</div>";
                },
                
            });
        },

        //creates Donut chart
        Dashboard.prototype.createDonutChart = function (element, data, colors) {
            Morris.Donut({
                element: element,
                data: data,
                resize: true,
                colors: colors,
            });
        },

        // pie
        $('.peity-pie').each(function () {
            $(this).peity("pie", $(this).data());
        });

        //donut
        $('.peity-donut').each(function () {
            $(this).peity("donut", $(this).data());
        });

        // line
        $('.peity-line').each(function () {
            $(this).peity("line", $(this).data());
        });


        Dashboard.prototype.init = function () {

            //creating Stacked chart
            // var $stckedData  = [
            //     { y: '1H', a: 45 },
            //     { y: '2H', a: 75 },
            //     { y: '3H', a: 100 },
            //     { y: '4H', a: 75 },
            //     { y: '5H', a: 100 },
            //     { y: '6H', a: 75 },
            //     { y: '7H', a: 50 },
            //     { y: '8H', a: 75 },
            //     { y: '9H', a: 50 },
            //     { y: '10H', a: 75 },
            //     { y: '11H', a: 100 },
            //     { y: '12H', a: 80 },
            //     { y: '13H', a: 70 },
            //     { y: '14H', a: 40 },
            //     { y: '15H', a: 100 },
            //     { y: '16H', a: 60 },
            //     { y: '17H', a: 45 },
            //     { y: '18H', a: 75 },
            //     { y: '19H', a: 50 },
            //     { y: '20H', a: 70 },
            //     { y: '21H', a: 20 },
            //     { y: '22H', a: 60 },
            //     { y: '23H', a: 55 },
            //     { y: '24H', a: 80 }
            // ];
            // this.createStackedChart('morris-bar-stacked', $stckedData, 'y', ['a'], ['&#176;C'], ['#1699dd','#ebeff2']);
            //creating donut chart
            // var $donutData = [
            //     // {label: "Marketing", value: 12},
            //     {label: "Online", value: $('.online_node_count').text()},
            //     {label: "Offline", value: $('.offile_node_count').text()}
            // ];
            // this.createDonutChart('morris-donut-example', $donutData, ['#040ed6', '#1699dd']);
        },
        //init
        $.Dashboard = new Dashboard, $.Dashboard.Constructor = Dashboard
}(window.jQuery),

//initializing
function ($) {
    "use strict";
    $.Dashboard.init();
}(window.jQuery);

// Knob js
$(function() {
    nodes();
    temperatue();
    network();
    // $(".knob").knob();
    // Array of day names
    var dayNames = new Array("Sunday","Monday","Tuesday","Wednesday",
                    "Thursday","Friday","Saturday");
    // Array of month Names
    var monthNames = new Array(
    "January","February","March","April","May","June","July",
    "August","September","October","November","December");

    var now = new Date();
    $('#current-date').html('Today is '+ monthNames[now.getMonth()] + " " +  now.getDate() + ", " + now.getFullYear());
});
function startTime() {
    var today=new Date();
    var h=today.getHours();
            var am_pm = today.getHours() >= 12 ? "PM" : "AM";
    var m=today.getMinutes();
    var s=today.getSeconds();
    // add a zero in front of numbers<10
    m=checkTime(m);
    s=checkTime(s);
    document.getElementById('realtime').innerHTML=h+" : "+m+" : "+s + " " + am_pm;;
    t=setTimeout('startTime()',500);
}

function checkTime(i) {
    if (i<10)
    {
    i="0" + i;
    }
    return i;
}
