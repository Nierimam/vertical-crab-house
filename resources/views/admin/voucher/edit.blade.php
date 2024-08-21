@extends('admin.layouts.app')

@section('title')
    Voucher
@endsection

@section('content')
  <div class="">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="text-lg font-medium truncate">Ubah Data Voucher</h2>
        <div class="intro-y col-span-12 flex justify-between flex-wrap sm:flex-no-wrap items-center">
            <a href="{{route('voucher.index')}}" class="btn btn-secondary"> Kembali </a>
        </div>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
        <form action="{{ route('voucher.update',$voucher->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <div class="col-lg-12">
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <label class="form-label">Nama Voucher</label>
                        <input type="text" name="nama" class="form-control form-control-sm" placeholder="Masukkan nama voucher" value="{{ $voucher->nama }}" required >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label class="form-label">Tipe Voucher</label>
                        <select type="text" name="type" class="form-control form-control-sm" value="" required id="select-type">
                            <option value="" selected disabled>Pilih Tipe Voucher</option>
                            <option value="persentase"  {{$voucher->type == 'persentase' ? 'selected' : ''}}>Persentase</option>
                            <option value="nominal" {{$voucher->type == 'nominal' ? 'selected' : ''}} >Nominal</option>
                        </select>
                    </div>
                    <div class="col-lg-6" id="persentaseBody">
                        <div>
                            <label class="form-label">Persentase</label>
                            <input type="text" name="persentase" class="form-control form-control-sm" placeholder="Masukkan persentase voucher" value="{{ $voucher->persentase }}" required >
                        </div>
                    </div>
                    <div class="col-lg-6 d-none" id="nominalBody">
                        <div>
                            <label class="form-label">Nominal</label>
                            <input type="text" name="nominal" class="form-control form-control-sm" placeholder="Masukkan nominal voucher" value="{{ $voucher->nominal }}" required >
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-8">
                        <label class="form-label">Tanggal hangus voucher</label>
                        <input type="date" name="berlaku_sampai" class="form-control form-control-sm" placeholder="Masukkan tanggal berlaku voucher" value="{{ date('Y-m-d',strtotime($voucher->berlaku_sampai)) }}" required>
                    </div>
                    <div class="col-lg-4">
                        <label class="form-label">Jumlah</label>
                        <input type="text" name="jumlah" class="form-control form-control-sm" placeholder="Masukkan jumlah voucher" value="{{ $voucher->jumlah }}" required >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <label class="form-label" for="">Gambar Voucher</label>
                        <input type="file" name="gambar_voucher" class="form-control form-control-sm bg-white" placeholder="Masukkan jumlah voucher" value="" >
                        <div class="mt-4">
                            <a class="input-group-text fancybox btn btn-primary" id="basic-addon2" data-caption="{{$voucher->nama}}" href="{{asset('upload/'.$voucher->gambar_voucher)}}">Lihat Gambar</a>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <label class="form-label" for="">Deskripsi</label>
                        <textarea type="text" name="deskripsi" class="form-control form-control-sm" rows="5" placeholder="Masukkan jumlah voucher" value="" required >{{ $voucher->deskripsi }}</textarea>
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
        var dataVoucher = {!! json_encode($voucher) !!};
        var selectedType = dataVoucher.type;
        if (selectedType == 'persentase') {
            $('#persentaseBody').removeClass('d-none');
            $('#nominalBody').addClass('d-none');
        }else{
            $('#persentaseBody').addClass('d-none');
            $('#nominalBody').removeClass('d-none');
        }

        $('#select-type').change(function(){
            var selectOption = $(this).val();
            if (selectOption == 'persentase') {
                $('#persentaseBody').removeClass('d-none');
                $('#nominalBody').addClass('d-none');
            } else if (selectOption == 'nominal') {
                $('#persentaseBody').addClass('d-none');
                $('#nominalBody').removeClass('d-none');
            }
        })
    })
  </script>
@endsection
