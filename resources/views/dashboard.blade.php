@extends('master')
@section('page-title', 'Dashboard - analitics')
@section('template-css')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endsection

@section('page-section')
    <!-- dashboard -->
    <section id="dashboard" class="pt-5 row">
        <div class="p-3"></div>

        <!-- analitics -->
        <section id="analitics" class="bg-white rounded shadow-sm p-3 row">

            <!-- filter -->
            <div class="filter-data p-3 d-flex justify-content-between">

                <!-- select link -->
                <div>
                    <form action="{{ url('dashboard') }}" method="GET">
                        <select name="link_id" class="form-control" onchange="this.form.submit()">
                            <option value="">All Links</option>
                            @foreach ($links as $link)
                                <option value="{{ $link->id }}"
                                    @if (isset($_GET['link_id'])) @if ($_GET['link_id'] == $link->id) selected @endif
                                    @endif
                                    >{{ $link->long_url }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>

                <!-- group-by -->
                <div>
                    <form action="{{ url('dashboard') }}" method="GET">
                        @if (isset($_GET['link_id']))
                            <input value="{{ $_GET['link_id'] }}" name="link_id" type="text" hidden>
                        @endif
                        <button class="btn btn-sm btn-outline-primary" name="group_by" onclick="this.form.submit()"
                            value="day">Daily</button>

                        <button class="btn btn-sm btn-outline-primary" name="group_by" onclick="this.form.submit()"
                            value="week">Weekly</button>

                        <button class="btn btn-sm btn-outline-primary" name="group_by" onclick="this.form.submit()"
                            value="month">Monthly</button>

                    </form>
                </div>
            </div>
            <hr>
            <!-- filter by date range -->
            <div class="date-range mb-3">
                <form action="{{ url('dashboard') }}" method="GET" class="d-flex justify-content-between">
                    @if (isset($_GET['link_id']))
                        <input value="{{ $_GET['link_id'] }}" name="link_id" type="text" hidden>
                    @endif

                    <span class="fw-bold">Filter by date range : </span>
                    <div class="start-date">
                        Start Date : <input type="date" name="start_date">
                    </div>

                    <div class="end-date">
                        End Date : <input type="date" name="end_date">
                    </div>

                    <button class="btn btn-sm btn-primary ml-3">Apply <img
                            src="{{ asset('/') }}assets/icons/chevrons-right.svg" alt=""></button>
                </form>
            </div>

            <!-- visitors chart -->
            <div class="col-lg-9">
                <div class="p-3" id="visitorChart"></div>
            </div>
            <div class="col-lg-3 text-center p-5">
                <div class="block bg-primary p-3 rounded text-white">
                    {{ $total_clicks }} <img src="{{ asset('/') }}assets/icons/bar.svg" alt="">
                    <hr>
                    Total Clicks
                </div>
                <div class="block bg-info p-3 mt-3 rounded text-white">
                    {{ count($links) }} <img src="{{ asset('/') }}assets/icons/eye.svg" alt="">
                    <hr>
                    <a href="{{ url('links') }}">Total Links</a>
                </div>
            </div>
            <!--visitors chart -->

            <!-- location & os chart -->
            <div class="row text-center">
                <div class="col-md-6 p-3">
                    <h4 class="font-primary fw-bold">Location : </h4>
                    <br>
                    <div class="text-center" id="locationChart"></div>
                </div>
                <div class="col-md-6 p-3">
                    <h4 class="font-primary fw-bold">Operating System : </h4>
                    <br>
                    <div id="osChart"></div>
                </div>
            </div> <!-- location & os chart-->

            <hr>
            <!-- traffic source -->
            <section id="traffic-source" class="p-3">
                <h4 class="font-primary fw-bold">Traffic Source : </h4>
                <br>

                <div class="traffic-item d-flex justify-content-between border-bottom border-primary">
                    <h6>facebook.com</h6>
                    <h6>248</h6>
                </div>
                <div class="traffic-item d-flex justify-content-between border-bottom border-primary">
                    <h6>google.com</h6>
                    <h6>248</h6>
                </div>
                <div class="traffic-item d-flex justify-content-between border-bottom border-primary">
                    <h6>Internal</h6>
                    <h6>248</h6>
                </div>
                <div class="traffic-item d-flex justify-content-between border-bottom border-primary">
                    <h6>Extranal</h6>
                    <h6>248</h6>
                </div>

            </section><!-- #traffic-source-->

            <!-- table -->
            <div class="d-flex justify-content-between pt-5">
                <span class="h4 fw-bold font-primary">Visitors Data on Table :</span>
                <span class="btn btn-blue"><img src="{{ asset('/') }}assets/icons/external-link.svg" alt=""> Export
                    table as
                    CSV</span>
            </div>
            <table class="table p-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
        </section><!-- #analitices-->


    </section> <!-- #dashboard-->
    <div class="p-4"></div>
@endsection
@section('template-script')
    <script>
        const locationData = <?php echo $locationChartData;  ?>;
        console.log(locationData.labels);
        // visitors chart
        var options = {
            chart: {
                type: 'line'
            },
            series: [{
                name: 'sales',
                data: [30, 40, 70, 120, 49, 60, 70, 91, 125, 123, 140]
            }],
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Nov', 'Dec']
            }
        }

        var chart = new ApexCharts(document.querySelector("#visitorChart"), options);

        chart.render();

        let locationLabels = locationData.labels;
        let locationValues = locationData.values;
        // locationChart 
        var options = {
            series: locationValues,
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: locationLabels,
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#locationChart"), options);
        chart.render();


        // osChart

        var options = {
            series: [76, 67, 61, 90],
            chart: {
                height: 390,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    offsetY: 0,
                    startAngle: 0,
                    endAngle: 270,
                    hollow: {
                        margin: 5,
                        size: '30%',
                        background: 'transparent',
                        image: undefined,
                    },
                    dataLabels: {
                        name: {
                            show: false,
                        },
                        value: {
                            show: false,
                        }
                    }
                }
            },
            colors: ['#1ab7ea', '#0084ff', '#39539E', '#0077B5'],
            labels: ['Vimeo', 'Messenger', 'Facebook', 'LinkedIn'],
            legend: {
                show: true,
                floating: true,
                fontSize: '16px',
                position: 'left',
                offsetX: 160,
                offsetY: 15,
                labels: {
                    useSeriesColors: true,
                },
                markers: {
                    size: 0
                },
                formatter: function(seriesName, opts) {
                    return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
                },
                itemMargin: {
                    vertical: 3
                }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        show: false
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#osChart"), options);
        chart.render();
    </script>
@endsection
