@extends('user.layouts.app')

@section('content')

<!-- Product tab Area Start -->
<section class="section ec-product-tab section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-md-12 section-title-block">
                <div class="section-title">
                    <h2 class="ec-title">Produk</h2>
                    <p class="sub-title">Dapatkan produk menarik dari kami</p>
                </div>
                {{-- <div class="section-btn">
                    <ul class="ec-pro-tab-nav nav">
                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="{{ route('shop.user')}}">Semua Produk</a></li>
                    </ul>
                </div> --}}
            </div>

        </div>
        <div class="row">
            <div class="col">
                <div class="tab-content">
                    <!-- 1st Product tab start -->
                    <div class="tab-pane fade show active" id="tab-pro-new-arrivals">
                        <div class="row">
                            <div class="ec-pro-tab-slider">
                                @if (count($produks) > 0)
                                    @foreach($produks as $produk)
                                        @if ($produk->status == 'publish' && $produk->isConfirm == true)
                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                                <div class="ec-product-inner">
                                                    <div class="ec-pro-image-outer">
                                                        <div class="ec-pro-image">
                                                            <a href="" class="image">
                                                                <img class="main-image"
                                                                    src="{{asset('upload/'.$produk->produk_variants[0]->img)}}"
                                                                    alt="Product" width="100%" />
                                                                <img class="hover-image"
                                                                    src="{{asset('upload/'.$produk->produk_variants[0]->img)}}"
                                                                    alt="Product" width="100%" />
                                                            </a>
                                                            <div class="ec-pro-actions">
                                                                <a href="#" class="ec-btn-group quickview"
                                                                    data-link-action="quickview" title="Quick view"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#ec_quickview_modal{{$produk->id}}">
                                                                    <img src="{{ asset('assets/images/icons/quickview.svg') }}"
                                                                        class="svg_img pro_svg" alt="" />
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ec-pro-content">
                                                        <h5 class="ec-pro-title"><a href="#">{{ $produk->nama_produk }}</a></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="card">
                                            <div class="card-body" style="padding-top: 5rem;padding-bottom:5rem">
                                                <div class="text-center">
                                                    <h1>Tidak Ada Data Produk</h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- ec 1st Product tab end -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ec Product tab Area End -->



@foreach($produks as $key => $produk)
    @if ($produk->status == 'publish' && $produk->isConfirm == true)
        <!-- Modal -->
        <div class="modal fade" id="ec_quickview_modal{{$produk->id}}" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="btn-close qty_close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5 col-sm-12 col-xs-12">
                                <!-- Swiper -->
                                <div class="qty-product-cover">
                                    @foreach($produk->produk_variants as $produk_variant)
                                        <div class="qty-slide">
                                            <img class="img-responsive" src="{{asset('upload/'.$produk_variant->img)}}" alt="">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="qty-nav-thumb">
                                    @foreach($produk->produk_variants as $produk_variant)
                                        <div class="qty-slide">
                                            <img class="img-responsive" src="{{asset('upload/'.$produk_variant->img)}}" alt="">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-12 col-xs-12">
                                <div class="quickview-pro-content">
                                    <h5 class="ec-quick-title"><a href="#">{{ $produk->nama_produk }}</a>
                                    </h5>

                                    <div class="ec-quickview-desc">
                                        {{ $produk->deskripsi }}
                                    </div>
                                    <div class="ec-quickview-price">
                                        <span class="new-price" id="price_produk">Pilih Variant Terlebih Dahulu</span>
                                    </div>

                                    <div class="ec-pro-variation">
                                        <div class="ec-pro-variation-inner ec-pro-variation-size ec-pro-size">
                                            <span>Variant</span>
                                            @if (auth()->user())
                                                @if ($produk->produk_variants->where('stok', '>', 0)->count() > 0)
                                                    <div class="mt-3">
                                                        <select name="" id="ukuran_cart_{{ $key }}" class="form form-control" style="border: 1px solid #eeeeee !important">
                                                            <option value="" selected>Pilih Variant</option>
                                                            @foreach ($produk->produk_variants as $produk_variant)
                                                                @if ($produk_variant->stok > 0)
                                                                    <option value="{{ $produk_variant->id }}" data-harga="{{ $produk_variant->price }}" data-stok="{{ $produk_variant->stok }}">{{ $produk_variant->nama_variant }} - {{ $produk_variant->stok }}</option>
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
                                    <div class="ec-quickview-qty">
                                        <div class="qty-plus-minus">
                                            <input class="qty-input" type="text" name="ec_qtybtn" value="1" id="jumlah_cart_{{ $key }}" />
                                        </div>

                                        @if (auth()->user())
                                            <div class="ec-quickview-cart">
                                                <button class="btn btn-primary add-to-cart" data-produk_id="{{ $produk->id }}" data-key="{{ $key }}"><img src="{{ asset('assets/images/icons/cart.svg') }}"
                                                        class="svg_img pro_svg" alt=""  /> Tambah ke Keranjang</button>
                                            </div>
                                        @endif
                                        <a class="btn btn-secondary ml-2" href="{{ route('detail.produk',['id'=>$produk->id,'slug' => $produk->slug]) }}">Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end -->
    @endif
@endforeach
@endsection

@section('js-content')
<script>
    $(document).ready(function(){
        $('select[id^="ukuran_cart_"]').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var harga = selectedOption.data('harga');

            var modalId = $(this).closest('.modal').attr('id');
            $('#' + modalId).find('#price_produk').text('Rp. ' + harga.toLocaleString('id-ID'));
        });
    });
</script>
@endsection
