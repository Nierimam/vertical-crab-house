@extends('admin.layouts.app')

@section('title')
    Farmer
@endsection

@section('content')
  <div class="">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="text-lg font-medium truncate">Detail Farmer</h2>
        <div class="intro-y col-span-12 flex justify-between flex-wrap sm:flex-no-wrap items-center">
            <a href="{{route('farmer.index')}}" class="btn btn-secondary"> Kembali </a>
        </div>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
        <div class="alert alert-{{ statusInfo()['status_agro'][$farmer->isConfirm]['color'] }} text-center">
            <span class="">{{ statusInfo()['status_agro'][$farmer->isConfirm]['label'] }}</span>
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
                  <input type="text" name="judul" readonly class="form-control form-control-sm" value="{{ $farmer->iot_key }}" >
              </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label">Logo</label>
                    <div>
                        <a href="{{ asset('upload/'.$farmer->logo) }}" class="fancybox">
                            <img src="{{ asset('upload/'.$farmer->logo) }}" width="200px" alt="Logo">
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label">Foto Toko</label>
                    <div>
                        <a href="{{ asset('upload/'.$farmer->foto_toko) }}" class="fancybox">
                            <img src="{{ asset('upload/'.$farmer->foto_toko) }}" width="200px" alt="Foto Toko">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
