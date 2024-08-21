@extends('admin.layouts.app')

@section('title')
    Pesanan
@endsection

@section('content')
  <div class="">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="text-lg font-medium truncate">Konfirmasi Pembayaran</h2>
        <div class="intro-y col-span-12 flex justify-between flex-wrap sm:flex-no-wrap items-center">
            <a href="{{route('order.index')}}" class="btn btn-secondary"> Kembali </a>
        </div>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
        <form action="{{ route('confirmPayment', $data->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
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
                  <label class="form-label">Customer</label>
                  <input type="text" name="customer" readonly class="form-control form-control-sm" placeholder="Masukkan Customer" value="{{ ucfirst($data->customers->nama_lengkap) }}" >
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-lg-12">
                  <label>Alamat</label>
                  <textarea type="text" rows="5" readonly name="alamat" class="form-control form-control-sm" placeholder="Masukkan Alamat" value="" >{{ ucfirst($data->alamat) }}</textarea>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-lg-12">
                  <label class="form-label">Persetujuan Pembayaran</label>
                  <select
                    class="form-control form-control-sm"
                    name="status"
                    required
                  >
                  <option selected disabled>Pilih Persetujuan Pembayaran</option>
                  <option value="terbayar">Setujui Pembayaran</option>
                  <option value="ditolak">Tolak Pembayaran</option>
                  </select>
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
