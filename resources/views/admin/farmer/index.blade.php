@extends('admin.layouts.app')

@section('title')
    Farmer
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    <div class="d-flex align-items-center mb-3">
       <h5 class="mb-0" style="color: #cc2514">Farmer Tabel</h5>
    </div>
    <div class="d-flex justify-content-between align-items-center" >
      <form class="position-relative" action="" method="get" >
        <div class="position-absolute top-50 translate-middle-y search-icon px-3"><ion-icon name="search-sharp"></ion-icon></div>
        <input id="search-input" class="form-control  form-control-sm ps-5" value="{{$search}}" type="text" name="search" autocomplete="off" placeholder="search">
      </form>
    </div>
    <div id="indikator-loading-data" class="d-none d-flex justify-content-center align-items-center gap-2">
      <div id="loading-icon" class="spinner-border text-dark"></div>
      <div class="text-dark fs-4"><span id="login-text" class="">Memuat... </span></div>
    </div>
    <div id="table-data" class="d-none table-responsive mt-3">
      <table class="table align-middle mb-0">
        <thead class="table-light">
         <tr>
            <th style="width: 5em">No</th>
            <th style="width: 10em">Nama Pemilik</th>
            <th style="width: 10em">IOT Key</th>
            <th style="width: 10em">Nama Farmer</th>
            <th style="width: 10em">Status</th>
            <th style="width: 5em" class="text-center">Aksi</th>
         </tr>
         </thead>
         <tbody>
          @php
              $index = 0
          @endphp
          @if (count($farmers)>0)
            @foreach ($farmers as $farmer)
              <tr>
                <td>{{ ++$index }}</td>
                <td>{{ $farmer->user->customers->nama_lengkap }}</td>
                <td>{{ $farmer->iot_key }}</td>
                <td>{{ $farmer->nama_farmer }}</td>
                <td>
                    <span class="badge bg-{{ statusInfo()['status_agro'][$farmer->isConfirm]['color'] }}">
                        {{ statusInfo()['status_agro'][$farmer->isConfirm]['label'] }}
                    </span>
                </td>
                <td>
                  <div class="d-flex justify-content-center">
                    <div class="btn-group btn-group-sm">
                      <a type="button" class="btn btn-secondary" style="color: white" href="{{route('farmerShowDashboard',$farmer->id)}}">Dashboard</a>
                      <a type="button" class="btn btn-info" style="color: white" href="{{route('farmer.show',$farmer->id)}}">Detail</a>
                      <button type="button" class="btn btn-{{ statusInfo()['status_agro'][$farmer->isConfirm]['color'] }} change-status-farmer" style="color: white" data-redirect="{{route('updateStatusFarmer',$farmer->id)}}" data-id="{{ $farmer->id }}" data-token="{{ csrf_token() }}"> Ubah Status </button>
                      <button type="button" class="btn btn-danger delete-data" data-redirect="{{route('farmer.destroy',$farmer->id)}}" data-id="{{ $farmer->id }}" data-token="{{ csrf_token() }}"> Hapus </button>
                    </div>
                  </div>
                </td>
            </tr>
            @endforeach
          @else
          <tr>
            <td class="text-center" colspan="5">Tidak Terdapat Data Merchant</td>
         </tr>
          @endif
          </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end">
      <nav aria-label="Page navigation example">
          {{ $farmers->links('vendor.pagination.default') }}
        </nav>
    </div>
  </div>
</div>

@endsection

@section('js-content')
<script>
    $(document).ready(function () {
      function showLoadingIndicator() {
        $('#indikator-loading-data').removeClass('d-none');
      }

      function hideLoadingIndicator() {
        $('#indikator-loading-data').addClass('d-none');
        $('#table-data').removeClass('d-none')
      }
        fetchData();

        function fetchData() {
          showLoadingIndicator()

            $.ajax({
                url: "admin/merchant",
                type: 'GET',
                success: function (data) {
                    hideLoadingIndicator()
                },
                error: function () {
                    hideLoadingIndicator()
                }
            });
        }
    });

    $('.change-status-farmer').click(function (e) {
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
                        success: function (response) {
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


