@extends('admin.layouts.app')

@section('title')
    Voucher
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    <div class="d-flex align-items-center mb-3">
       <h5 class="mb-0" style="color: #cc2514">Voucher Tabel</h5>
    </div>
    <div class="d-flex justify-content-between align-items-center" >
      <form class="position-relative" action="" method="get" >
        <div class="position-absolute top-50 translate-middle-y search-icon px-3"><ion-icon name="search-sharp"></ion-icon></div>
        <input class="form-control  form-control-sm ps-5" value="{{$search}}" type="text" name="search" autocomplete="off" placeholder="search">
      </form>
      <div>
        <a href="{{route('voucher.create')}}" class="top-menu mb-2 btn btn-sm text-light" style="background-color: #cc2514">
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
            <th style="width: 5em">Nama Voucher</th>
            <th style="width: 5em">Tipe Voucher</th>
            <th style="width: 5em">Presentase / Nominal</th>
            <th style="width: 5em">Jumlah</th>
            <th style="width: 5em" class="text-center">Aksi</th>
         </tr>
         </thead>
         @php
         $index = 0
        @endphp
        <tbody>
            @if(count($vouchers) > 0)
                @foreach ($vouchers as $voucher)
                <tr>
                    <td>{{ ++$index }}</td>
                    <td>{{ $voucher->nama }}</td>
                    <td>{{ $voucher->type == 'persentase' ? 'Persentase' : 'Nominal' }}</td>
                    @if ($voucher->type == 'persentase')
                    <td>{{ $voucher->persentase }} %</td>
                    @else
                    <td>{{ $voucher->nominal }}</td>
                    @endif
                    <td>{{ $voucher->jumlah }}</td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <div class="btn-group btn-group-sm">
                                <a class="btn btn-warning" style="color: white" href="{{ route('voucher.edit', $voucher->id) }}"> Edit </a>
                                <a class="btn btn-info" style="color: white" href="{{ route('voucher.show',$voucher->id) }}"> Detail </a>
                                <button type="button" class="btn btn-danger delete-data" data-redirect="{{route('voucher.destroy',$voucher->id)}}" data-id="{{ $voucher->id }}" data-token="{{ csrf_token() }}"> Hapus </button>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            @else
            <tr>
                <td class="text-center" colspan="6">Tidak terdapat data Voucher</td>
            </tr>
            @endif
        </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end">
        <nav aria-label="Page navigation example">
            {{$vouchers->links('vendor.pagination.default')}}
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
        fetchUserData();

        function fetchUserData() {
          showLoadingIndicator()

            $.ajax({
                url: "admin/voucher",
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
  </script>
@endsection




