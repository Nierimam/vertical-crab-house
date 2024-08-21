<!--start sidebar -->

<style>
    .btn-close-sidebar {
        display: none !important;
    }
    @media only screen and (max-width: 475px) {
        .btn-close-sidebar {
            display: block !important;
        }
    }
</style>
<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div class="d-flex align-items-center justify-content-center">
            <div>
                @if (auth()->user()->role == 'admin')
                    <img src="{{ asset('img/user.png') }}" class="logo-icon" alt="logo icon">
                @elseif(auth()->user()->role == 'farmer')
                    <img src="{{ asset('upload/'.auth()->user()->farmer->foto_toko) }}" class="logo-icon" alt="logo icon">
                @else
                    <img src="{{ asset('upload/'.auth()->user()->merchant->foto_toko) }}" class="logo-icon" alt="logo icon">
                @endif
            </div>
            <div>
                <h4 class="logo-text pt-1">
                @if (auth()->user()->role == 'admin')
                    Admin
                @elseif(auth()->user()->role == 'farmer')
                    {{ auth()->user()->farmer->nama_farmer }}
                @elseif(auth()->user()->role == 'merchant')
                    {{ auth()->user()->merchant->nama_merchant }}
                @endif
                </h4>
            </div>
        </div>
        <div class="text-end w-100 btn-close-sidebar">
            <button class="btn btn-secondary" id="btn-close-sidebar" style="background-color: transparent;color:#cc2514;border:0">X</button>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu rounded-2" id="menu">
        @if (auth()->user()->role == 'admin')
            <li>
                <a href="{{ route('dashboard.index') }}"
                    class="top-menu {{ request()->is('/admin/dashboard') ? 'active rounded-2' : '' }}">
                    <div class="parent-icon">
                        <ion-icon name="home"></ion-icon>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon">
                        <ion-icon name="person"></ion-icon>
                    </div>
                    <div class="menu-title">List User</div>
                </a>
                <ul>

                    <li>
                        <a href="{{ route('customer.index') }}"
                            class="top-menu {{ request()->is('/admin/user') ? 'active rounded-2' : '' }}">
                            <ion-icon name="person"></ion-icon>Customer
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('merchant.index') }}"
                            class="top-menu {{ request()->is('/admin/merchant') ? 'active' : '' }}">
                            <ion-icon name="storefront-outline"></ion-icon>Merchant
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('farmer.index') }}"
                            class="top-menu {{ request()->is('/admin/farmer') ? 'active' : '' }}">
                            <ion-icon name="flower-outline"></ion-icon>Farmer
                        </a>
                    </li>

                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon">
                        <ion-icon name="layers"></ion-icon>
                    </div>
                    <div class="menu-title">Produk</div>
                </a>
                <ul>

                    <li>
                        <a href="{{ route('product.index') }}"
                            class="top-menu {{ request()->is('/admin/produk/product') ? 'active' : '' }}">
                            <ion-icon name="ellipse-outline"></ion-icon>Produk
                        </a>
                        {{-- <a href="{{route('kain.create')}}" class="top-menu d-none {{ request()->is('/admin/kain/create') ? 'active' : '' }}"></a> --}}
                    </li>

                    <li>
                        <a href="{{ route('kategori.index') }}"
                            class="top-menu {{ request()->is('/admin/produk/kategori') ? 'active' : '' }}">
                            <ion-icon name="ellipse-outline"></ion-icon>Kategori
                        </a>
                        {{-- <a href="{{route('jenis-kain.create')}}" class="top-menu d-none {{ request()->is('/admin/jenis-kain/create') ? 'active' : '' }}"></a> --}}
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('voucher.index') }}"
                    class="top-menu {{ request()->is('/admin/voucher') ? 'active rounded-2' : '' }}">
                    <div class="parent-icon">
                        <ion-icon name="pricetags"></ion-icon>
                    </div>
                    <div class="menu-title">Voucher</div>
                </a>
            </li>
            <li>
                <a href="{{ route('blog.index') }}"
                    class="top-menu {{ request()->is('/admin/blog') ? 'active rounded-2' : '' }}">
                    <div class="parent-icon">
                        <ion-icon name="newspaper"></ion-icon>
                    </div>
                    <div class="menu-title">Blog</div>
                </a>
            </li>
            <li>
                <a href="{{ route('order.index',['type' => 'merchant']) }}"
                    class="top-menu {{ request()->is('/admin/order') ? 'active rounded-2' : '' }}">
                    <div class="parent-icon">
                        <ion-icon name="book"></ion-icon>
                    </div>
                    <div class="menu-title">Pemesanan Merchant</div>
                </a>
            </li>
            <li>
                <a href="{{ route('order.index',['type' => 'farmer']) }}"
                    class="top-menu {{ request()->is('/admin/order') ? 'active rounded-2' : '' }}">
                    <div class="parent-icon">
                        <ion-icon name="book"></ion-icon>
                    </div>
                    <div class="menu-title">Pemesanan Farmer</div>
                </a>
            </li>
            <li>
                <a href="{{ route('company.edit', 1) }}"
                    class="top-menu {{ request()->is('/admin/company/1') ? 'active rounded-2' : '' }}">
                    <div class="parent-icon">
                        <ion-icon name="construct"></ion-icon>
                    </div>
                    <div class="menu-title">Setting Company</div>
                </a>
            </li>
        @else
            <li>
                <a href="{{ route('dashboard.index') }}"
                    class="top-menu {{ request()->is('/admin/dashboard') ? 'active rounded-2' : '' }}">
                    <div class="parent-icon">
                        <ion-icon name="home"></ion-icon>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            <li>
                <a href="{{ route('product.index') }}"
                    class="top-menu {{ request()->is('/admin/produk/product') ? 'active rounded-2' : '' }}">
                    <div class="parent-icon">
                        <ion-icon name="layers"></ion-icon>
                    </div>
                    <div class="menu-title">Produk</div>
                </a>
            </li>
            <li>
                <a href="{{ route('order.index') }}"
                    class="top-menu {{ request()->is('/admin/order') ? 'active rounded-2' : '' }}">
                    <div class="parent-icon">
                        <ion-icon name="book"></ion-icon>
                    </div>
                    <div class="menu-title">Pemesanan</div>
                </a>
            </li>
        @endif

    </ul>
    <!--end navigation-->
</aside>
<!--end sidebar -->

<!--start top header-->
<header class="top-header">
    <nav class="navbar navbar-expand gap-3">
        <div class="toggle-icon">
            <ion-icon name="menu-outline"></ion-icon>
        </div>
        <div style="margin-top: 6px; color: #cc2514">
            {{-- <h5>@yield('title')</h5> --}}
        </div>
        <form class="searchbar">
            <div class="position-absolute top-50 translate-middle-y search-icon ms-3">
                <ion-icon name="search-outline"></ion-icon>
            </div>
            <input class="form-control" type="text" placeholder="Search for anything">
            <div class="position-absolute top-50 translate-middle-y search-close-icon">
                <ion-icon name="close-outline"></ion-icon>
            </div>
        </form>
        <div class="top-navbar-right ms-auto">

            <ul class="navbar-nav align-items-center">
                {{-- <li class="nav-item">
            <a class="nav-link dark-mode-icon" href="javascript:;" >
              <div class="mode-icon">
                <ion-icon name="moon-outline"></ion-icon>
              </div>
            </a>
          </li> --}}
                <li class="nav-item dropdown dropdown-user-setting">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                        data-bs-toggle="dropdown">
                        <div class="user-setting">
                            @if (auth()->user()->role == 'admin')
                                <img src="{{ asset('img/user.png') }}" class="user-img" alt="">
                            @elseif(auth()->user()->role == 'farmer')
                                <img src="{{ asset('upload/'.auth()->user()->farmer->foto_toko) }}" class="user-img" alt="">
                            @else
                                <img src="{{ asset('upload/'.auth()->user()->merchant->foto_toko) }}" class="user-img" alt="">
                            @endif
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @if (auth()->user()->role != 'admin')
                            <li>
                                <a class="dropdown-item">
                                    <div class="d-flex flex-row align-items-center gap-2">
                                        <img src="{{ auth()->user()->role == 'farmer' ? asset('upload/'.auth()->user()->farmer->foto_toko) : asset('upload/'.auth()->user()->merchant->foto_toko) }}" alt="" class="rounded-circle" width="54" height="54">
                                        <div class="">
                                            <h6 class="mb-0 dropdown-user-name">{{ auth()->user()->name }}</h6>
                                            <small class="mb-0 dropdown-user-designation text-secondary">
                                                @if (auth()->user()->role == 'admin')
                                                Admin
                                                @elseif(auth()->user()->role == 'farmer')
                                                    Farmer
                                                @elseif(auth()->user()->role == 'merchant')
                                                    Merchant
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @else
                            <li>
                                <a class="dropdown-item">
                                    <div class="d-flex flex-row align-items-center gap-2">
                                        <img src="{{ asset('img/user.png') }}" alt="" class="rounded-circle"
                                            width="54" height="54">
                                        <div class="">
                                            <h6 class="mb-0 dropdown-user-name">{{ auth()->user()->name }}</h6>
                                            <small class="mb-0 dropdown-user-designation text-secondary">
                                                @if (auth()->user()->role == 'admin')
                                                    Admin
                                                @elseif(auth()->user()->role == 'farmer')
                                                    Farmer
                                                @elseif(auth()->user()->role == 'merchant')
                                                    Merchant
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endif
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        @if (auth()->user()->role != 'admin')
                            <li>
                                <a class="dropdown-item"
                                    href="{{ auth()->user()->role == 'farmer' ? route('farmer-user') : route('merchant-user') }}">
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                            @if (auth()->user()->role == 'farmer')
                                            <ion-icon name="flower-outline"></ion-icon>
                                            @else
                                            <ion-icon name="storefront-outline"></ion-icon>
                                            @endif
                                        </div>
                                        <div class="ms-3"><span>Kembali</span></div>
                                    </div>
                                </a>
                            </li>
                        @endif
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <ion-icon name="log-out-outline"></ion-icon>
                                    </div>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                    <div class="ms-3"><span>Logout</span></div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>

        </div>
    </nav>
</header>
<!--end top header-->

<script src="{{asset('js/jquery.min.js')}}"></script>

<script>
    $(document).ready(function(){
        $('#btn-close-sidebar').on('click', function(){
            $(".wrapper").removeClass("toggled")
        })
    })
</script>
