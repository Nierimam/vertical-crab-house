@extends('user.layouts.app')

@section('content')

    <!-- Content page -->
    <section class="bg0 p-t-104 p-b-116" style="margin-top: 2rem">
        <div class="fluid-container">
            <div class="flex-w flex-tr justify-content-center">
                <div class="size-219 bor10 p-lr-30 p-t-55 p-b-70 p-lr-15-lg w-full">
                    <div class="tab-content" id="v-pills-tabContent">
                        {{-- Profile --}}
                        <div class="card" style="margin-right: 3rem;margin-left:3rem;margin-bottom:3rem">
                            <div class="card-body">
                                <div class="tab-pane fade {{ isset($tab) && $tab == 'v-pills-profile' ? 'show active' : '' }}" id="v-pills-profile" role="tabpanel"
                                    aria-labelledby="v-pills-profile-tab">
                                    <h4 class="mtext-105 text-center">
                                        <b>Profile Akun</b>
                                    </h4>
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-12 d-flex justify-content-center mb-4 mt-3">
                                                @if (isset(auth()->user()->customers->img_profile) && !empty(auth()->user()->customers->img_profile))
                                                    <a class="fancybox" data-caption="{{ auth()->user()->username }}" href="{{asset('upload/'.auth()->user()->customers->img_profile)}}">
                                                        <img src="{{ asset('upload/' . auth()->user()->customers->img_profile) }}" alt="" width="100px" height="100px" style="border-radius: 20px">
                                                    </a>
                                                @else
                                                    <img src="{{ 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->customers->nama_lengkap) }}"
                                                        alt="" width="100px" height="100px" style="border-radius: 20px">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3">

                                            </div>
                                            <div class="col-lg-3">
                                                <b>Username</b>
                                            </div>
                                            <div class="col-lg-1">
                                                :
                                            </div>
                                            <div class="col-lg-5">
                                                {{ auth()->user()->username }}
                                            </div>
                                            <div class="w-100">
                                                <hr>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3">

                                            </div>
                                            <div class="col-lg-3">
                                                <b>Email</b>
                                            </div>
                                            <div class="col-lg-1">
                                                :
                                            </div>
                                            <div class="col-lg-5">
                                                {{ auth()->user()->email }}
                                            </div>
                                            <div class="w-100">
                                                <hr>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3">

                                            </div>
                                            <div class="col-lg-3">
                                                <b>Nama Lengkap</b>
                                            </div>
                                            <div class="col-lg-1">
                                                :
                                            </div>
                                            <div class="col-lg-5">
                                                {{ auth()->user()->customers->nama_lengkap }}
                                            </div>
                                            <div class="w-100">
                                                <hr>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3">

                                            </div>
                                            <div class="col-lg-3">
                                                <b>Nama Telepon</b>
                                            </div>
                                            <div class="col-lg-1">
                                                :
                                            </div>
                                            <div class="col-lg-5">
                                                {{ auth()->user()->customers->telp }}
                                            </div>
                                            <div class="w-100">
                                                <hr>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3">

                                            </div>
                                            <div class="col-lg-3">
                                                <b>Tempat Lahir</b>
                                            </div>
                                            <div class="col-lg-1">
                                                :
                                            </div>
                                            <div class="col-lg-5">
                                                <span
                                                    class="{{ isset(auth()->user()->customers->tempat_lahir) && !empty(auth()->user()->customers->tempat_lahir) ? 'text-black' : 'text-danger' }}">{{ isset(auth()->user()->customers->tempat_lahir) && !empty(auth()->user()->customers->tempat_lahir) ? auth()->user()->customers->tempat_lahir : 'Belum diisi' }}</span>
                                            </div>
                                            <div class="w-100">
                                                <hr>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3">

                                            </div>
                                            <div class="col-lg-3">
                                                <b>Tanggal lahir</b>
                                            </div>
                                            <div class="col-lg-1">
                                                :
                                            </div>
                                            <div class="col-lg-5">
                                                <span
                                                    class="{{ isset(auth()->user()->customers->tanggal_lahir) && !empty(auth()->user()->customers->tanggal_lahir) ? 'text-black' : 'text-danger' }}">{{ isset(auth()->user()->customers->tanggal_lahir) && !empty(auth()->user()->customers->tanggal_lahir) ? date('d-m-Y', strtotime(auth()->user()->customers->tanggal_lahir)) : 'Belum diisi' }}</span>
                                            </div>
                                            <div class="w-100">
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <button class="btn btn-primary w-25" data-bs-toggle="modal" data-bs-target="#ubahPassword">Ubah Password</button>
                                            <button class="btn btn-primary w-25" data-bs-toggle="modal" data-bs-target="#ubahProfile">Ubah Profile</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End Profile --}}

                        <!-- Modal Ubah Profile-->
                        <div class="modal fade" id="ubahProfile" tabindex="-1" aria-labelledby="ubahProfileLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="ubahProfileLabel">
                                    <h4 class="mtext-105 cl2 txt-center p-b-30">
                                        <b>Ubah Profile Akun</b>
                                    </h4>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('ubah.profile',auth()->user()->id) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                                        @method('PUT')
                                        @csrf
                                        <div class="col-lg-12">
                                            <div class="row mb-3">
                                                <div class="col-lg-6">
                                                    <label for="" class="form-label form-control-label">Username</label>
                                                    <input type="text" class="form form-control form-control-sm" value="{{ auth()->user()->username }}" name="username">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="" class="form-label form-control-label">Email</label>
                                                    <input type="text" class="form form-control form-control-sm" value="{{ auth()->user()->email }}" name="email">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-lg-6">
                                                    <label for="" class="form-label form-control-label">Nama lengkap</label>
                                                    <input type="text" class="form form-control form-control-sm" value="{{ auth()->user()->customers->nama_lengkap }}" name="nama_lengkap">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="" class="form-label form-control-label">No telepon</label>
                                                    <input type="text" class="form form-control form-control-sm" value="{{ auth()->user()->customers->telp }}" name="telp">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-lg-6">
                                                    <label for="" class="form-label form-control-label">Tempat lahir</label>
                                                    <input type="text" class="form form-control form-control-sm" placeholder="Masukkan tempat lahir" value="{{ auth()->user()->customers->tempat_lahir }}" name="tempat_lahir">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="" class="form-label form-control-label">Tanggal lahir</label>
                                                    <input type="date" class="form form-control form-control-sm" value="{{ date('Y-m-d', strtotime(auth()->user()->customers->tanggal_lahir)) }}" name="tanggal_lahir">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-lg-12">
                                                    <label for="" class="form-label form-control-label">Foto profile</label>
                                                    <input type="file" class="form form-control form-control-sm" style="padding-top: 13px" name="img_profile">
                                                </div>
                                            </div>


                                            <div class="row mt-4">
                                                <div class="col-lg-12 text-right mt-4">
                                                    <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>

                        <!-- Modal Ubah Password-->
                        <div class="modal fade" id="ubahPassword" tabindex="-1" aria-labelledby="ubahPasswordLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="ubahPasswordLabel">
                                    <h4 class="mtext-105 cl2 txt-center p-b-30">
                                        <b>Ubah Passowrd <span class="text-danger">{{ auth()->user()->username }}</span></b>
                                    </h4>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('ubah.passwordUser',auth()->user()->id) }}" method="POST" autocomplete="off">
                                        @method('PUT')
                                        @csrf

                                        <div class="col-lg-12">
                                            <div class="row mb-3">
                                                <div class="col-lg-12">
                                                    <label for="" class="form-label form-control-label">Password lama</label>
                                                    <input type="password" class="form form-control form-control-sm" value="" name="password_lama" placeholder="Masukkan password lama" >
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-lg-12">
                                                    <label for="" class="form-label form-control-label">Password baru</label>
                                                    <input type="password" class="form form-control form-control-sm" value="" name="password" placeholder="Masukkan password baru">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-lg-12">
                                                    <label for="" class="form-label form-control-label">Konfirmasi password baru</label>
                                                    <input type="password" class="form form-control form-control-sm" value="" name="password_konfirmasi" placeholder="Masukkan password konfirmasi" >
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col-lg-12 text-right mt-4">
                                                    <button class="btn btn-primary btn-sm" type="submit">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js-content')
<script>
    $(document).ready(function(){
        $('#v-pills-tab a[href="#{{ session('tab') }}"]').tab('show');
    });
</script>
@endsection
