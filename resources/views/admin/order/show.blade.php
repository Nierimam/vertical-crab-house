@extends('admin.layouts.app')

@section('title')
    Pesanan
@endsection

@section('content')
  <div class="">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="text-lg font-medium truncate">Detail Pesanan</h2>
        <div class="intro-y col-span-12 flex justify-between flex-wrap sm:flex-no-wrap items-center">
            <a href="{{route('order.index')}}" class="btn btn-secondary"> Kembali </a>
        </div>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
        <div class="col-lg-12">
            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label" >Invoice</label>
                    <input type="text" name="invoice" readonly class="form-control form-control-sm" placeholder="Masukkan Invoice" value="{{ ucfirst($data->invoice) }}" >
                </div>
            </div>
            <div class="row mb-3">
              <div class="col-lg-12">
                  <label class="form-label">No Resi</label>
                  <input type="text" name="no_resi" readonly class="form-control form-control-sm" placeholder="Masukkan No Resi" value="{{ $data->no_resi }}" >
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
                  <label class="form-label">Kordinat Alamat</label>
                  <div style="width: 100px">
                      <a type="button" href="https://www.google.com/maps?q={{ $data->lat.','.$data->long }}" class="btn btn-success" target="_blank">Google Map</a>
                  </div>
              </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-4">
                    <label class="form-label">Nama Bank</label>
                    <input type="text" name="nama_bank" readonly class="form-control form-control-sm" placeholder="Masukkan Nama Bank" value="{{ ucfirst($data->nama_bank) }}" >
                </div>
                <div class="col-lg-4">
                    <label class="form-label">No Bank</label>
                    <input type="text" name="no_bank" readonly class="form-control form-control-sm" placeholder="Masukkan No Bank" value="{{ ucfirst($data->no_bank) }}" >
                </div>
                <div class="col-lg-4">
                    <label class="form-label">Pemilik Bank</label>
                    <input type="text" name="pemilik_bank" readonly class="form-control form-control-sm" placeholder="Masukkan No Bank" value="{{ ucfirst($data->pemilik_bank) }}" >
                </div>
            </div>
            <div class="row mb-3">
              <div class="col-lg-12">
                  <label class="form-label">Status</label>
                  <input type="text" name="status" readonly class="form-control form-control-sm" placeholder="Masukkan status" value="{{ ucfirst($data->status) }}" >
              </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-6">
                    <label class="form-label">Voucher</label>
                    <input type="text" name="voucher" readonly class="form-control form-control-sm" placeholder="" value="{{ $data->voucher }}" >
                </div>
                <div class="col-lg-6">
                    <label class="form-label">Tipe Voucher</label>
                    <input type="text" name="tipe_voucher" readonly class="form-control form-control-sm" placeholder="" value="{{ ucfirst($data->type_voucher) }}" >
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-6">
                    <label class="form-label">Discount</label>
                    <input type="text" name="discount" readonly class="form-control form-control-sm" placeholder="" value="{{ $data->discount }}" >
                </div>
                <div class="col-lg-6">
                    <label class="form-label">Nominal Discount</label>
                    <input type="text" name="nominal_discount" readonly class="form-control form-control-sm" placeholder="" value="{{ ucfirst($data->nominal_discount) }}" >
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-6">
                    <label class="form-label">Total Sebelum Discount</label>
                    <input type="text" name="total_sebelum_discount" readonly class="form-control form-control-sm" placeholder="Masukkan Total Sebelum Discount" value="Rp {{ number_format($data->total_sebelum_discount,0,',','.') }}" >
                </div>
                <div class="col-lg-6">
                    <label class="form-label">Total</label>
                    <input type="text" name="total" readonly class="form-control form-control-sm" placeholder="Masukkan Total" value="Rp {{ number_format($data->total,0,',','.') }}" >
                </div>
            </div>
            <div class="row mb-3">
              <div class="col-lg-12">
                  <label class="form-label">Kurir Pengiriman</label>
                  <input type="text" name="shipping_courier" readonly class="form-control form-control-sm" placeholder="Masukkan Kurir Pengiriman" value="{{ ucfirst($data->shipping_courier) }}" >
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-lg-12">
                  <label class="form-label">Harga Pengiriman</label>
                  <input type="text" name="shipping_price" readonly class="form-control form-control-sm" placeholder="Masukkan Harga Pengiriman" value="Rp {{ number_format($data->shipping_price,0,',','.') }}" >
              </div>
            </div>
        </div>
    </div>
  </div>
@endsection
