@extends('user.layouts.app')

@section('content')
<!-- Start Register -->
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-title">Register</h2>
                    <p class="sub-title mb-3">Daftar untuk dapat melakukan pembelian</p>
                </div>
            </div>
            <div class="col-md-8">
                <div class="ec-register-wrapper">
                    <div class="ec-register-container">
                        <div class="ec-register-form">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <span class="ec-register-wrap">
                                    <label>Provinsi</label>
                                    <select name="provinsi_id" id="provinsi_id" class="form-control border">
                                        <option value="" selected disabled >Pilih Provinsi</option>
                                        @foreach ($provinsi as $prov)
                                            <option value="{{ $prov['province_id'] }}" {{ $provinsi_id == $prov['province_id'] ? 'selected' : '' }}>{{ $prov['province'] }}</option>
                                        @endforeach
                                    </select>
                                </span><br>
                                <span class="ec-register-wrap">
                                    <label>Kota</label>
                                    <select name="kota_id" id="kota_id" class="form-control border">
                                        @if (empty($provinsi_id))
                                            <option value="" selected disabled >Pilih Provinsi Terlebih Dahulu</option>
                                        @else
                                            @foreach ($kota as $k)
                                                <option value="{{ $k['city_id'] }}">{{ $k['type'] }} {{ $k['city_name'] }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </span><br>
                                <div class="mb-4">
                                    <i>Pilih Provinsi dan Kota Terlebih Dahulu <span class="text-danger" >*</span></i>
                                </div>
                                <span class="ec-register-wrap ec-register-half">
                                    <label>Nama Lengkap*</label>
                                    <input id="nama_lengkap" type="text" placeholder="Masukan nama lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required autocomplete="name" autofocus>
                                    @error('nama_lengkap')
                                        <div style="margin-top: -10px">
                                            <span class="text-danger" style="font-size: 11px">{{ $message }}</span> <br>
                                        </div>
                                    @enderror
                                </span><br>
                                <span class="ec-register-wrap ec-register-half">
                                    <label>Username*</label>
                                    <input id="name" type="text" placeholder="Masukan username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required >
                                    @error('username')
                                        <div style="margin-top: -10px">
                                            <span class="text-danger" style="font-size: 11px">{{ $message }}</span> <br>
                                        </div>
                                    @enderror
                                </span><br>
                                <span class="ec-register-wrap ec-register-half">
                                    <label>Email*</label>
                                    <input id="email" type="email" placeholder="Masukan email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <div style="margin-top: -10px">
                                            <span class="text-danger" style="font-size: 11px">{{ $message }}</span> <br>
                                        </div>
                                    @enderror
                                </span><br>
                                <span class="ec-register-wrap ec-register-half">
                                    <label>No Telp*</label>
                                    <input id="telp" type="text" placeholder="Masukan no telp" class="form-control @error('telp') is-invalid @enderror" name="telp" value="{{ old('telp') }}" required >
                                    @error('telp')
                                        <div style="margin-top: -10px">
                                            <span class="text-danger" style="font-size: 11px">{{ $message }}</span> <br>
                                        </div>
                                    @enderror
                                </span><br>
                                <span class="ec-register-wrap">
                                    <label>Password</label>
                                    <input type="password" name="password" placeholder="Enter your password" style="border: 1px solid #CED4DA!important;" required />
                                    @error('password')
                                        <div style="margin-top: -10px">
                                            <span class="text-danger" style="font-size: 11px">{{ $message }}</span> <br>
                                        </div>
                                    @enderror
                                </span><br><br>
                                <span class="ec-register-wrap">
                                    <label>Confirm Password</label>
                                    <input type="password" name="password_confirmation" placeholder="Enter your password confirmation" style="border: 1px solid #CED4DA!important;" required />
                                </span><br><br>
                                <span class="ec-register-wrap ec-register-btn">
                                    <button class="btn btn-primary" type="submit">Register</button>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Register -->
@endsection

@section('js-content')
    <script>
        $(document).ready(function () {
            $('#provinsi_id').on('change', function(e) {
                window.location.href = "{{ route('form.register.user') }}?provinsi_id=" + e.target.value;
            })
        })
    </script>
@endsection

