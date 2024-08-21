@extends('admin.layouts.app')

@section('title')
    Pesanan
@endsection

@section('content')
    <style>
        .display-fitur-action {
            display: flex;
        }

        @media only screen and (max-width: 475px) {
            .display-fitur-action {
                display: table-column;
            }
            .action-fitur-select{
                margin-top: 1rem;
                width: 100%;
            }

            .width-fitur-select{
                width: 100%;
            }

        }
    </style>
    @if (auth()->user()->role == 'farmer')
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-3">
                    <div class="col">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-start gap-2">
                                    <div>
                                        <p class="mb-0 fs-6">Total Pesanan</p>
                                    </div>
                                    <div class="ms-auto widget-icon-small text-white bg-gradient-success">
                                        <ion-icon name="book"></ion-icon>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mt-3">
                                    <div>
                                        <h4 class="mb-0">
                                            Rp. {{ number_format($total_pemesanan, 0, ',', '.') }}
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
                                            {{ $data->where('status', 'diterima')->count() }}
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
                                        <p class="mb-0 fs-6">Menunggu pembayaran</p>
                                    </div>
                                    <div class="ms-auto widget-icon-small text-white bg-gradient-info">
                                        <ion-icon name="alarm-outline"></ion-icon>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mt-3">
                                    <div>
                                        <h4 class="mb-0">
                                            {{ $data->where('status', 'menunggu_pembayaran')->count() }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="col">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-content-center align-items-center mb-3">
                                    <h6 class="mb-0">Grafik Pembelian</h6>
                                    @php
                                        $bulans = [
                                            'Januari',
                                            'Februari',
                                            'Maret',
                                            'April',
                                            'Mei',
                                            'Juni',
                                            'Juli',
                                            'Agustus',
                                            'September',
                                            'Oktober',
                                            'November',
                                            'Desember',
                                        ];
                                    @endphp
                                    <select name="" id="select_month" class="form form-control form-control-sm w-50">
                                        <option value="" selected>Semua</option>
                                        @foreach ($bulans as $key => $bulan)
                                            <option value="{{ $key + 1 }}"
                                                {{ $key + 1 == $select_month ? 'selected' : '' }}>
                                                {{ $bulan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <h2 class="mb-0" id="total-transaksi-done">0</h2>
                                </div>
                                <div id="chart1"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center mb-3">
                <h5 class="mb-0" style="color: #cc2514">Pemesanan Table</h5>
            </div>
            <div class="col-lg-12">
                <div class="row align-items-center">
                    <div class="col-lg-3">
                        <form class="position-relative" action="" method="get">
                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"><ion-icon
                                    name="search-sharp"></ion-icon></div>
                            <input class="form-control  form-control-sm ps-5" value="{{ $search }}" type="text"
                                name="search" autocomplete="off" placeholder="search">
                        </form>
                    </div>
                    <div class="col-lg-9 display-fitur-action justify-content-end align-items-center gap-2">
                        <div class="action-fitur-select">
                            <select name="select_year" id="select_year" class="form form-control form-control-sm w-100"
                                style="width: 200px">
                                <option value="all" selected>Semua Tahun</option>
                                @php
                                    $currentYear = date('Y');
                                    $startYear = $currentYear - 5;
                                    $endYear = $currentYear + 5;
                                    for ($year = $startYear; $year <= $endYear; $year++) {
                                        echo "<option value=\"$year\" " .
                                            ($year == $select_year ? 'selected' : '') .
                                            ">$year</option>";
                                    }
                                @endphp
                            </select>
                        </div>
                        <div class="action-fitur-select">
                            <div>
                                @php
                                    $bulan = [
                                        'Januari',
                                        'Februari',
                                        'Maret',
                                        'April',
                                        'Mei',
                                        'Juni',
                                        'Juli',
                                        'Agustus',
                                        'September',
                                        'Oktober',
                                        'November',
                                        'Desember',
                                    ];
                                @endphp
                                <select name="" id="select_month" class="form form-control form-control-sm w-100"
                                    style="width: 200px">
                                    <option value="all" selected>Semua Bulan</option>
                                    @foreach ($bulan as $key => $value)
                                        <option value="{{ $key + 1 }}"
                                            {{ $key + 1 == $select_month ? 'selected' : '' }}>
                                            {{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="action-fitur-select">
                            <form action="{{ route('orderExcel') }}" method="get" class="position-relative">
                                <input type="hidden" class="form-control w-25" value="{{ $search }}" name="search"
                                    autocomplete="off" placeholder="Search...">
                                <input type="hidden" class="form-control w-25" value="{{ $select_month }}" name="month"
                                    autocomplete="off" placeholder="Search...">
                                <input type="hidden" class="form-control w-25" value="{{ $select_year }}" name="year"
                                    autocomplete="off" placeholder="Search...">
                                <button type="submit" class="btn btn-success btn-sm">
                                    Export Excel
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="indikator-loading-data" class="d-none d-flex justify-content-center align-items-center gap-2">
                <div id="loading-icon" class="spinner-border text-dark"></div>
                <div class="text-dark fs-4"><span id="login-text" class="">Memuat... </span></div>
            </div>
            <!-- BEGIN: Data List -->
            <div id="table-data" class="d-none table-responsive mt-3">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5em">No</th>
                            <th style="width: 5em">Invoice</th>
                            <th style="width: 5em">Customer</th>
                            <th style="width: 5em">Alamat</th>
                            <th style="width: 5em">Total</th>
                            <th style="width: 5em">Status</th>
                            <th style="width: 5em" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    @php
                        $index = 0;
                    @endphp
                    <tbody>
                        @if (count($data) > 0)
                            @foreach ($data as $orders)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ ucfirst($orders->invoice) }}</td>
                                    <td>{{ ucfirst($orders->customers->nama_lengkap) }}</td>
                                    <td>{{ ucfirst($orders->alamat) }}</td>
                                    <td>Rp {{ number_format($orders->total, 0, ',', '.') }}</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ statusInfo()['status_order'][$orders->status]['color'] }}">
                                            {{ statusInfo()['status_order'][$orders->status]['label'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            @if (auth()->user()->role == 'merchant' || auth()->user()->role == 'farmer')
                                                @if ($orders->status == 'pending')
                                                    <button class="btn btn-secondary konfirmasi_pesanan"
                                                        data-redirect="{{ route('confirmOrder', $orders->id) }}"
                                                        data-id="{{ $orders->id }}" data-token="{{ csrf_token() }}">
                                                        Konfirmasi Pesanan </button>
                                                @elseif($orders->status == 'menunggu_persetujuan')
                                                    <a class="btn btn-warning mr-3"
                                                        href="{{ route('pageConfirmPayment', $orders->id) }}"> Konfirmasi
                                                        Pembayaran </a>
                                                @elseif($orders->status == 'terbayar')
                                                    <a class="btn btn-success mr-3"
                                                        href="{{ route('pageConfirmPengiriman', $orders->id) }}"> Kirim
                                                        Pesanan </a>
                                                @endif
                                            @endif
                                            <a class="btn btn-info mr-3 text-theme-3"
                                                href="{{ route('order.show', $orders->id) }}"> Detail </a>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="7">Tidak terdapat data Pesanan</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <nav aria-label="Page navigation example">
                        {{ $data->links('vendor.pagination.default') }}
                    </nav>
                </div>
            </div>
            <!-- END: Data List -->
        </div>


    </div>


@endsection

@section('js-content')
    <script>
        $(document).ready(function() {
            function showLoadingIndicator() {
                $('#indikator-loading-data').removeClass('d-none');
            }

            function hideLoadingIndicator() {
                $('#indikator-loading-data').addClass('d-none');
                $('#table-data').removeClass('d-none')
            }
            fetchUserData();

            function fetchUserData() {
                showLoadingIndicator()

                $.ajax({
                    url: "admin/order",
                    type: 'GET',
                    success: function(data) {
                        hideLoadingIndicator()
                    },
                    error: function() {
                        hideLoadingIndicator()
                    }
                });
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.konfirmasi_pesanan').click(function(e) {
                e.preventDefault();
                var id = $(this).data("id");
                var token = $(this).data("token");
                var redirect = $(this).data("redirect");
                Swal.fire({
                        title: 'Yakin?',
                        text: "Menyetujui Pemesanan",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#0275d8',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Setujui!',
                        cancelButtonText: 'Batal'
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "post",
                                url: redirect,
                                data: {
                                    "id": id,
                                    "_method": 'POST',
                                    "_token": token,
                                },
                                success: function(response) {
                                    Swal.fire(
                                            'Berhasil!',
                                            response.message,
                                            'success'
                                        )
                                        .then((result) => {
                                            location.reload();
                                        });

                                }
                            });
                        }
                    })
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#select_month, #select_year').on('change', function(e) {
                var month = $('#select_month').val();
                var year = $('#select_year').val();
                window.location.href = "{{ route('order.index') }}?month=" + month + "&year=" + year;
            });
        });
    </script>
@endsection
