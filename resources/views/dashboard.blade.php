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
            {{-- <div class="date-range mb-3">
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
            </div> --}}

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

            <!-- table -->
            <div class="d-flex justify-content-between pt-5">
                <span class="h4 fw-bold font-primary">Visitors Data on Table :</span>
                <span class="btn btn-blue"><img src="{{ asset('/') }}assets/icons/external-link.svg" alt="" onclick="exportVisitorsTableData()"> Export
                    table as
                    CSV</span>
            </div>
            <table class="table p-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Country</th>
                        <th scope="col">Device</th>
                        <th scope="col">Browser</th>
                        <th scope="col">OS</th>
                        <th scope="col">Traffic Source</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($visitors_table as $key=>$visitor)  
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$visitor->country}}</td>
                        <td>{{$visitor->device}}</td>
                        <td>{{$visitor->browser}}</td>
                        <td>{{$visitor->os}}</td>
                        <td>{{$visitor->traffic_source}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $visitors_table->links() }}
        </section><!-- #analitices-->


    </section> <!-- #dashboard-->
    <div class="p-4"></div>
@endsection
@section('template-script')
    <script>
        const visitorData = <?php echo $visitorsChartData;  ?>;
        const locationData = <?php echo $locationChartData;  ?>;
        const osData = <?php echo $osChartData;  ?>;

        let visitorLabels = visitorData.labels;
        let visitorValues = visitorData.values;
        // visitors chart
        var options = {
            chart: {
                type: 'line'
            },
            series: [{
                name: 'sales',
                data: visitorValues
            }],
            xaxis: {
                categories: visitorLabels
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


        let osLabels = osData.labels;
        let osValues = osData.values;
        // osChart

        var options = {
            series: osValues,
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
            labels: osLabels,
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
    <script src="https://cdn.tutorialjinni.com/jquery-csv/1.0.11/jquery.csv.min.js"></script>
    <script>
        
        function  exportVisitorsTableData(){
            // Create an array of objects
            const data = <?php echo $export_visitors_table_data; ?>;
            // Convert to csv
            const csv = $.csv.fromObjects(data);

            // Download file as csv function
            const downloadBlobAsFile = function(csv, filename){
                var downloadLink = document.createElement("a");
                var blob = new Blob([csv], { type: 'text/csv' });
                var url = URL.createObjectURL(blob);
                downloadLink.href = url;
                downloadLink.download = filename;
                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);
            }

            // Download csv file
            downloadBlobAsFile(csv, 'VisitorsTable.csv');
        }
    </script>
@endsection
