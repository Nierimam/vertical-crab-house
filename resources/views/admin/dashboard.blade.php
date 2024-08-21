@extends('admin.layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-2">
        <div class="h4 fw-500">Dashboard
            {{ auth()->user()->role == 'admin' ? 'Admin' : (auth()->user()->role == 'farmer' ? 'Farmer' : 'Merchant') }}
        </div>
    </div>

    @if (auth()->user()->role == 'merchant')
        <!--end breadcrumb-->
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xxl-4">
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-start gap-2">
                            <div>
                                <p class="mb-0 fs-6">Total Pemasukkan</p>
                            </div>
                            <div class="ms-auto widget-icon-small text-white bg-gradient-purple">
                                <ion-icon name="cash-outline"></ion-icon>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-3">
                            <div>
                                <h4 class="mb-0">Rp. {{ number_format($total_pemesanan, 0, ',', '.') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-start gap-2">
                            <div>
                                <p class="mb-0 fs-6">Total Produk</p>
                            </div>
                            <div class="ms-auto widget-icon-small text-white bg-gradient-success">
                                <ion-icon name="layers"></ion-icon>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-3">
                            <div>
                                <h4 class="mb-0">{{ $produk }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-start gap-2">
                            <div>
                                <p class="mb-0 fs-6">Menunggu pembayaran</p>
                            </div>
                            <div class="ms-auto widget-icon-small text-white bg-gradient-info">
                                <ion-icon name="alarm-outline"></ion-icon>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-3">
                            <div>
                                <h4 class="mb-0">
                                    {{ $order->where('status', 'menunggu_pembayaran')->count() }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-start gap-2">
                            <div>
                                <p class="mb-0 fs-6">Pesanan Selesai</p>
                            </div>
                            <div class="ms-auto widget-icon-small text-white bg-gradient-danger">
                                <ion-icon name="checkmark-done-outline"></ion-icon>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-3">
                            <div>
                                <h4 class="mb-0">
                                    {{ $order->where('status', 'diterima')->count() }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->

        <div class="col-lg-12">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0" style="color: #cc2514">Pembelian Terakhir</h6>
                    </div>
                    <div class="table-responsive mt-2">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Invoice</th>
                                    <th>Customer</th>
                                    <th>Alamat</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $index = 1;
                                @endphp
                                @foreach ($order as $orders)
                                    <tr>
                                        <td>{{ $index++ }}</td>
                                        <td>{{ $orders->invoice }}</td>
                                        <td>{{ ucfirst($orders->customers->nama_lengkap) }}</td>
                                        <td>{{ $orders->alamat }}</td>
                                        <td>Rp {{ number_format($orders->total, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($orders->status == 'pending')
                                                <span
                                                    class="bg-red-100 text-red-800 text-xs font-medium me-2 px-3 py-1 rounded dark:bg-red-900 dark:text-red-300">
                                                    Konfirmasi Pesanan
                                                </span>
                                            @elseif($orders->status == 'menunggu_pembayaran')
                                                <span
                                                    class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-3 py-1 rounded dark:bg-yellow-900 dark:text-yellow-300">
                                                    Menunggu Pembayaran
                                                </span>
                                            @elseif($orders->status == 'menunggu_persetujuan')
                                                <span
                                                    class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-3 py-1 rounded dark:bg-yellow-900 dark:text-yellow-300">
                                                    Konfirmasi Pembayaran
                                                </span>
                                            @elseif($orders->status == 'terbayar')
                                                <span
                                                    class="bg-green-100 text-green-800 text-xs font-medium me-2 px-3 py-1 rounded dark:bg-green-900 dark:text-green-300">
                                                    Sudah terbayar
                                                </span>
                                            @elseif($orders->status == 'pengiriman')
                                                <span
                                                    class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-3 py-1 rounded dark:bg-blue-900 dark:text-blue-300">
                                                    Sedang Pengiriman
                                                </span>
                                            @elseif($orders->status == 'diterima')
                                                <span
                                                    class="bg-green-100 text-green-800 text-xs font-medium me-2 px-3 py-1 rounded dark:bg-green-900 dark:text-green-300">
                                                    Pesanan Diterima
                                                </span>
                                            @elseif($orders->status == 'dibatalkan')
                                                <span
                                                    class="bg-red-100 text-red-800 text-xs font-medium me-2 px-3 py-1 rounded dark:bg-red-900 dark:text-red-300">
                                                    Dibatalkan
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center align-items-center">
                                                <a class="btn btn-info"
                                                    href="{{ route('order.show', $orders->id) }}">Detail
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @elseif(auth()->user()->role == 'farmer')

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
    @else
        <!--end breadcrumb-->
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xxl-4">
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-start gap-2">
                            <div>
                                <p class="mb-0 fs-6">Total Customer</p>
                            </div>
                            <div class="ms-auto widget-icon-small text-white bg-gradient-purple">
                                <ion-icon name="analytics-outline"></ion-icon>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-3">
                            <div>
                                <h4 class="mb-0">{{ count($customer) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-start gap-2">
                            <div>
                                <p class="mb-0 fs-6">Total Produk</p>
                            </div>
                            <div class="ms-auto widget-icon-small text-white bg-gradient-success">
                                <ion-icon name="layers"></ion-icon>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-3">
                            <div>
                                <h4 class="mb-0">{{ $produk }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-start gap-2">
                            <div>
                                <p class="mb-0 fs-6">Menunggu pembayaran</p>
                            </div>
                            <div class="ms-auto widget-icon-small text-white bg-gradient-info">
                                <ion-icon name="alarm-outline"></ion-icon>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-3">
                            <div>
                                <h4 class="mb-0">
                                    {{ $order->where('status', 'menunggu_pembayaran')->count() }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-start gap-2">
                            <div>
                                <p class="mb-0 fs-6">Pesanan Selesai</p>
                            </div>
                            <div class="ms-auto widget-icon-small text-white bg-gradient-danger">
                                <ion-icon name="checkmark-done-outline"></ion-icon>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-3">
                            <div>
                                <h4 class="mb-0">
                                    {{ $order->where('status', 'diterima')->count() }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->

        <div class="row row-cols-1 row-cols-lg-1">
            <div class="col">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <h6 class="mb-0"><span style="color: #cc2514">List Customer</span> </h6>
                        </div>
                        <div class="countries-list">
                            @foreach ($customer->take(6) as $data)
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="country-name flex-grow-1">
                                        <h5 class="mb-0">{{ $data->nama_lengkap }}</h5>
                                        <p class="mb-0 text-secondary">{{ $data->user->email }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h6 class="mb-0" style="color: #cc2514">Pembelian Terakhir</h6>
                        </div>
                        <div class="table-responsive mt-2">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Invoice</th>
                                        <th>Customer</th>
                                        <th>Alamat</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index = 1;
                                    @endphp
                                    @foreach ($order as $orders)
                                        <tr>
                                            <td>{{ $index++ }}</td>
                                            <td>{{ $orders->invoice }}</td>
                                            <td>{{ ucfirst($orders->customers->nama_lengkap) }}</td>
                                            <td>{{ $orders->alamat }}</td>
                                            <td>Rp {{ number_format($orders->total, 0, ',', '.') }}</td>
                                            <td>
                                                @if ($orders->status == 'pending')
                                                    <span
                                                        class="bg-red-100 text-red-800 text-xs font-medium me-2 px-3 py-1 rounded dark:bg-red-900 dark:text-red-300">
                                                        Konfirmasi Pesanan
                                                    </span>
                                                @elseif($orders->status == 'menunggu_pembayaran')
                                                    <span
                                                        class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-3 py-1 rounded dark:bg-yellow-900 dark:text-yellow-300">
                                                        Menunggu Pembayaran
                                                    </span>
                                                @elseif($orders->status == 'menunggu_persetujuan')
                                                    <span
                                                        class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-3 py-1 rounded dark:bg-yellow-900 dark:text-yellow-300">
                                                        Konfirmasi Pembayaran
                                                    </span>
                                                @elseif($orders->status == 'terbayar')
                                                    <span
                                                        class="bg-green-100 text-green-800 text-xs font-medium me-2 px-3 py-1 rounded dark:bg-green-900 dark:text-green-300">
                                                        Sudah terbayar
                                                    </span>
                                                @elseif($orders->status == 'pengiriman')
                                                    <span
                                                        class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-3 py-1 rounded dark:bg-blue-900 dark:text-blue-300">
                                                        Sedang Pengiriman
                                                    </span>
                                                @elseif($orders->status == 'diterima')
                                                    <span
                                                        class="bg-green-100 text-green-800 text-xs font-medium me-2 px-3 py-1 rounded dark:bg-green-900 dark:text-green-300">
                                                        Pesanan Diterima
                                                    </span>
                                                @elseif($orders->status == 'dibatalkan')
                                                    <span
                                                        class="bg-red-100 text-red-800 text-xs font-medium me-2 px-3 py-1 rounded dark:bg-red-900 dark:text-red-300">
                                                        Dibatalkan
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a class="btn btn-info"
                                                        href="{{ route('order.show', $orders->id) }}">Detail
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


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
