@extends('admin.master.master',["sidebarLink"=>["main"=>'',"active"=>'dashboard']])
@section('title')
    Dashboard
@endsection
@section('page-head')

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['preccesing', {{ $sales['processing'] }}],
                ['dispatched', {{ $sales['disptached'] }}],
                ['delivered', {{ $sales['delivered'] }}]
            ]);

            var options = {
                title: 'Sales Report'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
    // <script type="text/javascript">
    //     google.charts.load('current', {
    //         'packages': ['corechart']
    //     });
    //     google.charts.setOnLoadCallback(drawChart);

    //     function drawChart() {

    //         var data = google.visualization.arrayToDataTable([
    //             ['Task', 'Hours per Day'],
    //             <?php echo $coupon; ?>
    //         ]);

    //         var options = {
    //             title: 'Coupons Report'
    //         };

    //         var chart = new google.visualization.PieChart(document.getElementById('couponChart'));

    //         chart.draw(data, options);
    //     }
    // </script>

    <script type="text/javascript">
    google.charts.load('current', {
        'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawStuff);
    function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
            ['Used Coupons', 'Coupons'],
            <?php echo $coupon; ?>
        ]);
        var options = {
            width: 500,
            bars: 'vertical', // Required for Material Bar Charts.
            series: {
                0: {
                    axis: 'distance'
                }, // Bind series 0 to an axis named 'distance'.
                1: {
                    axis: 'brightness'
                } // Bind series 1 to an axis named 'brightness'.
            },
            axes: {
                x: {
                    distance: {
                        label: 'Coupons'
                    }, // Bottom x-axis.
                    brightness: {
                        side: 'top',
                        label: 'apparent magnitude'
                    } // Top x-axis.
                }
            }
        };
        var chart = new google.charts.Bar(document.getElementById('couponChart'));
        chart.draw(data, options);
    };
</script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['admin', {{ $users['admin'] }}],
                ['customer', {{ $users['customer'] }}],
            ]);

            var options = {
                title: 'User Report'
            };

            var chart = new google.visualization.PieChart(document.getElementById('userChart'));

            chart.draw(data, options);
        }
    </script>


@endsection
@section('page-content-heading')
    <span class="text-secondary">Dashboard</span>
@endsection
@section('page-content-breadcrumb')

    <li class="breadcrumb-item active">Home </li>
@endsection
@section('page-content')
    <div class="container">
        <div class="row">
            <div class="col-12 card p-0">
                <div class="card-header">
                    <h4>Reports</h4>
                </div>
                <div class="card-body">
                    <div class="row p-2 m-2 bg-light">
                        <div class="row p-2">
                            <h4 class="text-secondary">Sales Report</h4>
                            <form action="{{ route('sales-report') }}" style="display:inline-block" method="post">
                                @csrf
                                <button class="btn btn-lg btn-info" style="float: right">Download Sales Reports
                                    Excel</button>
                            </form>
                        </div>
                        <div class="col-12">
                            <div id="piechart" style="width: 900px; height: 500px;"></div>
                        </div>
                    </div>
                    <div class="row p-2 m-2 bg-light">
                        <div class="col-12">
                            <div class="row">
                                <h2 class="text-secondary">Coupon Report</h2>
                                <form action="{{ route('used-coupon-report') }}" method="post">
                                    @csrf
                                    <button class="btn btn-lg btn-primary" style="float: right">Download Coupon used
                                        Reports Excel</button>
                                </form>

                            </div>
                        </div>
                        <div class="col-12">
                            <div id="couponChart" style="width: 900px; height: 500px;"></div>
                        </div>
                    </div>
                    <div class="row p-2 m-2 bg-light">
                        <div class="col-12">
                            <h2 class="text-secondary">User reports</h2>
                            <form action="{{ route('customer-report') }}" method="post">
                                @csrf
                                <button class="btn btn-lg btn-success" style="float: right">Download User Registered Reports Excel</button>
                            </form>
                        </div>
                        <div class="col-12">
                            <div id="userChart" style="width: 900px; height: 500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
