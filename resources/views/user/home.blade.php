@extends('user.layouts.app')

@section('content')
 <!-- Main Slider Start -->
 <div class="ec-main-slider section section-space-mb">
    <div class="ec-slider">
        <div class="ec-slide-item d-flex slide-1" style="background-image: url({{ asset('img/Page-1.png') }}) !important">
            <img src="" class="main_banner_arrow_img" alt="" />
            <div class="container align-self-center">
                <div class="row">
                    <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                        <div class="ec-slide-content slider-animation">
                            <h1 class="ec-slide-title">Vertical Crab House</h1>
                            <p>Penuhi Segala Kebutuhan Kepiting Kamu Dengan Harga Dan Kualitas Yang Terjamin Sangat Baik</p>
                        </div>
                        <div class="btn-selengkapnya-home">
                            <a href="{{ route('shop.user') }}" class="btn btn-lg btn-primary" style="background-color: #cc2514 !important">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ec-slide-item d-flex slide-2" style="background-image: url({{ asset('img/Page-2.png') }})">
            <img src="" class="main_banner_arrow_img" alt="" />
            <div class="container align-self-center">
                <div class="row">
                    <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                        <div class="ec-slide-content slider-animation">
                            <h1 class="ec-slide-title">Vertical Crab House</h1>
                            <p>Kepiting Yang Di Panen Langung Dengan Nelayan Tetap Menjaga Kualitasnya</p>
                        </div>
                        <div class="btn-selengkapnya-home">
                            <a href="{{ route('shop.user') }}" class="btn btn-lg btn-primary" style="background-color: #cc2514 !important">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ec-slide-item d-flex slide-3" style="background-image: url({{ asset('img/Page-3.png') }})">
            <img src="" class="main_banner_arrow_img" alt="" />
            <div class="container align-self-center">
                <div class="row">
                    <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                        <div class="ec-slide-content slider-animation">
                            <h1 class="ec-slide-title">Vertical Crab House</h1>
                            <p>Pelayanan Dalam Mengelola Kepiting Terbaik Sehingga Tetap Fresh</p>
                        </div>
                        <div class="btn-selengkapnya-home">
                            <a href="{{ route('shop.user') }}" class="btn btn-lg btn-primary" style="background-color: #cc2514 !important">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Slider End -->


<!--  services Section Start -->
<section class="section ec-services-section section-space-p">
    <h2 class="d-none">Services</h2>
    <div class="container">
        <div class="row mb-minus-30">
            <div class="ec_ser_content ec_ser_content_1 col-sm-12 col-md-4">
                <div class="ec_ser_inner">
                    <div class="ec-service-image">
                        <img src="assets/images/icons/service_1.svg" class="svg_img" alt="" />
                    </div>
                    <div class="ec-service-desc">
                        <h2>Unlimited Delivery</h2>
                        <p>Tidak ada lagi batasan dalam pengiriman!</p>
                    </div>
                </div>
            </div>
            <div class="ec_ser_content ec_ser_content_2 col-sm-12 col-md-4">
                <div class="ec_ser_inner">
                    <div class="ec-service-image">
                        <img src="assets/images/icons/service_3.svg" class="svg_img" alt="" />
                    </div>
                    <div class="ec-service-desc">
                        <h2>Free Returns</h2>
                        <p>Nikmati kemudahan berbelanja dengan kebijakan pengembalian gratis kami.</p>
                    </div>
                </div>
            </div>
            <div class="ec_ser_content ec_ser_content_3 col-sm-12 col-md-4">
                <div class="ec_ser_inner">
                    <div class="ec-service-image">
                        <img src="assets/images/icons/service_2.svg" class="svg_img" alt="" />
                    </div>
                    <div class="ec-service-desc">
                        <h2>24/7 Support</h2>
                        <p>Kami selalu siap membantu Anda kapan saja, di mana saja.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--services Section End -->

<!-- Product tab Area Start -->
<section class="section ec-product-tab section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-md-12 section-title-block">
                <div class="section-title">
                    <h2 class="ec-title">Produk</h2>
                    <p class="sub-title">Dapatkan produk menarik dari kami</p>
                </div>
                <div class="section-btn">
                    <ul class="ec-pro-tab-nav nav">
                        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                                href="#tab-pro-new-arrivals">Produk Terbaru</a></li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col">
                <div class="tab-content">
                    <!-- 1st Product tab start -->
                    <div class="tab-pane fade show active" id="tab-pro-new-arrivals">
                        <div class="row">
                            <div class="ec-pro-tab-slider">
                                @foreach($produks as $produk)
                                    @if ($produk->status == 'publish' && $produk->isConfirm == true)
                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 ec-product-content">
                                            <div class="ec-product-inner">
                                                <div class="ec-pro-image-outer">
                                                    <div class="ec-pro-image">
                                                        <a href="" class="image">
                                                            <img class="main-image"
                                                                src="{{asset('upload/'.$produk->produk_variants[0]->img)}}"
                                                                alt="Product" width="450" height="250" />
                                                            <img class="hover-image"
                                                                src="{{asset('upload/'.$produk->produk_variants[0]->img)}}"
                                                                alt="Product" width="450" height="250" />
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

<!--  offer Section Start -->
<section class="section ec-offer-section section-space-mt section-space-mb" style="background-image: url('{{ asset('img/Page-4.png') }}');background-size: cover;background-repeat: no-repeat;background-position: center;">
    <div class="container">
        <div class="row">
            <div class="ec-offer-inner" style="justify-content: flex-start !important">
                <div class="col-sm-4 ec-offer-content">
                    <h2 class="ec-offer-stitle text-white">Dapatkan</h2>
                    <h2 class="ec-offer-title">10% Disc</h2>
                    <span class="ec-offer-desc text-white">Bersyarat</span>
                    <span class="ec-offer-btn"><a href="{{ route('shop.user') }}" class="btn btn-lg btn-primary" style="background-color: #cc2514 !important">Belanja Sekarang</a></span>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- offer Section End -->

<!-- Ec Blog page -->
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="ec-blogs-rightside col-lg-12 col-md-12">

                <!-- Blog content Start -->
                <div class="ec-blogs-content">
                    <div class="ec-blogs-inner">
                        <div class="row">
                            @foreach($blogs as $blog)
                                @if($blog->status == 'publish')
                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-6 ec-blog-block">
                                        <div class="ec-blog-inner">
                                            <div class="ec-blog-image">
                                                <a href="blog-detail-left-sidebar.html">
                                                    <img class="blog-image" src="{{ 'upload/'.$blog->blog_medias[0]->media }}"
                                                        alt="Blog" />
                                                </a>
                                            </div>
                                            <div class="ec-blog-content">
                                                <h5 class="ec-blog-title"><a
                                                        href="blog-detail-left-sidebar.html">{{ $blog->judul }}</a></h5>

                                                <div class="ec-blog-date">By <span>Admin</span> / {{ date('d M Y', strtotime($blog->created_at)) }}</div>
                                                <div class="ec-blog-desc">
                                                    @if (strlen($blog->deskripsi) > 100)
                                                        {{ substr($blog->deskripsi, 0, 100) }}...
                                                    @else
                                                        {{ $blog->deskripsi }}
                                                    @endif
                                                </div>

                                                <div class="ec-blog-btn"><a href="{{ route('blog-detail',$blog->id) }}" class="btn btn-primary">Selengkapnya</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <!--Blog content End -->
            </div>
        </div>
    </div>
</section>


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
                                                        <select name="" id="ukuran_cart_{{ $key }}" class="form form-control"
                                                            style="border: 1px solid #eeeeee !important">
                                                            <option value="" selected>Pilih Variant</option>
                                                            @foreach ($produk->produk_variants as $produk_variant)
                                                                @if ($produk_variant->stok > 0)
                                                                    <option value="{{ $produk_variant->id }}"
                                                                        data-harga="{{ $produk_variant->price }}"
                                                                        data-stok="{{ $produk_variant->stok }}">{{ $produk_variant->nama_variant }} - {{ $produk_variant->stok }}</option>
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
                                                <div class="mt-3">
                                                    <select name="" class="form form-control" style="border: 1px solid #eeeeee !important" disabled>
                                                        <option value="" selected>Pilih Variant (Login untuk memilih)</option>
                                                        @foreach ($produk->produk_variants as $produk_variant)
                                                            @if ($produk_variant->stok > 0)
                                                                <option value="">{{ $produk_variant->nama_variant }} - {{ $produk_variant->stok }}</option>
                                                            @else
                                                                <option value=""> {{ $produk_variant->nama_variant }} - Stok Kosong</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
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
    @if (count($vouchers) > 0)
        <script>
            $(document).ready(function () {
                $('#modalVoucher').modal('show');
            })
        </script>
    @endif

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

