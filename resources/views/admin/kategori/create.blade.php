@extends('admin.layouts.app')

@section('title')
    Kategori
@endsection

@section('content')
  <div>
    <div class="d-flex justify-content-between">
        <h2 class="text-lg font-medium truncate">Tambah Data Kategori</h2>
        <div class="intro-y col-span-12 flex justify-between flex-wrap sm:flex-no-wrap items-center">
            <a href="{{route('kategori.index')}}" class="btn btn-secondary"> Kembali </a>
        </div>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
        <form action="{{ route('kategori.store') }}" method="POST" autocomplete="off">
          @csrf
          <div class="col-lg-12">
            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" required name="name" class="form-control form-control-sm" placeholder="Masukkan nama kategori" value="" >
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label">Type Kategori</label>
                    <select name="type" id="" class="form-control form-control-sm">
                        <option value="" selected disabled>-Pilih Type-</option>
                        <option value="merchant">Merchant</option>
                        <option value="farmer">Farmer</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-end" >
                    <button type="submit" class="btn btn-success"> Simpan </button>
                </div>
            </div>
          </div>
        </form>
    </div>
  </div>
@endsection
