<header class="ec-header">
    <!--Ec Header Top Start -->
    <div class="header-top">
        <div class="container">
            <div class="row align-items-center">
                <!-- Header Top phone Start -->
                <div class="col header-top-left">
                    <div class="header-top-call">
                        <img src="{{ asset('assets/images/icons/top-call.svg') }}" class="svg_img top_svg"
                            alt="" /> Phone:
                        <a href="tel:{{ $companyMiddleware->telp }}"> {{ $companyMiddleware->telp }}</a>
                    </div>
                </div>
                <!-- Header Top phone End -->
                <!-- Header Top call End -->
                <!-- Header Top Language Currency -->
                <div class="col header-top-right d-none d-lg-block">
                    <div class="header-top-right-inner d-flex justify-content-end">
                        <!-- Social Start -->
                        <div class="header-top-social">
                            <ul class="mb-0">
                                @if (!empty($companyMiddleware->instagram))
                                    <li class="list-inline-item"><a href="{{ $companyMiddleware->instagram }}"><i
                                                class="ecicon eci-instagram"></i></a>
                                    </li>
                                @endif

                                @if (!empty($companyMiddleware->facebook))
                                    <li class="list-inline-item"><a href="{{ $companyMiddleware->facebook }}"><i
                                                class="ecicon eci-facebook"></i></a>
                                    </li>
                                @endif
                                </li>
                            </ul>
                        </div>
                        <!-- Social End -->
                    </div>
                </div>
                <!-- Header Top Language Currency -->
                <!-- Header Top responsive Action -->
                <div class="col header-top-res d-lg-none">
                    <div class="ec-header-bottons">
                        <!-- Header User Start -->
                        <div class="ec-header-user dropdown">
                            <button class="dropdown-toggle" data-bs-toggle="dropdown"><img
                                    src="{{ asset('assets/images/icons/user.svg') }}" class="svg_img header_svg"
                                    alt="" /></button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                @if (auth()->user())
                                    <li><a class="dropdown-item" href="{{ route('profile.user') }}">Akun</a></li>
                                    <li><a class="dropdown-item" href="{{ route('listorder.user') }}">Pembelian</a></li>
                                    <li><a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                @else
                                    <li><a class="dropdown-item" href="{{ route('form.register.user') }}">Daftar</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('form.login.user') }}">Login</a></li>
                                @endif
                            </ul>
                        </div>
                        <!-- Header User End -->
                        <!-- Header Cart Start -->
                        <a href="#ec-side-cart" class="ec-header-btn ec-side-toggle">
                            <div class="header-icon"><img src="{{ asset('assets/images/icons/pro_cart.svg') }}"
                                    class="svg_img header_svg" alt="" /></div>
                            <span class="ec-header-count ec-cart-count" id="cart-notif">0</span>
                        </a>
                        <!-- Header Cart End -->
                        <!-- Header menu Start -->
                        <a href="#ec-mobile-menu" class="ec-header-btn ec-side-toggle ec-d-l d-lg-none">
                            <i class="ecicon eci-bars"></i>
                        </a>
                        <!-- Header menu End -->
                    </div>
                </div>
                <!-- Header Top responsive Action -->
            </div>
        </div>
    </div>
    <!-- Ec Header Top  End -->
    <!-- Ec Header Bottom  Start -->
    <div class="ec-header-bottom d-none d-lg-block">
        <div class="container position-relative">
            <div class="row">
                <div class="header-bottom-flex">
                    <!-- Ec Header Logo Start -->
                    <div class="align-self-center ec-header-logo ">
                        <div class="header-logo">
                            <a href="{{ route('home') }}"><img src="{{ asset('upload/' . $companyMiddleware->logo) }}"
                                    alt="Site Logo" style="max-width: 100px" /><img class="dark-logo"
                                    src="{{ asset('upload/' . $companyMiddleware->logo) }}" alt="Site Logo"
                                    style="display: none;max-width: 100px" /></a>
                        </div>
                    </div>
                    <!-- Ec Header Logo End -->

                    <!-- Ec Header Search Start -->
                    <div class="align-self-center ec-header-search">
                        <div class="header-search">
                            <form class="ec-search-group-form" action="{{ route('shop.user') }}">
                                {{-- <div class="ec-search-select-inner">
                                    <select name="ec-search-cat">
                                        <option selected disabled>All</option>
                                        @foreach ($categoriesMiddleware as $category)
                                          <option value="{{ $category->id }}" {{ isset($kategori) && !empty($kategori) ? ( $category->id == $kategori ? 'selected' : '' ) : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <input class="form-control" placeholder="I’m searching for..." name="search"
                                    type="text" value="{{ $search ?? '' }}">
                                <button class="search_submit" type="submit">Search <img
                                        src="{{ asset('assets/images/icons/search.svg') }}" class="svg_img search_svg"
                                        alt="" /></button>
                            </form>
                        </div>
                    </div>
                    <!-- Ec Header Search End -->

                    <!-- Ec Header Button Start -->
                    <div class="align-self-center ec-header-cart">
                        <div class="ec-header-bottons">
                            <!-- Header User Start -->
                            <div class="ec-header-user dropdown">
                                <button class="dropdown-toggle" data-bs-toggle="dropdown"><img
                                        src="{{ asset('assets/images/icons/user.svg') }}" class="svg_img header_svg"
                                        alt="" /><span
                                        class="ec-btn-title">{{ auth()->user() ? auth()->user()->username : 'Login/Daftar' }}</span></button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    @if (auth()->user())
                                        <li><a class="dropdown-item" href="{{ route('profile.user') }}">Akun</a></li>
                                        <li><a class="dropdown-item" href="{{ route('listorder.user') }}">Pembelian</a></li>
                                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Logout</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    @else
                                        <li><a class="dropdown-item" href="{{ route('form.login.user') }}">Login</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                href="{{ route('form.register.user') }}">Daftar</a></li>
                                    @endif
                                </ul>
                            </div>
                            <!-- Header User End -->
                            <!-- Header Cart Start -->
                            <a href="#ec-side-cart" class="ec-header-btn ec-side-toggle">
                                <div class="header-icon"><img src="{{ asset('assets/images/icons/cart.svg') }}"
                                        class="svg_img header_svg" alt="" /></div>
                                <span class="ec-header-count ec-cart-count" id="cart-notif-2">0</span><span
                                    class="ec-btn-title">In
                                    Cart</span>
                            </a>
                            <!-- Header Cart End -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Ec Header Button End -->
    <!-- Header responsive Bottom  Start -->
    <div class="ec-header-bottom d-lg-none">
        <div class="container position-relative">
            <div class="row ">

                <!-- Ec Header Logo Start -->
                <div class="col">
                    <div class="header-logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('upload/' . $companyMiddleware->logo) }}"
                                alt="Site Logo" style="max-width: 100px;" /><img class="dark-logo"
                                src="{{ asset('upload/' . $companyMiddleware->logo) }}" alt="Site Logo"
                                style="display: none;max-width: 100px;" /></a>
                    </div>
                </div>
                <!-- Ec Header Logo End -->
                <!-- Ec Header Search Start -->
                <div class="col align-self-center ec-header-search">
                    <div class="header-search">
                        <form class="ec-search-group-form" action="{{ route('shop.user') }}">
                            {{-- <div class="ec-search-select-inner">
                                <select name="ec-search-cat">
                                    <option selected disabled>All</option>
                                    @foreach ($categoriesMiddleware as $category)
                                      <option value="{{ $category->id }}" {{ isset($kategori) && !empty($kategori) ? ( $category->id == $kategori ? 'selected' : '' ) : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <input class="form-control" name="search" placeholder="I’m searching for..."
                                type="text" value="{{ $search ?? '' }}">
                            <button class="search_submit" type="submit"><img
                                    src="{{ asset('assets/images/icons/search.svg') }}" class="svg_img search_svg"
                                    alt="" /></button>
                        </form>
                    </div>
                </div>
                <!-- Ec Header Search End -->
            </div>
        </div>
    </div>
    <!-- Header responsive Bottom  End -->
    <!-- EC Main Menu Start -->
    <div id="ec-main-menu-desk" class="sticky-nav" style="background-color: white;border-top: 1px solid #cc2145">
        <div class="container position-relative">
            <div class="row">
                <div class="col-sm-2 ec-category-block">
                    <div class="ec-category-menu">
                        <div class="ec-category-toggle" style="background-color: #da7168"><span
                                class="ec-category-title">Belanja</span><i class="ecicon eci-angle-down"
                                aria-hidden="true"></i>
                        </div>
                        <div class="ec-category-content">
                            <div id="ec-category-menu" class="ec-category-menu">
                                <ul class="ec-category-wrapper">
                                    <li><a title="" class="ec-cat-menu-link"
                                            href="{{ route('shop.user', ['type' => 'farmer']) }}">Kepiting</a></li>
                                    <li><a title="" class="ec-cat-menu-link"
                                            href="{{ route('shop.user', ['type' => 'merchant']) }}">Supply</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 ec-main-menu-block align-self-center d-none d-lg-block">
                    <div class="ec-main-menu">
                        <ul>
                            <li class="{{ request()->is('/') ? 'active' : '' }}"><a
                                    href="{{ route('home') }}">Beranda</a></li>
                            {{-- <li class="{{ request()->is('semua-produk') ? 'active' : '' }}"><a href="{{ route('shop.user') }}">Belanja</a></li> --}}
                            <li class="{{ request()->is('blog') ? 'active' : '' }}"><a
                                    href="{{ route('blog') }}">Blog</a></li>
                            <li class="{{ request()->is('company-profile') ? 'active' : '' }}"><a
                                    href="{{ route('company-setting') }}">Tentang</a></li>
                            @if (auth()->user())
                                @if (auth()->user()->role == 'merchant' || auth()->user()->role == 'user')
                                    <li class="{{ request()->is('merchant-user') ? 'active' : '' }}"><a
                                            href="{{ route('merchant-user') }}">Merchant</a></li>
                                @endif
                                @if (auth()->user()->role == 'farmer' || auth()->user()->role == 'user')
                                    <li class="{{ request()->is('farmer-user') ? 'active' : '' }}"><a
                                            href="{{ route('farmer-user') }}">Farmer</a></li>
                                @endif
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec Main Menu End -->
    <!-- Ekka Menu Start -->
    <div id="ec-mobile-menu" class="ec-side-cart ec-mobile-menu">
        <div class="ec-menu-title">
            <span class="menu_title">Menu</span>
            <button class="ec-close">×</button>
        </div>
        <div class="ec-menu-inner">
            <div class="ec-menu-content">
                <ul>
                    <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ route('home') }}">Beranda</a>
                    </li>
                    {{-- <li class="{{ request()->is('semua-produk') ? 'active' : '' }}"><a href="{{ route('shop.user') }}">Belanja</a></li> --}}
                    <li class="{{ request()->is('blog') ? 'active' : '' }}"><a href="{{ route('blog') }}">Blog</a>
                    </li>
                    <li class="{{ request()->is('company-profile') ? 'active' : '' }}"><a
                            href="{{ route('company-setting') }}">Tentang</a></li>
                    @if (auth()->user())
                        @if (auth()->user()->role == 'merchant' || auth()->user()->role == 'user')
                            <li class="{{ request()->is('merchant-user') ? 'active' : '' }}"><a
                                    href="{{ route('merchant-user') }}">Merchant</a></li>
                        @endif
                        @if (auth()->user()->role == 'farmer' || auth()->user()->role == 'user')
                            <li class="{{ request()->is('farmer-user') ? 'active' : '' }}"><a
                                    href="{{ route('farmer-user') }}">Farmer</a></li>
                        @endif
                    @endif
                </ul>
            </div>
            <div class="header-res-lan-curr">
                <!-- Social Start -->
                <div class="header-res-social">
                    <div class="header-top-social">
                        <ul class="mb-0">
                            @if (!empty($companyMiddleware->instagram))
                                <li class="list-inline-item"><a href="{{ $companyMiddleware->instagram }}"><i
                                            class="ecicon eci-instagram"></i></a>
                                </li>
                            @endif

                            @if (!empty($companyMiddleware->facebook))
                                <li class="list-inline-item"><a href="{{ $companyMiddleware->facebook }}"><i
                                            class="ecicon eci-facebook"></i></a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <!-- Social End -->
            </div>
        </div>
    </div>
    <!-- Ekka Menu End -->
</header>
<!-- Header End  -->

<!-- Ekka Cart Start -->
<div class="ec-side-cart-overlay"></div>
<div id="ec-side-cart" class="ec-side-cart">
    <div class="ec-cart-inner">
        <div class="ec-cart-top">
            <div class="ec-cart-title">
                <span class="cart_title">Cart</span>
                <button class="ec-close">×</button>
            </div>
            <ul class="eccart-pro-items" id="body-cart">

            </ul>
        </div>
        <div class="ec-cart-bottom">
            <div class="cart-sub-total">
                <table class="table cart-table">
                    <tbody>
                        <tr>
                            <td class="text-left">Total :</td>
                            <td class="text-right primary-color" id="total_produk">0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="header-cart-buttons flex-w w-full justify-content-center">
                <a href="{{ route('detail-cart') }}"
                    class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10 btn btn-primary text-white "
                    style="text-decoration: none">
                    Lihat Keranjang
                </a>
            </div>
            <div class="cart_btn">
            </div>
        </div>
    </div>
</div>
<!-- Ekka Cart End -->

{{-- @section('js-content')
<script>
    $('#select_produk').on('change', function () {
        var selectedProduk = $('#select_produk').val();

        var url = "{{ route('shop.user') }}?type=" + selectedProduk;

        window.location.href = url;
    });
</script>
@endsection --}}
