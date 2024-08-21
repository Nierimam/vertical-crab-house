@extends('admin.layouts.app')

@section('title')
    Customer
@endsection

@section('content')
  <div class="col-span-12 my-6">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="text-lg font-medium truncate">Ubah Data Customer</h2>
        <div class="intro-y col-span-12 flex justify-between flex-wrap sm:flex-no-wrap items-center">
            <a href="{{route('customer.index')}}" class="btn btn-secondary"> Kembali </a>
        </div>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
        <form action="{{ auth()->user()->role == 'admin' ? route('customer.update',$user->id) : route('customer.update',auth()->user()->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <div class="card">
            <div class="card-body">
                <div class="col-lg-12">
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control form-control-sm" placeholder="Masukkan nama lengkap" value="{{$user->customers->nama_lengkap}}" >
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control form-control-sm" placeholder="Masukkan username" value="{{$user->username}}" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label class="form-label">No Telepon</label>
                            <input type="text" name="telp" class="form-control form-control-sm" placeholder="Masukkan no telpon" value="{{$user->customers->telp}}" >
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control form-control-sm" placeholder="Masukkan tempat lahir" value="{{$user->customers->tempat_lahir}}" >
                        </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-lg-12">
                          <label class="form-label">Tanggal Lahir</label>
                          <input type="date" name="tanggal_lahir" class="form-control form-control-sm" placeholder="Masukkan nama kategori" value="{{date('Y-m-d', strtotime($user->customers->tanggal_lahir))}}" >
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-lg-12">
                          <label class="form-label">Gambar</label>
                          <input type="file" name="img_profile" class="form-control form-control-sm bg-white" placeholder="Masukkan nama kategori" value="" >
                          <div class="mt-4">
                            <a class="btn btn-primary fancybox" id="basic-addon2" data-caption="{{$user->username}}" href="{{asset('upload/'.$user->customers->img_profile)}}">Lihat Gambar</a>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
                <div class="col-lg-12">
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <label class="form-label">Email</label>
                            <input type="text" name="email" class="form-control form-control-sm" placeholder="Masukkan nama kategori" value="{{$user->email}}" >
                        </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-lg-6">
                          <label class="form-label">Password</label>
                          <input type="password" name="password" class="form-control form-control-sm" placeholder="******" value="" >
                      </div>
                      <div class="col-lg-6">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control form-control-sm" placeholder="******" value="" >
                    </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="col-span-12 d-flex justify-content-end" >
            <button type="submit" class="btn btn-success"> Simpan </button>
          </div>
        </form>
    </div>
  </div>
@endsection
