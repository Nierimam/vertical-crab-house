@extends('admin.layouts.app')

@section('title')
    Pesanan
@endsection

@section('content')
  <div class="col-span-12 my-6">
    <div class="flex justify-between items-center">
        <h2 class="text-lg font-medium truncate">Konfirmasi Pesanan</h2>
        <div class="intro-y col-span-12 flex justify-between flex-wrap sm:flex-no-wrap items-center">
            <a href="{{route('order.index')}}" class="button w-36 mb-2 flex items-center justify-center bg-gray-700 text-white"> <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i> Kembali </a>
        </div>
    </div>
  </div>
  <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <form action="{{ route('order.update', $data->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
      @method('PUT')
      @csrf
      <div class="grid grid-cols-12 gap-5">
        <div class="col-span-12">
          <div>
              <label>Invoice</label>
              <input type="text" name="invoice" readonly class="input w-full border mt-2 bg-gray-300" placeholder="Masukkan Invoice" value="{{ ucfirst($data->invoice) }}" >
          </div>
        </div>
        <div class="col-span-12">
          <div>
              <label>Customer</label>
              <input type="text" name="customer" readonly class="input w-full border mt-2 bg-gray-300" placeholder="Masukkan Customer" value="{{ ucfirst($data->customers->nama_lengkap) }}" >
          </div>
        </div>
        <div class="col-span-12">
          <div>
              <label>Alamat</label>
              <textarea type="text" rows="5" readonly name="alamat" class="input w-full border mt-2 bg-gray-300" placeholder="Masukkan Alamat" value="" >{{ ucfirst($data->alamat) }}</textarea>
          </div>
        </div>
        <div class="col-span-12">
          <div>
              <label>Kurir Pengiriman</label>
              <select
                class="input w-full border mt-2"
                name="shipping_driver"
                required
              >
              <option selected disabled>Pilih Kurir Pengiriman</option>
              <option value="jne">JNE</option>
              <option value="sicepat">SiCepat</option>
              <option value="j&t">J&T</option>
              <option value="lionparcel">Lion Parcel</option>
              </select>
          </div>
        </div>
        <div class="col-span-12">
          <div>
              <label>Harga Pengiriman</label>
              <input type="text" required name="shipping_price" class="input w-full border mt-2" placeholder="Masukkan Harga Pengiriman" data-format_rupiah="formatRupiah">
          </div>
        </div>
        <div class="col-span-12 flex justify-end" >
          <button type="submit" class="button w-36 mb-2 flex items-center justify-center bg-theme-1 text-white"> Simpan </button>
        </div>
      </div>
    </form>
  </div>
@endsection
