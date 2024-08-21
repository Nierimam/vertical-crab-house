@extends('user.layouts.app')

@section('content')
<section class="bg0 p-t-104 p-b-116" style="margin-top: 2rem;margin-bottom:2rem">
    <div class="container">
        <div class="flex-w flex-tr justify-content-center">
            <div class="size-219 bor10 p-lr-30 p-t-55 p-b-70 p-lr-15-lg w-full">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="text-center">
                        <h1>Merchant</h1>
                    </div>
                    {{-- Dashboard --}}
                        @if (auth()->user()->merchant && auth()->user()->merchant->user_id)
                        <div class="card">
                            <div class="card-body">
                                <div class="alert alert-{{ statusInfo()['status_agro'][$merchant->isConfirm]['color'] }} text-center">
                                    <span class="fw-bold">{{ statusInfo()['status_agro'][$merchant->isConfirm]['label'] }}</span><br>
                                    <span class="">{{ statusInfo()['status_agro'][$merchant->isConfirm]['text'] }}</span>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                            <label class="form-label">Nama Pemilik</label>
                                            <input type="text" name="judul" readonly class="form-control form-control-sm" required value="{{ $merchant->user->customers->nama_lengkap }}" >
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label">Nama Merchant</label>
                                            <input type="text" name="judul" readonly class="form-control form-control-sm" required value="{{ $merchant->nama_merchant }}" >
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <label class="form-label">Alamat Merchant</label>
                                            <textarea rows="5" type="text" name="alamat" class="form-control form-control-sm" required readonly disabled >{{ $merchant->alamat }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                            <label class="form-label">Logo</label>
                                            <div>
                                                <a href="{{ asset('upload/'.$merchant->logo) }}" class="fancybox">
                                                    <img src="{{ asset('upload/'.$merchant->logo) }}" width="200px" alt="Logo">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label">Foto Toko</label>
                                            <div>
                                                <a href="{{ asset('upload/'.$merchant->foto_toko) }}" class="fancybox">
                                                    <img src="{{ asset('upload/'.$merchant->foto_toko) }}" width="200px" alt="Foto Toko">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3" style="padding-top: 3rem">
                                        <div class="col-lg-12 text-end">
                                            @if ($merchant->isConfirm == 0)
                                            <i>Merchant Belum Aktif Tidak Dapat Masuk Ke Dashboard</i>
                                            @else
                                            <button href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ubahDataMerchant">Ubah Data Merchant</button>
                                            <a href="{{ route('dashboard.index') }}" class="btn btn-primary">Dashboard Merchant</a>
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
                                    <img src="{{ asset('img/merchant.png') }}" width="300" alt="">
                                </div>
                                <div>
                                    <p style="width: 400px; text-align: justify">Merchant adalah istilah yang biasanya merujuk kepada seseorang atau perusahaan yang menjual barang atau jasa kepada konsumen</p>
                                </div>
                            </div>
                            <div class="text-center" style="margin-top: 2rem">
                                <h3>Anda Belum Memiliki Merchant Daftarkan Sekarang Merchant Anda</h3>
                            </div>
                            <div class="text-center" style="margin-top: 2rem;margin-bottom: 3rem">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#daftarMerchant">Daftar Merchant</button>
                            </div>
                        </div>
                        @endif
                    {{-- Dashboard --}}
                </div>
            </div>
        </div>
    </div>
</section>

@if (auth()->user()->merchant && auth()->user()->merchant->user_id)
<!-- Modal Ubah Data Merchant-->
<div class="modal fade" id="ubahDataMerchant" tabindex="-1" aria-labelledby="ubahDataMerchantLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="ubahDataMerchantLabel">
            <h4 class="mtext-105 cl2 txt-center p-b-30">
                <b>Ubah Data Merchant</b>
            </h4>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('merchant-user.update', $merchant->id) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @method('PUT')
                @csrf
                <div class="col-lg-12">
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label class="form-label">Nama Merchant</label>
                            <input type="text" name="nama_merchant" class="form-control form-control-sm" required value="{{ $merchant->nama_merchant }}" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label class="form-label">Alamat Merchant</label>
                            <textarea rows="5" type="text" name="alamat" class="form-control form-control-sm" required >{{ $merchant->alamat }}</textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label class="form-label">Logo</label>
                            <input type="file" class="form form-control form-control-sm" value="" name="logo" style="padding-top: 13px">
                            <div class="mt-2">
                                <a href="{{ asset('upload/'.$merchant->logo) }}" class="fancybox btn btn-info btn-sm">
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
                                <a href="{{ asset('upload/'.$merchant->foto_toko) }}" class="fancybox btn btn-info btn-sm">
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
                <b>Daftar Merchant</b>
            </h4>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('merchant-user.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="col-lg-12">
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label for="" class="form-label form-control-label">Nama Merchant</label>
                            <input type="text" class="form form-control form-control-sm" value="" name="nama_merchant" required placeholder="Masukkan Nama Merchant">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="" class="form-label form-control-label">Logo</label>
                            <input type="file" class="form form-control form-control-sm" value="" name="logo" required style="padding-top: 13px">
                        </div>
                        <div class="col-lg-6">
                            <label for="" class="form-label form-control-label">Foto Toko</label>
                            <input type="file" class="form form-control form-control-sm" value="" name="foto_toko" required style="padding-top: 13px">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label for="" class="form-label form-control-label">Alamat Merchant</label>
                            <textarea type="text" rows="5" class="form form-control form-control-sm" value="" name="alamat" required placeholder="Masukkan Alamat Merchant"></textarea>
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
