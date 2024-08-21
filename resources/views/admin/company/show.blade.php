@extends('admin.layouts.app')

@section('title')
    Setting Company
@endsection

@section('content')
  <div class="col-span-12 my-6">
    <div class="flex justify-between items-center">
        <h2 class="text-lg font-medium truncate">Detail Data Setting Company</h2>
        <div class="intro-y col-span-12 flex justify-between flex-wrap sm:flex-no-wrap items-center">
            <a href="{{route('company.index')}}" class="button w-36 mb-2 flex items-center justify-center bg-gray-700 text-white"> <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i> Kembali </a>
        </div>
    </div>
  </div>
  <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <div class="grid grid-cols-12 gap-5">
      <div class="col-span-12">
          <div>
              <label>Nama</label>
              <input type="text" id="input-produk" name="nama"  readonly class="input w-full border mt-2 bg-gray-300" placeholder="Masukkan nama" value="{{ ucfirst($data->nama) }}" >
          </div>
      </div>
      <div class="col-span-12">
        <div>
            <label>Deskripsi</label>
            <textarea type="text" name="deskripsi" rows="5" readonly class="input w-full border mt-2 bg-gray-300" placeholder="Masukkan deskripsi" value="" >{{ $data->deskripsi }}</textarea>
        </div>
      </div>
      <div class="col-span-12">
        <div>
            <label>Telp</label>
            <input type="text" id="input-produk" name="telp" readonly class="input w-full border mt-2 bg-gray-300" placeholder="Masukkan Telp" value="{{ $data->telp }}" >
        </div>
      </div>
      <div class="col-span-12">
        <div>
            <label>Visi</label>
            <textarea type="text" name="visi" rows="3" readonly class="input w-full border mt-2 bg-gray-300" placeholder="Masukkan visi" value="" >{{ $data->visi }}</textarea>
        </div>
      </div>
      <div class="col-span-12">
        <div>
            <label>Misi</label>
            <textarea type="text" name="misi" rows="3" readonly class="input w-full border mt-2 bg-gray-300" placeholder="Masukkan misi" value="" >{{ $data->misi }}</textarea>
        </div>
      </div>
      <div class="col-span-12">
        <div>
            <label>Alamat</label>
            <textarea type="text" name="alamat" rows="3" readonly class="input w-full border mt-2 bg-gray-300" placeholder="Masukkan alamat" value="" >{{ $data->alamat }}</textarea>
        </div>
      </div>
      <div class="col-span-12">
        <div>
            <label>Facebook</label>
            <input type="text" id="input-produk" name="facebook" readonly class="input w-full border mt-2 bg-gray-300" placeholder="Masukkan facebook" value="{{ $data->facebook }}" >
        </div>
      </div>
      <div class="col-span-12">
        <div>
            <label>Instagram</label>
            <input type="text" id="input-produk" name="instagram" readonly class="input w-full border mt-2 bg-gray-300" placeholder="Masukkan Instagram" value="{{ $data->instagram }}" >
        </div>
      </div>
      <div class="col-span-12">
        <div>
            <label>Linkedin</label>
            <input type="text" id="input-produk" name="linkedin" readonly class="input w-full border mt-2 bg-gray-300" placeholder="Masukkan linkedin" value="{{ $data->linkedin }}" >
        </div>
      </div>
      <div class="col-span-12">
        <div>
            <label>Tiktok</label>
            <input type="text" id="input-produk" name="tiktok" readonly class="input w-full border mt-2 bg-gray-300" placeholder="Masukkan tiktok" value="{{ $data->tiktok }}" >
        </div>
      </div>
      <div class="col-span-12">
        <div>
            <label>Shopee</label>
            <input type="text" id="input-produk" name="shopee" readonly class="input w-full border mt-2 bg-gray-300" placeholder="Masukkan shopee" value="{{ $data->shopee }}" >
        </div>
      </div>
      <div class="col-span-12">
        <div>
            <label>Tokopedia</label>
            <input type="text" id="input-produk" name="tokopedia" readonly class="input w-full border mt-2 bg-gray-300" placeholder="Masukkan tokopedia" value="{{ $data->tokopedia }}" >
        </div>
      </div>
      <div class="col-span-12">
        <div class="grid-cols-12 gap-5">
          <label>Logo</label>
          <div class="input-group">
              <div class="mt-4">
                <a class="input-group-text button fancybox bg-theme-1 text-white" id="basic-addon2" data-caption="{{$data->nama}}" href="{{asset('upload/'.$data->logo)}}">Lihat Gambar</a>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

