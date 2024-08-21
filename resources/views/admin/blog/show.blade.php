@extends('admin.layouts.app')

@section('title')
    Blog
@endsection

@section('content')
  <div class="">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="text-lg font-medium truncate">Detail Blog</h2>
        <div class="intro-y col-span-12 flex justify-between flex-wrap sm:flex-no-wrap items-center">
            <a href="{{route('blog.index')}}" class="btn btn-secondary"> Kembali </a>
        </div>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
        <div class="col-lg-12">
            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label">Judul Blog</label>
                    <input type="text" name="judul" readonly class="form-control form-control-sm" placeholder="Masukkan judul blog" value="{{ ucfirst($blog->judul) }}" >
                </div>
            </div>
            <div class="row mb-3">
              <div class="col-lg-12">
                  <label class="form-label">Deskripsi</label>
                  <textarea type="text" rows="5" readonly name="deskripsi" class="form-control form-control-sm" placeholder="Masukkan Deskripsi" value="" >{{ ucfirst($blog->deskripsi) }}</textarea>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-lg-12">
                  <label class="form-label">Status</label>
                  <input type="text" name="judul" readonly class="form-control form-control-sm" placeholder="Masukkan judul blog" value="{{ ucfirst($blog->status) }}" >
              </div>
            </div>
            <label for="" class="form-label">Gambar</label>
            <div class="col-lg-12 d-flex flex-row gap-2">
              @foreach ($media as $key => $value)
              <div class="">
                <a class="fancybox" id="basic-addon2" data-caption="{{$blog->judul}}" href="{{asset('upload/'.$value->media)}}">
                  <img src="{{asset('upload/'.$value->media)}}" style="width: 180px; height:180px;  " alt="">
                </a>
              </div>
              @endforeach
            </div>
        </div>
    </div>
  </div>
@endsection
