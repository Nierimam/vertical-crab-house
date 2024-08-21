
<footer class="ec-footer">
        <div class="footer-container">
            <div class="footer-offer">
                <div class="container">
                    <div class="row">
                        <div class="text-center footer-off-msg">
                            <span>Belanja sekarang dan dapatkan </span><span class="footer-off-text" style="background-color: #ffffff;color: #cc2514">Penawaran Menarik</span><span class="ml-2">-</span><a href="{{ route('shop.user') }}">Belanja</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-top section-space-footer-p">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-lg-4 ec-footer-contact">
                            <div class="ec-footer-widget">
                                <div class="ec-footer-logo">
                                  <a href="{{ route('home') }}"><img src="{{ asset('upload/'.$companyMiddleware->logo) }}"
                                          alt="Site Logo" style="max-width: 100px" /><img class="dark-logo"
                                          src="{{ asset('upload/'.$companyMiddleware->logo) }}" alt="Site Logo"
                                          style="display: none;max-width: 100px"  /></a>
                                </div>
                                <h4 class="ec-footer-heading">Location</h4>
                                <div class="ec-footer-links">
                                    <ul class="align-items-center">
                                        <li class="ec-footer-link">{{ $companyMiddleware->alamat }}</li>
                                    </ul>
                                    <div class="col-sm-12 col-lg-3 ec-footer-social">
                                        <div class="ec-footer-widget">
                                            <div class="ec-footer-links">
                                                <ul class="align-items-center">
                                                  @if(!empty($companyMiddleware->instagram))
                                                    <li class="list-inline-item"><a href="{{ $companyMiddleware->instagram }}"><i class="ecicon eci-instagram"></i></a>
                                                    </li>
                                                  @endif

                                                  @if(!empty($companyMiddleware->facebook))
                                                    <li class="list-inline-item"><a href="{{ $companyMiddleware->facebook }}"><i class="ecicon eci-facebook"></i></a>
                                                    </li>
                                                  @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-4 ec-footer-account">
                            <div class="ec-footer-widget">
                                <h4 class="ec-footer-heading">Navigation</h4>
                                <div class="ec-footer-links">
                                    <ul class="align-items-center">
                                        <li class="ec-footer-link"><a href="{{ route('home') }}">Beranda</a></li>
                                        <li class="ec-footer-link"><a href="{{ route('shop.user') }}">Belanja</a></li>
                                        <li class="ec-footer-link"><a href="{{ route('blog') }}">Blog</a></li>
                                        <li class="ec-footer-link"><a href="{{ route('company-setting') }}">Tentang</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-4 ec-footer-news">
                            <div class="ec-footer-widget">
                                <h4 class="ec-footer-heading">Newsletter</h4>
                                <div class="ec-footer-links">
                                    <ul class="align-items-center">
                                        <li class="ec-footer-link">Dapatkan pembaruan instan tentang produk baru kami dan
                                            promo spesial!</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <!-- Footer Copyright Start -->
                        <div class="col footer-copy">
                            <div class="footer-bottom-copy ">
                                <div class="ec-copy">Copyright © 2024 <a class="site-name text-upper"
                                        href="{{ route('home') }}">Vertical Crab House</a>. All Rights Reserved</div>
                            </div>
                        </div>
                        <!-- Footer Copyright End -->
                        <!-- Footer payment -->
                        {{-- <div class="col footer-bottom-right">
                            <div class="footer-bottom-payment d-flex justify-content-end">
                                <div class="payment-link">
                                    <img src="{{ asset('assets/images/icons/payment.png') }}" alt="">
                                </div>

                            </div>
                        </div> --}}
                        <!-- Footer payment -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
