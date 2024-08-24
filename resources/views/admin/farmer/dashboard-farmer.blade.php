@extends('admin.layouts.app')

@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center justify-content-between mb-2">
        <div>
            <div class="h4 fw-500">Dashboard {{ $farmer->nama_farmer }}</div>
        </div>
        <div>
            <a href="{{ route('farmer.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

    <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card border shadow-none radius-10 flex-grow-1 mb-3">
                            <div class="card-body">
                                <div class="">
                                    <h3 class="mb-2" id="dissolved_oxygen-text">{{ $dataRealtime['dissolved_oxygen'] }} Mg/L</h3>
                                </div>
                                <div id="chart-farmer-dissolved_oxygen"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border shadow-none radius-10 flex-grow-1 mb-3">
                            <div class="card-body">
                                <div class="">
                                    <h3 class="mb-2" id="nitrite-text">{{ $dataRealtime['nitrite'] }} Mg/L</h3>
                                </div>
                                <div id="chart-farmer-nitrite"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border shadow-none radius-10 flex-grow-1 mb-3">
                            <div class="card-body">
                                <div class="">
                                    <h3 class="mb-2" id="ph-text">{{ $dataRealtime['ph'] }}</h3>
                                </div>
                                <div id="chart-farmer-ph"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card border shadow-none radius-10 flex-grow-1 mb-3">
                            <div class="card-body">
                                <div class="">
                                    <h3 class="mb-2" id="salinity-text">{{ $dataRealtime['salinity'] }} PSU</h3>
                                </div>
                                <div id="chart-farmer-salinity"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card border shadow-none radius-10 flex-grow-1 mb-3">
                            <div class="card-body">
                                <div class="">
                                    <h3 class="mb-2" id="temperature-text">{{ $dataRealtime['temperature'] }} °C</h3>
                                </div>
                                <div id="chart-farmer-temperature"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card border shadow-none radius-10 flex-grow-1 mb-3">
                            <div class="card-body">
                                <div class="">
                                    <h3 class="mb-2" id="total_ammonia_nitrogen-text">{{ $dataRealtime['total_ammonia_nitrogen'] }} Mg/L</h3>
                                </div>
                                <div id="chart-farmer-total_ammonia_nitrogen"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card border shadow-none radius-10 flex-grow-1 mb-3">
                            <div class="card-body">
                                <div class="">
                                    <h3 class="mb-2" id="unionized_ammonia-text">{{ $dataRealtime['unionized_ammonia'] }} Mg/L</h3>
                                </div>
                                <div id="chart-farmer-unionized_ammonia"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection


@section('js-content')
    <script>
        $(document).ready(function() {
            $('#select_month').on('change', function(e) {
                window.location.href = "{{ route('dashboard.index') }}?month=" + e.target.value;
            });

            var result = JSON.parse('{!! $result !!}');

            chartHistory('chart-farmer-dissolved_oxygen', 'Dissolved Oxygen', result.datetime, result.dissolved_oxygen)
            chartHistory('chart-farmer-nitrite', 'Nitrite', result.datetime, result.nitrite)
            chartHistory('chart-farmer-ph', 'PH', result.datetime, result.ph)
            chartHistory('chart-farmer-salinity', 'Salinity', result.datetime, result.salinity)
            chartHistory('chart-farmer-temperature', 'Temperature', result.datetime, result.temperature)
            chartHistory('chart-farmer-total_ammonia_nitrogen', 'Total Ammonia Nitrogen', result.datetime, result.total_ammonia_nitrogen)
            chartHistory('chart-farmer-unionized_ammonia', 'Unionized Ammonia', result.datetime, result.unionized_ammonia)
        });

        function chartHistory(elementId, title, datetime, elementData) {
            

            // chart 3
            var options = {
                series: [{
                    name: title,
                    data: elementData
                }],
                chart: {
                    foreColor: '#9ba7b2',
                    height: 360,
                    type: 'area',
                    zoom: {
                        enabled: false
                    },
                    toolbar: {
                        show: true
                    },
                },
                colors: ["#923eb9", '#18bb6b'],
                title: {
                    text: title,
                    align: 'left',
                    style: {
                        fontSize: "16px",
                        color: '#666'
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    type: 'datetime',
                    categories: datetime
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                },
            };
            var chart = new ApexCharts(document.querySelector("#"+elementId), options);
            chart.render();
        }

    </script>
@endsection
