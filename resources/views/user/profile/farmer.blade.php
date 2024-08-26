@extends('user.layouts.app')

@section('content')
<section class="bg0 p-t-104 p-b-116" style="margin-top: 2rem;margin-bottom:2rem">
    <div class="container">
        <div class="flex-w flex-tr justify-content-center">
            <div class="size-219 bor10 p-lr-30 p-t-55 p-b-70 p-lr-15-lg w-full">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="text-center">
                        <h1>Farmer</h1>
                    </div>
                    {{-- Dashboard --}}
                        @if (auth()->user()->farmer && auth()->user()->farmer->user_id)
                        <div class="card">
                            <div class="card-body">
                                <div class="alert alert-{{ statusInfo()['status_agro'][$farmer->isConfirm]['color'] }} text-center">
                                    <span class="fw-bold">{{ statusInfo()['status_agro'][$farmer->isConfirm]['label'] }}</span><br>
                                    <span class="">{{ statusInfo()['status_agro'][$farmer->isConfirm]['text'] }}</span>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                            <label class="form-label">Nama Pemilik</label>
                                            <input type="text" name="judul" readonly class="form-control form-control-sm" value="{{ $farmer->user->customers->nama_lengkap }}" >
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label">Nama Farmer</label>
                                            <input type="text" name="judul" readonly class="form-control form-control-sm" value="{{ $farmer->nama_farmer }}" >
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <label class="form-label">IOT Key</label>
                                            <input rows="5" type="text" name="alamat" class="form-control form-control-sm" value="{{ $farmer->iot_key }}" readonly disabled />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <label class="form-label">Alamat Farmer</label>
                                            <textarea rows="5" type="text" name="alamat" class="form-control form-control-sm" readonly disabled >{{ $farmer->alamat }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                            <label class="form-label">Logo</label>
                                            <div>
                                                <a href="{{ asset('upload/'.$farmer->logo) }}" class="fancybox">
                                                    <img src="{{ asset('upload/'.$farmer->logo) }}" width="200px" alt="Logo">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label">Foto Toko</label>
                                            <div>
                                                <a href="{{ asset('upload/'.$farmer->foto_toko) }}" class="fancybox">
                                                    <img src="{{ asset('upload/'.$farmer->foto_toko) }}" width="200px" alt="Foto Toko">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3" style="padding-top: 3rem">
                                        <div class="col-lg-12 text-end">
                                            @if ($farmer->isConfirm == 0)
                                            <i>Farmer Belum Aktif Tidak Dapat Masuk Ke Dashboard</i>
                                            @else
                                            <button href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ubahDataMerchant">Ubah Data Farmer</button>
                                            <a href="{{ route('dashboard.index') }}" class="btn btn-primary">Dashboard Farmer</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                        @else
                        <div class="m-lr-0-xl">
                            <div class="d-flex align-items-center justify-content-center gap-4">
                                <div class="text-center" style="margin-top: 2rem">
                                    <img src="{{ asset('img/farmer.png') }}" width="300" alt="">
                                </div>
                                <div>
                                    <p style="width: 400px; text-align: justify">Farmer adalah individu yang bekerja di bidang pertanian, mengelola dan mengolah lahan untuk memproduksi atau beternak hewan dengan tujuan menghasilkan pangan, bahan baku, atau produk lain yang berguna</p>
                                </div>
                            </div>
                            <div class="text-center" style="margin-top: 2rem">
                                <h3>Anda Belum Memiliki Data Farmer Daftarkan Sekarang Farmer Anda</h3>
                            </div>
                            <div class="text-center" style="margin-top: 2rem;margin-bottom: 3rem">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#daftarMerchant">Daftar Farmer</button>
                            </div>
                        </div>
                        @endif
                    {{-- Dashboard --}}
                </div>
            </div>
        </div>
    </div>
</section>

@if (auth()->user()->farmer && auth()->user()->farmer->user_id)
<!-- Modal Ubah Data Merchant-->
<div class="modal fade" id="ubahDataMerchant" tabindex="-1" aria-labelledby="ubahDataMerchantLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="ubahDataMerchantLabel">
            <h4 class="mtext-105 cl2 txt-center p-b-30">
                <b>Ubah Data Farmer</b>
            </h4>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('farmer-user.update', $farmer->id) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @method('PUT')
                @csrf
                <div class="col-lg-12">
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label class="form-label">Nama Farmer</label>
                            <input type="text" name="nama_farmer" class="form-control form-control-sm" value="{{ $farmer->nama_farmer }}" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label class="form-label">Iot Key</label>
                            <input rows="5" type="text" name="iot_key" class="form-control form-control-sm" value="{{ $farmer->iot_key }}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label class="form-label">Alamat Farmer</label>
                            <textarea rows="5" type="text" name="alamat" class="form-control form-control-sm" >{{ $farmer->alamat }}</textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label class="form-label">Logo</label>
                            <input type="file" class="form form-control form-control-sm" value="" name="logo" style="padding-top: 13px">
                            <div class="mt-2">
                                <a href="{{ asset('upload/'.$farmer->logo) }}" class="fancybox btn btn-info btn-sm">
                                    Lihat Gambar
                                </a>
                                <i>Upload Kembali Jika Ingin Mengganti</i>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label class="form-label">Foto Toko</label>
                            <input type="file" class="form form-control form-control-sm" value="" name="foto_toko" style="padding-top: 13px">
                            <div class="mt-2">
                                <a href="{{ asset('upload/'.$farmer->foto_toko) }}" class="fancybox btn btn-info btn-sm">
                                    Lihat Gambar
                                </a>
                                <i>Upload Kembali Jika Ingin Mengganti</i>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-lg-12 text-right mt-4">
                            <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
@endif

<!-- Modal Ubah Profile-->
<div class="modal fade" id="daftarMerchant" tabindex="-1" aria-labelledby="daftarMerchantLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="daftarMerchantLabel">
            <h4 class="mtext-105 cl2 txt-center p-b-30">
                <b>Daftar Farmer</b>
            </h4>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('farmer-user.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="col-lg-12">
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label for="" class="form-label form-control-label">Nama Farmer</label>
                            <input type="text" class="form form-control form-control-sm" value="" name="nama_farmer" required placeholder="Masukkan Nama Farmer">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="" class="form-label form-control-label">Logo</label>
                            <input type="file" class="form form-control form-control-sm" value="" name="logo" required style="padding-top: 13px">
                        </div>
                        <div class="col-lg-6">
                            <label for="" class="form-label form-control-label">Foto Farmer</label>
                            <input type="file" class="form form-control form-control-sm" value="" name="foto_toko" required style="padding-top: 13px">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label class="form-label">Alamat Farmer</label>
                            <textarea rows="5" type="text" name="alamat" class="form-control form-control-sm" required ></textarea>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-lg-12 text-right mt-4">
                            <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    </div>
</div>
@endsection
