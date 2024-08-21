@extends('admin.layouts.app')

@section('title')
    Blog
@endsection

@section('content')
  <div class="">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="text-lg font-medium truncate">Tambah Data Blog</h2>
        <div class="intro-y col-span-12 flex justify-between flex-wrap sm:flex-no-wrap items-center">
            <a href="{{route('blog.index')}}" class="btn btn-secondary"> Kembali </a>
        </div>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
        <form action="{{ route('blog.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
          @csrf
          <div class="col-lg-12">
              <div class="row mb-3">
                  <div class="col-lg-12">
                      <label class="form-label">Judul Blog</label>
                      <input type="text" required name="judul" class="form-control form-control-sm" placeholder="Masukkan judul blog" value="" >
                  </div>
              </div>
              <div class="row mb-3">
                <div class="col-lg-12">
                    <label>Deskripsi</label>
                    <textarea type="text" required name="deskripsi" class="form-control form-control-sm" placeholder="Masukkan Deskripsi" value="" ></textarea>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label">Status</label>
                    <select
                      class="form-control form-control-sm"
                      name="status"
                      required
                    >
                      <option disabled selected>Pilih Status</option>
                      <option value="publish">Publish</option>
                      <option value="non publish">Tidak Publish</option>
                    </select>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-lg-12">
                    <div class="card">
                      <div class="card-body" id="wrapper-variant">
                        <div class="col-lg-12 mb-3" id="body-variant">
                            <div class="row">
                              <div class="col-lg-11">
                                  <label class="form-label">Gambar</label>
                                  <input type="file" name="img[]" required class="form-control form-control-sm" value="" multiple>
                              </div>
                              <div class="col-lg-1">
                                <button href="" id="btn-add-row" type="button" class="btn btn-success btn-sm" style="margin-top: 2em" > <i class="fa fa-plus" style="width: 20px" aria-hidden="true"></i></button>
                              </div>
                            </div>
                        </div>
                      </div>
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

@section('js-content')
    <script>
      $(document).ready(function(){
        $('#btn-add-row').on('click',function(){
          addVariant();
        })
      })

      function addVariant(){
        var row = `
          <div class="col-lg-12 mb-3" id="body-variant">
              <div class="row">
                <div class="col-lg-11">
                  <label class="form-label">Gambar</label>
                  <input type="file" name="img[]" class="form-control form-control-sm" value="" multiple>
                </div>
                <div class="col-lg-1">
                  <button type="button" class="btn btn-danger btn-sm btn-hapus-row" style="margin-top: 2em" ><i class="fa fa-trash-o" style="width: 20px" aria-hidden="true"></i></button>
                </div>
              </div>
          </div>
        `
        $('#wrapper-variant').append(row)
        $('#wrapper-variant').on('click','.btn-hapus-row',function(){
        $(this).closest('#body-variant').remove();
        })
      }
    </script>
@endsection
