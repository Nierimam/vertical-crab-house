@extends('admin.layouts.app')

@section('title')
    Kategori
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    <div class="d-flex align-items-center mb-3">
       <h5 class="mb-0" style="color: #cc2514">Kategori Tabel</h5>
    </div>
    <div class="d-flex justify-content-between align-items-center" >
      <form class="position-relative" action="" method="get" >
        <div class="position-absolute top-50 translate-middle-y search-icon px-3"><ion-icon name="search-sharp"></ion-icon></div>
        <input class="form-control  form-control-sm ps-5" value="{{$search}}" type="text" name="search" autocomplete="off" placeholder="search">
      </form>
      <div>
        <a href="{{route('kategori.create')}}" class="top-menu mb-2 btn btn-sm text-light" style="background-color: #cc2514">
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
            <th style="width: 2em" class="text-center">No</th>
            <th style="width: 5em">Nama Kategori</th>
            <th style="width: 5em" class="text-center">Aksi</th>
         </tr>
         </thead>
         @php
         $index = 0
         @endphp
         <tbody>
             @if(count($data) > 0)
             @foreach ($data as $categories)
             <tr>
                 <td class="text-center">{{ ++$index }}</td>
                 <td>{{ ucfirst($categories->name) }}</td>
                 <td>
                     <div class="d-flex justify-content-center">
                         <div class="btn-group btn-group-sm">
                             <a class="btn btn-warning" style="color: white" href="{{ route('kategori.edit', $categories->id) }}"> Edit </a>
                             <button type="button" class="btn btn-danger delete-data" data-redirect="{{route('kategori.destroy',$categories->id)}}" data-id="{{ $categories->id }}" data-token="{{ csrf_token() }}"> Hapus </button>
                         </div>
                     </div>
                 </td>
             </tr>
             @endforeach
             @else
             <tr>
                 <td class="text-center" colspan="6">Tidak Terdapat Data Kategori</td>
             </tr>
             @endif
         </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end">
        <nav aria-label="Page navigation example">
            {{$data->links('vendor.pagination.default')}}
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
                url: "admin/produk/kategori",
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


