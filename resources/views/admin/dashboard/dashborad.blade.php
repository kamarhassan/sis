@extends('admin.layouts.master')

@section('title')
    @lang('site.dashboard')
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                @include('admin.dashboard.dashboard-sub-blade.nb-student')
            </div>
            <div class="col-md-3">
                @include('admin.dashboard.dashboard-sub-blade.nb-cours')
            </div>
            <div class="col-md-3">
                @include('admin.dashboard.dashboard-sub-blade.nb-categories')
            </div>
            <div class="col-md-3">
                @include('admin.dashboard.dashboard-sub-blade.nb-services')
            </div>
        </div>
    </section>

    <section class="content ">
        {{--   this for charts    --}}
        @include('admin.dashboard.dashboard-sub-blade.charts-nb-students-by-month')
    </section>
@endsection


@section('script')
    <script src="{{ URL::asset('assets/assets/vendor_components/easypiechart/dist/jquery.easypiechart.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/apexcharts-bundle/irregular-data-series.js') }}"></script>
    <script src="{{ URL::asset('assets/assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') }}"></script>

    {{-- <script src="{{ URL::asset('assets/app-assets/js/pages/dashboard.js')}}"></script> --}}



    <script>
        var std_registration = [];

        std_registration.push({
            name: 'students count',
            data: {{ json_encode($count_std_registration_by_month) }}
        })

        setdatacharts_line(std_registration, 'students_registration', 'line', ['#0F5EF7']) // set students count by month


        var user_services = [];

        user_services.push({
            name: 'service count',
            data: {{ json_encode($count_services_paid_by_month) }}
        })


        setdatacharts_line(user_services, 'services_paid', 'line', ['#0F5EF7']) // set students count by month



        setdatacharts_bar('array_of_data', 'xmlns', 'text_hover_number', 'bar')


        function setdatacharts_line(array_of_data, chart_id, type, color_is_an_array) {


            var options = {
                series: array_of_data,
                chart: {
                    foreColor: "#bac0c7",
                    height: 385,
                    type: type,
                    zoom: {
                        enabled: false
                    }
                },
                colors: color_is_an_array,
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    show: true,
                    curve: 'smooth',
                    lineCap: 'butt',
                    colors: undefined,
                    width: 5,
                    dashArray: 0,
                },
                markers: {
                    size: 5,
                    colors: '#ffffff',
                    strokeColors: '#0F5EF7',
                    strokeWidth: 3,
                    strokeOpacity: 0.9,
                    strokeDashArray: 0,
                    fillOpacity: 1,
                    discrete: [],
                    shape: "circle",
                    radius: 5,
                    offsetX: 0,
                    offsetY: 0,
                    onClick: undefined,
                    onDblClick: undefined,
                    hover: {
                        size: undefined,
                        sizeOffset: 3
                    }
                },
                grid: {
                    borderColor: '#f7f7f7',
                    row: {
                        colors: ['transparent'], // takes an array which will be repeated on columns
                        opacity: 0
                    },
                    yaxis: {
                        lines: {
                            show: true,
                        },
                    },
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    labels: {
                        show: true,
                    },
                    axisBorder: {
                        show: true
                    },
                    axisTicks: {
                        show: true
                    },
                    tooltip: {
                        enabled: true,
                    },
                },
                yaxis: {
                    labels: {
                        show: true,
                        formatter: function(val) {
                            return val;
                        }
                    }

                },
            };
            var chart = new ApexCharts(document.querySelector("#" + chart_id), options);
            chart.render();

        }




        function setdatacharts_bar(array_of_data, chart_id, text_hover_number, type) {

            var options = {
                series: [{
                    name: 'Net Profit',
                    data: [44, 55, 57, 56, 61, 58, 63]
                }, {
                    name: 'Revenue',
                    data: [76, 85, 101, 98, 87, 105, 91]
                }],
                chart: {
                    type: 'bar',
                    foreColor: "#bac0c7",
                    height: 290,
                    toolbar: {
                        show: false,
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '30%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                grid: {
                    show: true,
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                colors: ['#EF3737', '#0F5EF7'],
                xaxis: {
                    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],

                },
                yaxis: {

                },
                legend: {
                    show: false,
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + text_hover_number
                        }
                    },
                    marker: {
                        show: false,
                    },
                }
            };

            var chart = new ApexCharts(document.querySelector("#" + chart_id), options);
            chart.render();

        }
    </script>
@endsection
