@extends('admin.layouts.app')

@section('title')
    Produk
@endsection

@section('content')
    <div class="">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="text-lg font-medium truncate">Detail Produk</h2>
            <div class="intro-y col-span-12 flex justify-between flex-wrap sm:flex-no-wrap items-center">
                <a href="{{ route('product.index') }}" class="btn btn-secondary"> Kembali </a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-lg-6">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" id="input-produk" name="nama_produk" class="form-control form-control-sm"
                        placeholder="Masukkan nama produk" value="{{ ucfirst($data->nama_produk) }}" readonly>
                </div>
                <div class="col-lg-6">
                    <label class="form-label">Slug</label>
                    <input type="text" id="slug" name="slug" class="form-control form-control-sm"
                        placeholder="Slug Produk" value="{{ $data->slug }}" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label">Kategori Produk</label>
                    <input type="text" id="kategori" name="category_id" class="form-control form-control-sm"
                        placeholder="Kategori Produk" value="{{ ucfirst($data->categories->name) }}" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label">Keywords</label>
                    <div>
                        @foreach (explode(',', $data->keyword) as $item)
                            <span class="badge bg-info" readonly>{{ ucfirst($item) }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-label">Status Tampil</label>
                    <input type="text" name="status" class="form-control form-control-sm" placeholder="Masukkan status"
                        value="{{ ucfirst($data->status) }}" readonly>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3 class="font-bold text-lg">Data Variant</h3>
                    <div class="" id="wrapper-variant">
                        @foreach ($variant as $variants)
                            <div class="card">
                                <div class="card-body mx-2 my-2" id="body-variant" style="padding: 5px">
                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                            <label class="form-label">Variant Produk </label>
                                            <input type="text" name="status" class="form-control form-control-sm"
                                                placeholder="Masukkan status" value="{{ ucfirst($variants->nama_variant) }}"
                                                readonly>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label">Stok Produk </label>
                                            <input type="text" name="status" class="form-control form-control-sm"
                                                placeholder="Masukkan status" value="{{ ucfirst($variants->stok) }} pcs"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                            <label class="form-label">Harga</label>
                                            <input type="text" required name="price_update[]"
                                                class="form-control form-control-sm input-price-variant"
                                                 placeholder="Harga" readonly
                                                value="Rp. {{ number_format($variants->price, 0, ',', '.') }}">
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="form-label">Berat (gram)</label>
                                            <input type="text" required name="berat_update[]"
                                                class="form-control form-control-sm input-berat-variant"
                                                 placeholder="Berat" readonly
                                                value="{{ $variants->berat }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="">
                                            <label class="form-label" for="">Gambar</label>
                                            <div>
                                                <a class="fancybox" id="basic-addon2"
                                                    data-caption="{{ ucfirst($data->nama_produk) }} - {{ ucfirst($variants->nama_variant) }}"
                                                    href="{{ asset('upload/' . $variants->img) }}">
                                                    <img src="{{ asset('upload/' . $variants->img) }}"
                                                        style="width: 150px; height:150px;" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-12">
                    <label class="form-lable">Deskripsi Produk</label>
                    <textarea type="text" name="deskripsi" rows="5" class="form-control"
                        placeholder="Masukkan deskripsi produk" value="" readonly>{{ ucfirst($data->deskripsi) }}</textarea>
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection
