@extends('admin.layouts.app')

@section('title')
    Pesanan
@endsection

@section('content')
  <div class="">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="text-lg font-medium truncate">Konfirmasi Pengiriman</h2>
        <div class="intro-y col-span-12 flex justify-between flex-wrap sm:flex-no-wrap items-center">
            <a href="{{route('order.index')}}" class="btn btn-secondary"> Kembali </a>
        </div>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
        <form action="{{ route('confirmPengiriman', $data->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <div class="col-lg-12">
            <div class="row mb-3">
              <div class="col-lg-12">
                  <label class="form-label">Invoice</label>
                  <input type="text" name="invoice" readonly class="form-control form-control-sm" placeholder="Masukkan Invoice" value="{{ ucfirst($data->invoice) }}" >
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-lg-12">
                  <label class="form-label">No Resi</label>
                  <input type="text" name="no_resi" class="form-control form-control-sm" placeholder="Masukkan No Resi">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-lg-12">
                  <label class="form-label">Customer</label>
                  <input type="text" name="customer" readonly class="form-control form-control-sm bg-gray-300" placeholder="Masukkan Customer" value="{{ ucfirst($data->customers->nama_lengkap) }}" >
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-lg-12">
                  <label class="form-label">Alamat</label>
                  <textarea type="text" rows="5" readonly name="alamat" class="form-control form-control-sm bg-gray-300" placeholder="Masukkan Alamat" value="" >{{ ucfirst($data->alamat) }}</textarea>
              </div>
            </div>
            <div class="col-lg-12 d-flex justify-content-end" >
              <button type="submit" class="btn btn-success"> Simpan </button>
            </div>
          </div>
        </form>
    </div>
  </div>
@endsection
