@extends('user.layouts.app')

@section('content')
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-title">Tentang Kami</h2>
                    <p style="text-align: justify">{{$company[0]->deskripsi}}</p>
                </div>
            </div>
            <div class="ec-common-wrapper">
                {{-- <div class="row">
                    <div class="col-md-3 ec-cms-block ec-abcms-block text-center">
                        <div class="ec-cms-block-inner">
                        <img class="a-img" height="300" width="300" src="{{ asset('img/logo_vertical_crab.png') }}" alt="about">
                        </div>
                    </div> --}}
                    <div class="col-md-12 ec-cms-block ec-abcms-block text-center">
                        <div class="ec-cms-block-inner">
                            <br>
                            <h5 class="ec-title" style="color: #cc2514">VISI</h5>
                            <p style="text-align: justify">{{ $company[0]->visi }}</p>
                            <br>
                            <h5 class="ec-title" style="color: #cc2514">MISI</h5>
                            <p style="text-align: justify">{{ $company[0]->misi }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="ec-common-wrapper">
                <div class="ec_contact_map">
                    <div class="ec_map_canvas text-center">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.354254708179!2d112.68985717581779!3d-7.314041871917429!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fdb2564a590b%3A0xbc856f9a29607e62!2sCrab%20house%20%2F%20crab%20crab%20aquatic%2F%20budidaya%20kepiting%20%2F%20jual%20kepiting!5e0!3m2!1sid!2sid!4v1721174624356!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="ec_contact_info">
                    <h1 class="ec_contact_info_head" style="color: #cc2514">Kontak Kami</h1>
                    <ul class="align-items-center">
                        <li class="ec-contact-item"><i class="ecicon eci-map-marker"
                                aria-hidden="true"></i><span>Address :</span>7{{ $company[0]->alamat }}</li>
                        <li class="ec-contact-item align-items-center"><i class="ecicon eci-phone"
                                aria-hidden="true"></i><span>Call Us :</span><a href="tel:+{{ $company[0]->telp }}">+{{ $company[0]->telp }}</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
