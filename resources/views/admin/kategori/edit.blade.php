@extends('admin.layouts.app')

@section('title')
    Kategori
@endsection

@section('content')
  <div>
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="text-lg font-medium truncate">Edit Data Kategori</h2>
        <div class="intro-y col-span-12 flex justify-between flex-wrap sm:flex-no-wrap items-center">
            <a href="{{route('kategori.index')}}" class="btn btn-secondary"> Kembali </a>
        </div>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
        <form action="{{ route('kategori.update',$kategori->id) }}" method="POST" autocomplete="off">
          @method('PUT')
          @csrf
          <div class="col-lg-12">
              <div class="row mb-3">
                  <div class="col-lg-12">
                      <label class="form-label">Nama Kategori</label>
                      <input type="text" name="name" class="form-control form-control-sm" placeholder="Masukkan nama kategori" value="{{ ucfirst($kategori->name) }}" >
                  </div>
              </div>
              <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label">Type Kategori</label>
                    <select name="type" class="form-control form-control-sm">
                        <option value="" selected disabled>-Pilih Type-</option>
                        <option value="merchant" {{ $kategori->type == 'merchant' ? 'selected' : '' }}>Merchant</option>
                        <option value="farmer" {{ $kategori->type == 'farmer' ? 'selected' : '' }}>Farmer</option>
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
