@extends('admin.layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-2 justify-content-between">
        <div class="h4 fw-500">Dashboard
            {{ auth()->user()->role == 'admin' ? 'Admin' : (auth()->user()->role == 'farmer' ? 'Farmer' : 'Merchant') }}
        </div>
        @if (auth()->user()->role == 'farmer')
        <div class="text-end">
            <a class="btn btn-primary" href="{{ route('farmerHistory') }}">History</a>
        </div>
        @endif
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
                                <h4 class="mb-0">{{ $produkCountMerchant }}</h4>
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
                            <h6 class="mb-0"><span style="color: #cc2514">List User</span> </h6>
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
