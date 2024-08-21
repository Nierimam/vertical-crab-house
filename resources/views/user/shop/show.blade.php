@extends('user.layouts.app')

@section('content')

<div class="bg0 p-t-120 p-b-140">
    <div class="fluid-container">
        <div class="d-flex justify-content-end mx-4 mt-2">
            <a href="{{ route('shop.user') }}" class="btn btn-secondary" >Kembali</a>
        </div>
        <div class="mx-4">
            <div class="row">
                <div class="col-lg-6">

                    <div class="single-pro-img single-pro-img-no-sidebar">
                        <div class="single-product-scroll">
                            <div class="single-product-cover">
                                @foreach($produk->produk_variants as $produk_variant)
                                    <div class="single-slide zoom-image-hover">
                                        <img class="" width="100%" src="{{ asset('upload/'.$produk_variant->img) }}"
                                            alt="">
                                    </div>
                                @endforeach
                            </div>
                            <div class="single-nav-thumb">
                                @foreach($produk->produk_variants as $produk_variant)
                                    <div class="single-slide">
                                        <img class="" width="100%" src="{{ asset('upload/'.$produk_variant->img) }}"
                                            alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div>
                        <h4 style="font-weight: bold;font-size:48px">{{ $produk->nama_produk }}</h4>
                    </div>
                    <div>
                        <h4 style="font-weight: bold;font-size:24px">
                        @if ($produk->type == 'farmer')
                            {{ $produk->farmer->nama_farmer }}
                        @else
                            {{ $produk->merchant->nama_merchant }}
                        @endif
                        </h4>
                    </div>
                    <div class="mt-4">
                        <p style="font-size: 16px">Variant</p>
                        <div>
                            @if (auth()->user())
                            @if ($produk->produk_variants->where('stok', '>', 0)->count() > 0)
                                <div class="mt-3">
                                    <select name="" id="ukuran_cart_{{ $produk->id }}" class="form form-control border">
                                        <option value="" selected>Pilih Variant</option>
                                        @foreach ($produk->produk_variants as $produk_variant)
                                            @if ($produk_variant->stok > 0)
                                                <option value="{{ $produk_variant->id }}" data-stok="{{ $produk_variant->stok }}">{{ $produk_variant->nama_variant }} - {{ $produk_variant->stok }} - Rp. {{ number_format($produk_variant->price) }}</option>
                                            @else
                                                <div class="mt-3">
                                                    <p><span style="color: #6c7ae0">{{ $produk_variant->nama_variant }}</span> - Stok Kosong</p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                @else
                                    @foreach ($produk->produk_variants as $produk_variant)
                                        <div class="mt-3">
                                            <p><span style="color: #6c7ae0">{{ $produk_variant->nama_variant }}</span> - Stok Kosong</p>
                                        </div>
                                    @endforeach
                                @endif
                                @if (auth()->user())
                                    @if ($produk->produk_variants->where('stok', '>', 0)->count() > 0)
                                        <div class="row d-flex align-content-center align-items-center">
                                            <div class="col-lg-6">
                                                <div class="mt-3">
                                                    <input type="text" class="form form-control" placeholder="Masukkan Jumlah" id="jumlah_cart_{{ $produk->id }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mt-3">
                                                    <button class="btn text-light add-to-cart" style="background-color: #cc2145;border-radius:20px" data-produk_id="{{ $produk->id }}" data-key="{{ $produk->id }}">Tambah Ke Keranjang</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @else
                                @foreach ($produk->produk_variants as $produk_variant)
                                    @if ($produk_variant->stok > 0)
                                        <div class="mt-3">
                                            <p><span style="color: #6c7ae0">{{ $produk_variant->nama_variant }}</span> - {{ $produk_variant->stok }}</p>
                                        </div>
                                    @else
                                        <div class="mt-3">
                                            <p><span style="color: #6c7ae0">{{ $produk_variant->nama_variant }}</span> - Stok Kosong</p>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="mt-4">
                        <p style="font-size: 16px">Deskripsi</p>
                        <div class="card">
                            <div class="card-body">
                                <p>{{ $produk->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 72px">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @foreach ($produk_ratings as $produk_rating)
                                <div>
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="{{ !empty($produk_rating->orders->customers->img_profile) ? asset('upload/'.$produk_rating->orders->customers->img_profile) : asset('assets/no-image.png') }}" width="36px" height="36px" style="border-radius: 20px" alt="">
                                        <p class="mt-3 ml-2">{{$produk_rating->orders->customers->nama_lengkap}}</p>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div>
                                                <p class="">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @php
                                                            $rating = !empty($produk_rating->rating) ? $produk_rating->rating : 0;
                                                            $text_star = '';
                                                            if ($i <= $rating) {
                                                                $text_star = 'text-warning';
                                                            }
                                                        @endphp
                                                        <i class="fas fa-star {{$text_star}}"></i>
                                                    @endfor
                                                </p>
                                                <p class="">Varian :  <b>{{$produk_rating->produk_variants->nama_variant}}</b> </p>
                                                @if (!empty($produk_rating->media))
                                                    <a class="fancybox" id="basic-addon2" data-caption="{{$produk_rating->produk_variants->nama_variant}}" href="{{asset('upload/'.$produk_rating->media)}}">
                                                        <img src="{{asset('upload/'.$produk_rating->media)}}"  width="144px" alt="">
                                                    </a>
                                                @endif
                                                <p class="mt-3">{{ $produk_rating->review }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
