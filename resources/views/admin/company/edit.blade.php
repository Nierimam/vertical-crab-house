@extends('admin.layouts.app')

@section('title')
    Setting Company
@endsection

@section('content')
  <div class="">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="text-lg font-medium truncate">Ubah Data Setting Company</h2>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
        <form action="{{ route('company.update', $data->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <div class="col-lg-12">
            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label">Nama</label>
                    <input type="text" id="input-produk" name="nama" class="form-control form-control-sm" placeholder="Masukkan nama" value="{{ ucfirst($data->nama) }}" >
                </div>
            </div>
            <div class="row mb-3">
              <div class="col-lg-12">
                  <label class="form-label">Telp</label>
                  <input type="text" id="input-produk" name="telp" class="form-control form-control-sm" placeholder="Masukkan Telp" value="{{ $data->telp }}" >
              </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                  <h3 class="ont-bold text-lg">Sosial Media</h3>
                  <div class="" id="wrapper-variant">
                    <div class="col-lg-12" id="body-variant">
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <label>Facebook</label>
                                <input type="text" id="input-produk" name="facebook" class="form-control form-control-sm" placeholder="Masukkan facebook" value="{{ $data->facebook }}" >
                            </div>
                            <div class="col-lg-4">
                                <label>Instagram</label>
                                <input type="text" id="input-produk" name="instagram" class="form-control form-control-sm" placeholder="Masukkan Instagram" value="{{ $data->instagram }}" >
                            </div>
                            <div class="col-lg-4">
                                <label>Linkedin</label>
                                <input type="text" id="input-produk" name="linkedin" class="form-control form-control-sm" placeholder="Masukkan linkedin" value="{{ $data->linkedin }}" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <label>Tiktok</label>
                                <input type="text" id="input-produk" name="tiktok" class="form-control form-control-sm" placeholder="Masukkan tiktok" value="{{ $data->tiktok }}" >
                            </div>
                            <div class="col-lg-4">
                                <label>Shopee</label>
                                <input type="text" id="input-produk" name="shopee" class="form-control form-control-sm" placeholder="Masukkan shopee" value="{{ $data->shopee }}" >
                            </div>
                            <div class="col-lg-4">
                                <label>Tokopedia</label>
                                <input type="text" id="input-produk" name="tokopedia" class="form-control form-control-sm" placeholder="Masukkan tokopedia" value="{{ $data->tokopedia }}" >
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                    <div class="col-lg-12">
                        <label class="form-label">Visi</label>
                        <textarea type="text" name="visi" rows="3" class="form-control form-control-sm" placeholder="Masukkan visi" value="" >{{ $data->visi }}</textarea>
                    </div>
              </div>
              <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label">Misi</label>
                    <textarea type="text" name="misi" rows="3" class="form-control form-control-sm" placeholder="Masukkan misi" value="" >{{ $data->misi }}</textarea>
                </div>
              </div>
              <div class="row mb-3">
                  <div class="col-lg-12">
                      <label class="form-label">Deskripsi</label>
                      <textarea type="text" name="deskripsi" rows="3" class="form-control form-control-sm" placeholder="Masukkan deskripsi" value="" >{{ $data->deskripsi }}</textarea>
                  </div>
                </div>
              <div class="row mb-3">
                <div>
                    <label class="form-label">Alamat</label>
                    <textarea type="text" name="alamat" rows="3" class="form-control form-control-sm" placeholder="Masukkan alamat" value="" >{{ $data->alamat }}</textarea>
                </div>
              </div>
            <div class="row">
              <div class="col-lg-12">
                <label class="form-label">Logo</label>
                    <input type="file" name="logo" class="form-control form-control-sm input-file-gambar" data-id="{{ $data->id }}" value="" multiple>
                    <div class="mt-2">
                      <a class="fancybox btn btn-primary btn-sm" id="basic-addon2" data-caption="{{$data->nama}}" href="{{asset('upload/'.$data->logo)}}">Lihat Gambar</a>
                    </div>
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

