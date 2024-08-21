@extends('admin.layouts.app')

@section('title')
    Blog
@endsection

@section('content')
  <div class="">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="text-lg font-medium truncate">Edit Data Blog</h2>
        <div class="intro-y col-span-12 flex justify-between flex-wrap sm:flex-no-wrap items-center">
            <a href="{{route('blog.index')}}" class="btn btn-secondary"> Kembali </a>
        </div>
    </div>
  </div>
  <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <form action="{{ route('blog.update', $data->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
      @method('PUT')
      @csrf
      <div class="col-lg-12">
          <div class="row mb-3">
              <div class="col-lg-12">
                  <label class="form-label">Judul Blog</label>
                  <input type="text" name="judul" class="form-control form-control-sm" placeholder="Masukkan judul blog" value="{{ ucfirst($data->judul) }}" >
              </div>
          </div>
          <div class="row mb-3">
            <div class="col-lg-12">
                <label class="form-label">Deskripsi</label>
                <textarea type="text" name="deskripsi" class="form-control form-control-sm" placeholder="Masukkan Deskripsi" value="" >{{ ucfirst($data->deskripsi) }}</textarea>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-lg-12">
                <label class="form-label">Status</label>
                <select
                  class="form-control form-control-sm"
                  name="status"
                >
                @if ($data->status == 'publish')
                  <option value="{{ $data->status }}" selected>{{ ucfirst($data->status) }}</option>
                  <option value="non publish">Non Publish</option>
                @else
                <option value="publish">Publish</option>
                <option value="{{ $data->status }}" selected>{{ ucfirst($data->status) }}</option>
                @endif
                </select>
            </div>
          </div>
          <div id="body-gambar" class="col-lg-12">
            @php
            $gambar_blog = '';
            @endphp
            @foreach ($media as $key => $value)
              @php
                  if($gambar_blog != ''){
                    $gambar_blog .= ',';
                  }
                  $gambar_blog .= $key+1;
                  $showDelete = false;
                  if($key > 0){
                    $showDelete = true;
                  }
              @endphp
            <div id="pembungkus-{{$key+1 }}" class="card">
              <div class="card-body" id="wrapper-variant">
                <div class="col-lg-12" id="body-variant">
                    <div class="row">
                            <div class="col-lg-11">
                                <label class="form-label">Gambar</label>
                                <input type="file" name="img_update[]" class="form-control form-control-sm input-file-gambar" data-id="{{ $value->id }}" value="" multiple>
                                <div class="mt-2">
                                    <a class="btn btn-primary btn-sm fancybox" id="basic-addon2" data-caption="{{$data->judul}}" href="{{asset('upload/'.$value->media)}}">Lihat Gambar</a>
                                </div>
                            </div>
                            <div class="col-lg-1">
                                @if ($showDelete)
                                <div>
                                    <button
                                    type="button"
                                    class="btn btn-danger btn-sm btn-hapus-row"
                                    data-key="{{ $key+1 }}"
                                    data-id="{{ $value->id }}"
                                    style="margin-top: 2em"
                                    >
                                    <i class="fa fa-trash-o" style="width: 20px" aria-hidden="true"></i></button>
                                </div>
                                @else
                                <div>
                                    <button href="" id="btn-add-row" type="button" class="btn btn-success btn-sm" style="margin-top: 2em" ><i class="fa fa-plus" style="width: 20px" aria-hidden="true"></i></button>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              @endforeach
            </div>
            <input type="hidden" id="gambar_blog" value="{{ $gambar_blog }}">
            <input type="hidden" id="gambar_blog_delete" name="gambar_blog_delete" value="">
            <input type="hidden" id="gambar_blog_edit" name="gambar_blog_edit" value="">
          </div>
          <div class="col-lg-12 d-flex justify-content-end" >
            <button type="submit" class="btn btn-success"> Simpan </button>
          </div>
      </div>
    </form>
  </div>
@endsection

@section('js-content')
<script>
  $(document).ready(function () {
    var gambar_blogs = $('#gambar_blog').val().split(',');
    console.log(gambar_blogs);
      // Tambah Baris Baru

      $('#btn-add-row').click(function () {
        addRow()
      });

      $('.input-file-gambar').on('change', function (e) {
        var gambar_blog_edit = $('#gambar_blog_edit').val();
        if (gambar_blog_edit != "") {
          gambar_blog_edit += ',';
        }
          gambar_blog_edit += $(this).data('id')
        $('#gambar_blog_edit').val(gambar_blog_edit);
      })

      // Hapus Baris
      $('#body-gambar').on('click', '.btn-hapus-row', function () {
          var gambar_blog_delete = $('#gambar_blog_delete').val();
          if (gambar_blog_delete != "") {
            gambar_blog_delete += ',';
          }
            gambar_blog_delete += $(this).data('id')
          $('#gambar_blog_delete').val(gambar_blog_delete);
          $('#pembungkus-'+$(this).data('key')).remove();
      });
  });

  function addRow() {
    var jumlah = $('input[type="file"]');
    var newRow = `
    <div id="pembungkus-${jumlah.length + 1}" class="card">
      <div class="card-body" id="wrapper-variant">
        <div class="col-lg-12" id="body-variant">
            <div class="row" >
                <div class="col-lg-11">
                  <label class="form-label">Gambar</label>
                  <input type="file" name="img[]" class="form-control form-control-sm" value="" multiple>
                </div>
                <div class="col-lg-1">
                    <button data-key="${jumlah.length + 1}" type="button" class="btn btn-sm btn-danger btn-hapus-row-new" style="margin-top: 2em" ><i class="fa fa-trash-o" style="width: 20px" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
      </div>
    </div>
      `
      $('#body-gambar').append(newRow);
      $('#body-gambar').on('click', '.btn-hapus-row-new', function () {
          $('#pembungkus-'+$(this).data('key')).remove();
      });
  }
</script>
@endsection
