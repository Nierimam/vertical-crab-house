@extends('admin.layouts.app')

@section('title')
    Customer
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    <div class="d-flex align-items-center mb-3">
       <h5 class="mb-0" style="color: #cc2514">Customer Tabel</h5>
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
            <th style="width: 10em">Nama Lengkap</th>
            <th style="width: 10em">Email</th>
            <th style="width: 5em" class="text-center">Aksi</th>
         </tr>
         </thead>
         <tbody>
          @php
              $index = 0
          @endphp
          @if (count($users)>0)
            @foreach ($users as $user)
              <tr>
                <td>{{++$index}}</td>
                <td>{{$user->customers->nama_lengkap}}</td>
                <td>{{$user->email}}</td>
                <td>
                  <div class="d-flex justify-content-center">
                    <div class="btn-group btn-group-sm">
                      <a type="button" class="btn btn-warning" style="color: white" href="{{route('customer.edit',$user->id)}}" data-toggle="tooltip" data-placement="top" title="Ubah" >Edit</a>
                      <button type="button" class="btn btn-danger delete-data" data-redirect="{{route('customer.destroy',$user->id)}}" data-id="{{ $user->id }}" data-token="{{ csrf_token() }}"> Hapus </button>
                    </div>
                  </div>
                </td>
            </tr>
            @endforeach
          @else
          <tr>
            <td class="text-center" colspan="6">Tidak Terdapat Data Customer</td>
         </tr>
          @endif
          </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end">
      <nav aria-label="Page navigation example">
          {{$users->links('vendor.pagination.default')}}
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
                url: "/panel/karyawan",
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


