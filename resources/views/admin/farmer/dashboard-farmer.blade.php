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
                                <div class="d-flex align-items-start gap-2">
                                    <div>
                                        <h5 class="mb-0 ">DO</h5>
                                    </div>
                                    <div class="ms-auto widget-icon-2 text-white rounded-circle"
                                        style="background-color: #C40C0C">
                                        <ion-icon name="analytics-outline"></ion-icon>
                                    </div>
                                </div>
                                <div class="">
                                    <h3 class="mb-2" id="do-text">5.87 Mg/L</h3>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="widget-icon-small bg-light-danger text-danger">
                                            <ion-icon name="arrow-down-outline"></ion-icon>
                                        </div>
                                    </div>
                                </div>
                                <div id="chart-farmer-do"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border shadow-none radius-10 flex-grow-1 mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-start gap-2">
                                    <div>
                                        <h5 class="mb-0">TDS</h5>
                                    </div>
                                    <div class="ms-auto widget-icon-2 text-white rounded-circle"
                                        style="background-color: #FF6500">
                                        <ion-icon name="analytics-outline"></ion-icon>
                                    </div>
                                </div>
                                <div class="">
                                    <h3 class="mb-2" id="tds-text">68,542</h3>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="widget-icon-small bg-light-danger text-danger">
                                            <ion-icon name="arrow-down-outline"></ion-icon>
                                        </div>
                                    </div>
                                </div>
                                <div id="chart-farmer-tds"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border shadow-none radius-10 flex-grow-1 mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-start gap-2">
                                    <div>
                                        <h5 class="mb-0 ">Amonia</h5>
                                    </div>
                                    <div class="ms-auto widget-icon-2 text-white rounded-circle" style="background-color: #FF8A08">
                                        <ion-icon name="analytics-outline"></ion-icon>
                                    </div>
                                </div>
                                <div class="">
                                    <h3 class="mb-2" id="amonia-text">68,542</h3>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="widget-icon-small bg-light-danger text-danger">
                                            <ion-icon name="arrow-down-outline"></ion-icon>
                                        </div>
                                    </div>
                                </div>
                                <div id="chart-farmer-amonia"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border shadow-none radius-10 flex-grow-1 mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-start gap-2">
                                    <div>
                                        <h5 class="mb-0 ">Suhu</h5>
                                    </div>
                                    <div class="ms-auto widget-icon-2 text-white rounded-circle" style="background-color: #FFC100;">
                                        <ion-icon name="analytics-outline"></ion-icon>
                                    </div>
                                </div>
                                <div class="">
                                    <h3 class="mb-2" id="suhu-text">68,542</h3>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="widget-icon-small bg-light-danger text-danger">
                                            <ion-icon name="arrow-down-outline"></ion-icon>
                                        </div>
                                    </div>
                                </div>
                                <div id="chart-farmer-suhu"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border shadow-none radius-10 flex-grow-1 mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-start gap-2">
                                    <div>
                                        <h5 class="mb-0 ">Salinitas</h5>
                                    </div>
                                    <div class="ms-auto widget-icon-2 text-white rounded-circle" style="background-color: #973131">
                                        <ion-icon name="analytics-outline"></ion-icon>
                                    </div>
                                </div>
                                <div class="">
                                    <h3 class="mb-2" id="salinitas-text">68,542</h3>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="widget-icon-small bg-light-danger text-danger">
                                            <ion-icon name="arrow-down-outline"></ion-icon>
                                        </div>
                                    </div>
                                </div>
                                <div id="chart-farmer-salinitas"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border shadow-none radius-10 flex-grow-1 mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-start gap-2">
                                    <div>
                                        <h5 class="mb-0 ">pH</h5>
                                    </div>
                                    <div class="ms-auto widget-icon-2 text-white rounded-circle" style="background-color: #FDE49E">
                                        <ion-icon name="analytics-outline"></ion-icon>
                                    </div>
                                </div>
                                <div class="">
                                    <h3 class="mb-2" id="ph-text">68,542</h3>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="widget-icon-small bg-light-danger text-danger">
                                            <ion-icon name="arrow-down-outline"></ion-icon>
                                        </div>
                                    </div>
                                </div>
                                <div id="chart-farmer-ph"></div>
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
            fetchData();
            fetchDataAll()
            $('#select_month').on('change', function(e) {
                window.location.href = "{{ route('dashboard.index') }}?month=" + e.target.value;
            });
            setInterval(() => {
                insertData();
            }, 20000);

            setInterval(() => {
                fetchData();
                fetchDataAll();
            }, 21000);
        });

        function chartHistory(elementId, elementData) {
            
            var options = {
                series: [{
                    name: "Total Orders",
                    data: elementData
                }],
                chart: {
                    type: "area",
                // width: 150,
                    height: 80,
                    toolbar: {
                        show: !1
                    },
                    zoom: {
                        enabled: !1
                    },
                    dropShadow: {
                        enabled: 0,
                        top: 3,
                        left: 14,
                        blur: 4,
                        opacity: .12,
                        color: "#32bfff"
                    },
                    sparkline: {
                        enabled: !0
                    }
                },
                markers: {
                    size: 0,
                    colors: ["#32bfff"],
                    strokeColors: "#fff",
                    strokeWidth: 2,
                    hover: {
                        size: 7
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: !1,
                        columnWidth: "30%",
                        endingShape: "rounded"
                    }
                },
                dataLabels: {
                    enabled: !1
                },
                stroke: {
                    show: !0,
                    width: 2,
                    curve: "smooth"
                },
                xaxis: {
                    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                    shade: 'light',
                    type: 'vertical',
                    shadeIntensity: 0.5,
                    gradientToColors: ['#32bfff'],
                    inverseColors: false,
                    opacityFrom: 0.5,
                    opacityTo: 0.1,
                    //stops: [0, 100]
                    }
                },
                colors: ["#32bfff"],
                tooltip: {
                    theme: "dark",
                    fixed: {
                        enabled: !1
                    },
                    x: {
                        show: !1
                    },
                    y: {
                        title: {
                            formatter: function(e) {
                                return ""
                            }
                        }
                    },
                    marker: {
                        show: !1
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#"+elementId), options);
            chart.render();
        }

        function insertData() {
            fetch('/api/insert-data', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                })
                .then(response => response.json())
                .then(data => console.log(data.message))
                .catch(error => console.error('Error:', error));
        }

        function fetchData() {
            fetch('/api/fetch-data')
                .then(response => response.json())
                .then(data => {
                    $('#do-text').html(data.do + ' Mg/L')
                    $('#tds-text').html(data.tds + ' Mg/L')
                    $('#amonia-text').html(data.amonia + ' Mg/L')
                    $('#suhu-text').html(data.suhu + ' °C')
                    $('#salinitas-text').html(data.salinitas + ' PSU')
                    $('#ph-text').html(data.ph)

                })
                .catch(error => console.error('Error:', error));
        }

        function fetchDataAll() {
            fetch('/api/fetch-data-all')
                .then(response => response.json())
                .then(data => {
                    console.log(data, 'asas');
                    
                    chartHistory('chart-farmer-do', data.do)
                    chartHistory('chart-farmer-tds', data.tds)
                    chartHistory('chart-farmer-amonia', data.amonia)
                    chartHistory('chart-farmer-suhu', data.suhu)
                    chartHistory('chart-farmer-salinitas', data.salinitas)
                    chartHistory('chart-farmer-ph', data.ph)



                })
                .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
