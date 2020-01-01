@extends('admin.layout')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">assignment_ind</i>
                </div>
                <p class="card-category">Attendance</p>
                <div class="h3 card-title">
                    <span id="attendance"></span>
                </div>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons text-danger">subdirectory_arrow_right</i>
                    <a href="{{ route('admin.attendence')}}">Check Attendence</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                    <i class="fas fa-coins"></i>
                </div>
                <p class="card-category">Revenue</p>
                <div class="h3 card-title">
                    <span id="revenue">0</span> <small>TK</small>
                </div>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons text-danger">subdirectory_arrow_right</i>
                    <a class="" href="{{ route('order.index')}}">goto Order</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">store</i>
                </div>
                <p class="card-category">Total Outlets</p>
                <h3 class="card-title"> <span id="outlet">0</span> </h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons text-danger">subdirectory_arrow_right</i>
                    <a class="" href="{{ route('outlet.index')}}">goto Outlet</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="fas fa-bookmark"></i>
                </div>
                <p class="card-category">Booking</p>
                <h3 class="card-title"><span id="booking">0</span></h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons text-danger">subdirectory_arrow_right</i>
                    <a class="" href="{{ route('booking.index')}}">Check Booking</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card card-chart">
            <div class="card-header card-header-success">
                <div class="ct-chart" id="weeklyRevenueChart"></div>
            </div>
            <div class="card-body">
                <h4 class="card-title">Last 7 days sales</h4>
                <p class="card-category">total</p>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">done</i> taken from database
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-chart">
            <div class="card-header card-header-danger">
                <div class="ct-chart" id="dailySaleOutletWise"></div>
            </div>
            <div class="card-body">
                <h4 class="card-title">Daily Sale</h4>
                <p class="card-category">Outlet Wise</p>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">done</i> taken from database
                </div>
            </div>
        </div>
    </div>


</div>

<script>
$(document).ready(function() {
    init();

    function init() {
        getAttendance();
        getRevenue();
        getOutletCount();
        getBookingCount();
        initDashboardPageCharts();
    }

    function getAttendance() {
        var id = 50;
        $.ajax({
            url: "/admin/ajax/getAttendence",
            method: "GET",
            dataType: "json",
            data: {
                query: id
            },

            success: function(result) {
                $('#attendance').html(result[1] + '/' + result[0]);
            }
        });
    }

    function getRevenue() {
        $.ajax({
            url: "/admin/ajax/getRevenue",
            method: "GET",
            dataType: "json",

            success: function(result) {
                //console.log(result)
                $('#revenue').html(result);
            }
        });
    }

    function getOutletCount() {
        $.ajax({
            url: "/admin/ajax/getOutletCount",
            method: "GET",
            dataType: "json",

            success: function(result) {
                //console.log(result)
                $('#outlet').html(result);
            }
        });
    }

    function getBookingCount() {
        $.ajax({
            url: "/admin/ajax/getBookingCount",
            method: "GET",
            dataType: "json",

            success: function(result) {
                //console.log(result)
                $('#booking').html(result);
            }
        });
    }

    function startAnimationForLineChart(chart) {

        chart.on('draw', function(data) {
            if (data.type === 'line' || data.type === 'area') {
                data.element.animate({
                    d: {
                        begin: 600,
                        dur: 700,
                        from: data.path.clone().scale(1, 0).translate(0, data.chartRect
                            .height()).stringify(),
                        to: data.path.clone().stringify(),
                        easing: Chartist.Svg.Easing.easeOutQuint
                    }
                });
            } else if (data.type === 'point') {
                seq++;
                data.element.animate({
                    opacity: {
                        begin: seq * delays,
                        dur: durations,
                        from: 0,
                        to: 1,
                        easing: 'ease'
                    }
                });
            }
        });

        seq = 0;
    }

    function startAnimationForBarChart(chart) {

        chart.on('draw', function(data) {
            if (data.type === 'bar') {
                seq2++;
                data.element.animate({
                    opacity: {
                        begin: seq2 * delays2,
                        dur: durations2,
                        from: 0,
                        to: 1,
                        easing: 'ease'
                    }
                });
            }
        });

        seq2 = 0;
    }



    function initDashboardPageCharts() {

        $.ajax({
            url: "/admin/ajax/getWeeklyTransaction",
            method: "GET",
            dataType: "json",

            success: function(result) {
                //console.log(result);

                drawWeeklyTransactionChart(result);
            }
        });

        $.ajax({
            url: "/admin/ajax/getDailyTransaction",
            method: "GET",
            dataType: "json",

            success: function(result) {
                //console.log(result);

                drawDailyTransaction(result);
            }
        });

    }

    function drawWeeklyTransactionChart(result) {

        var labelData = new Array();
        var seriesData = new Array();

        result.forEach(element => {
            labelData.push(element.day);
            seriesData.push(parseInt(element.total));
        });

        dataweeklyRevenueChart = {
            labels: labelData,
            series: [
                seriesData,
            ]
        };

        optionsweeklyRevenueChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
            }),
            low: 0,
            high: 3000, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            },
        }

        var weeklyRevenueChart = new Chartist.Line('#weeklyRevenueChart', dataweeklyRevenueChart,
            optionsweeklyRevenueChart);

        startAnimationForLineChart(weeklyRevenueChart);
    }


    function drawDailyTransaction(result) {

        var labelData = new Array();
        var seriesData = new Array();

        result.forEach(element => {
            var lbl = `Outlet ${element.outlet}`;
            labelData.push(lbl);
            seriesData.push(parseInt(element.total));
        });

        var datadailySaleOutletWise = {
            labels: labelData,
            series: [
                seriesData,

            ]
        };
        var optionsdailySaleOutletWise = {
            axisX: {
                showGrid: false
            },
            low: 0,
            high: 2000,
            chartPadding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            }
        };
        var responsiveOptions = [
            ['screen and (max-width: 640px)', {
                seriesBarDistance: 5,
                axisX: {
                    labelInterpolationFnc: function(value) {
                        return value[0];
                    }
                }
            }]
        ];
        var dailySaleOutletWise = Chartist.Bar('#dailySaleOutletWise', datadailySaleOutletWise,
            optionsdailySaleOutletWise, responsiveOptions);

        //start animation for the Emails Subscription Chart
        startAnimationForBarChart(dailySaleOutletWise);
    }

});
</script>
@endsection