@extends('admin.layouts.app')

@section('title')
    Produk
@endsection

@section('content')
    @if (auth()->user()->role == 'farmer')
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
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
                                        <h4 class="mb-0">{{ count($produks) }}</h4>
                                    </div>
                                </div>
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
                <h5 class="mb-0" style="color: #cc2514">Produk Tabel</h5>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <form class="position-relative" action="" method="get">
                    <div class="position-absolute top-50 translate-middle-y search-icon px-3"><ion-icon
                            name="search-sharp"></ion-icon></div>
                    <input class="form-control  form-control-sm ps-5" value="{{ $search }}" type="text"
                        name="search" autocomplete="off" placeholder="search">
                </form>
                @if (auth()->user()->role != 'admin')
                    <div>
                        <a href="{{ route('product.create') }}" class="top-menu mb-2 btn btn-sm text-light"
                            style="background-color: #cc2514">
                            <div class="d-flex align-items-center justify-content-center align-content-center">
                                <div class="parent-icon">
                                    <ion-icon name="add"></ion-icon>
                                </div>
                                <div style="padding-top: 2px">
                                    <div class="menu-title">Tambah</div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            </div>
            <div id="indikator-loading-data" class="d-none d-flex justify-content-center align-items-center gap-2">
                <div id="loading-icon" class="spinner-border text-dark"></div>
                <div class="text-dark fs-4"><span id="login-text" class="">Memuat... </span></div>
            </div>
            <div id="table-data" class="d-none table-responsive mt-3">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5em" class="text-center">No</th>
                            <th style="width: 5em">Nama Produk</th>
                            <th style="width: 5em">Kategori Produk</th>
                            <th style="width: 5em">Penjual</th>
                            <th style="width: 5em">Status Tampil</th>
                            <th style="width: 5em">Status Persetujuan</th>
                            <th style="width: 5em" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    @php
                        $index = 0;
                    @endphp
                    <tbody>
                        @if (count($produks) > 0)
                            @foreach ($produks as $data)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration + ($produks->currentPage() - 1) * $produks->perPage() }}</td>
                                    <td>{{ ucfirst($data->nama_produk) }}</td>
                                    <td>{{ ucfirst($data->categories->name) }}</td>
                                    <td>{{ ucfirst($data->type) }}</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ statusInfo()['status_tampil_produk'][$data->status]['color'] }}">
                                            {{ statusInfo()['status_tampil_produk'][$data->status]['label'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ statusInfo()['status_agro'][$data->isConfirm]['color'] }}">
                                            {{ statusInfo()['status_agro'][$data->isConfirm]['label'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <div class="btn-group btn-group-sm">
                                                @if (auth()->user()->role != 'admin')
                                                    <a class="btn btn-warning" style="color: white"
                                                        href="{{ route('product.edit', $data->id) }}"> Edit </a>
                                                @endif
                                                <a class="btn btn-info" style="color: white"
                                                    href="{{ route('product.show', $data->id) }}"> Detail </a>
                                                @if (auth()->user()->role == 'admin')
                                                    <button type="button"
                                                        class="btn btn-{{ statusInfo()['status_agro'][$data->isConfirm]['color'] }} change-status-produk"
                                                        style="color: white"
                                                        data-redirect="{{ route('updateStatusProduct', $data->id) }}"
                                                        data-id="{{ $data->id }}" data-token="{{ csrf_token() }}">
                                                        Ubah Status </button>
                                                @endif
                                                <button type="button" class="btn btn-danger delete-data"
                                                    data-redirect="{{ route('product.destroy', $data->id) }}"
                                                    data-id="{{ $data->id }}" data-token="{{ csrf_token() }}"> Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="7">Tidak terdapat data Produk</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-4">
                <nav aria-label="Page navigation example">
                    {{ $produks->links('vendor.pagination.bootstrap-4') }}
                </nav>
            </div>
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
                    url: "admin/produk/product",
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

        $('.change-status-produk').click(function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            var token = $(this).data("token");
            var redirect = $(this).data("redirect");
            Swal.fire({
                    title: 'Yakin?',
                    text: "Status Akan Di Ubah?!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0275d8',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Yakin!',
                    cancelButtonText: 'Tidak'
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "put",
                            url: redirect,
                            data: {
                                "id": id,
                                "_method": 'PUT',
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
    </script>
@endsection
