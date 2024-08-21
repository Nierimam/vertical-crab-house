@extends('user.layouts.app')
@section('content')
<!-- Shoping Cart -->
<form class="bg0 p-t-75 p-b-85" action="{{ route('detailOrder.pembayaran',$order->id) }}" method="POST" autocomplete="off">
    @method('PUT')
    @csrf
    <div class="container" style="max-width: 1500px!important;">
        <div class="d-flex justify-content-end my-4">
            <a href="{{route('listorder.user')}}" class="btn btn-secondary">Kembali</a>
        </div>
        <div class="row">
            <!-- Ec Track Order section -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <!-- Track Order Content Start -->
            <div class="ec-trackorder-content col-md-12">
                <div class="ec-trackorder-inner">
                    <div class="ec-trackorder-bottom">
                        <div class="ec-progress-track">
                            <ul id="ec-progressbar">
                                <li class="step0 {{ in_array($order->status, ['menunggu_pembayaran', 'menunggu_persetujuan', 'terbayar', 'pengiriman', 'diterima']) ? 'active' : '' }}"><span class="ec-track-icon"> <img
                                        src="{{ asset('assets/images/icons/time-is-money.png') }}" style="max-width: 25px" alt="track_order"></span><span
                                        class="ec-progressbar-track"></span><span class="ec-track-title">Menunggu
                                            <br>Pembayaran</span></li>
                                <li class="step0 {{ in_array($order->status, ['menunggu_persetujuan', 'terbayar', 'pengiriman', 'diterima']) ? 'active' : '' }}"><span class="ec-track-icon"> <img
                                        src="{{ asset('assets/images/icons/clock.png') }}" style="max-width: 25px" alt="track_order"></span><span
                                        class="ec-progressbar-track"></span><span class="ec-track-title">Menunggu
                                            <br>Persetujuan</span></li>
                                <li class="step0 {{ in_array($order->status, ['terbayar', 'pengiriman', 'diterima']) ? 'active' : '' }}"><span class="ec-track-icon"> <img
                                        src="{{ asset('assets/images/icons/validating-ticket.png') }}" style="max-width: 25px" alt="track_order"></span><span
                                        class="ec-progressbar-track"></span><span class="ec-track-title">Terbayar</span></li>
                                <li class="step0 {{ in_array($order->status, ['pengiriman', 'diterima']) ? 'active' : '' }}"><span class="ec-track-icon"> <img
                                        src="{{ asset('assets/images/icons/delivery.png') }}" style="max-width: 25px" alt="track_order"></span><span
                                        class="ec-progressbar-track"></span><span class="ec-track-title">Dikirim</span></li>
                                <li class="step0 {{ in_array($order->status, ['diterima']) ? 'active' : '' }}"><span class="ec-track-icon"> <img
                                        src="{{ asset('assets/images/icons/delivery (1).png') }}" style="max-width: 25px" alt="track_order"></span><span
                                        class="ec-progressbar-track"></span><span class="ec-track-title">Diterima</span></li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Track Order Content end -->
        </div>
    </section>
    <!-- End Track Order section -->
        </div>
        <div class="row">
            <div class="col-lg-12 col-xl-12 m-lr-auto m-b-50">
                <div class="m-lr-0-xl">
                    @if ($order->status == 'pending')
                        <div class="alert alert-primary" role="alert">
                            Pesanan sedang pending menunggu untuk di terima oleh admin
                        </div>
                    @elseif($order->status == 'menunggu_pembayaran')
                        <div class="alert alert-warning" role="alert">
                            Pesanan sudah disetujui admin segera lakukan pembayaran
                        </div>
                    @elseif($order->status == 'menunggu_persetujuan')
                        <div class="alert alert-warning" role="alert">
                            Pesanan sudah di bayar mohon menunggu persetujuan admin
                        </div>
                    @elseif($order->status == 'terbayar')
                        <div class="alert alert-success" role="alert">
                            Pembayaran sudah disetujui admin mohon menunggu untuk pengiriman barang anda
                        </div>
                    @elseif($order->status == 'pengiriman')
                        <div class="alert alert-info" role="alert">
                            Pesanan anda sedang dalam perjalanan mohon menunggu
                        </div>
                    @elseif($order->status == 'diterima')
                        <div class="alert alert-success" role="alert">
                            Pesanan anda sudah diterima, terimakasih sudah berbelanja
                        </div>
                    @elseif($order->status == 'dibatalkan')
                        <div class="alert alert-danger" role="alert">
                            Pesanan dibatalkan!
                        </div>
                    @endif
                    <div class="card p-lr-20 pt-4 mb-3">
                        <div class="card-header bg-white" style="border-bottom: 0;">
                            <h4>Detail Pesanan</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mt-4">
                                <div class="col-lg-4">
                                    <label for=""><b>Invoice</b></label>
                                    <div>
                                        <p>{{$order->invoice}}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label for=""><b>Total</b></label>
                                    <div>
                                        <p>Rp {{ number_format($order->total,0,',','.') }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label for=""><b>Status</b></label>
                                    <div>
                                        @if ($order->status == 'pending')
                                            <span class="badge badge-primary p-2">Pending</span>
                                        @elseif($order->status == 'menunggu_pembayaran')
                                            <span class="badge badge-warning p-2">Lakukan Pembayaran</span>
                                        @elseif($order->status == 'menunggu_persetujuan')
                                            <span class="badge badge-warning p-2">Menunggu Persetujuan</span>
                                        @elseif($order->status == 'terbayar')
                                            <span class="badge badge-success p-2">Sudah terbayar</span>
                                        @elseif($order->status == 'pengiriman')
                                            <span class="badge badge-info p-2">Sedang Pengiriman</span>
                                        @elseif($order->status == 'diterima')
                                            <span class="badge badge-success p-2">Sudah Diterima</span>
                                        @elseif($order->status == 'dibatalkan')
                                            <span class="badge badge-danger p-2">Dibatalkan</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if (!empty($order->voucher))
                            <div class="row mt-4">
                                <div class="col-lg-4">
                                    <label for=""><b>Nama Voucher</b></label>
                                    <div>
                                        <p>{{$order->voucher}}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label for=""><b>Diskon Voucher</b></label>
                                    <div>
                                        <p>Rp {{ number_format($order->discount,0,',','.') }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="row mt-4">
                                <div class="col-lg-12">
                                    <label for=""><b>Alamat</b></label>
                                    <div>
                                        <p>{{$order->alamat}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-4">
                                    <label for=""><b>Kurir</b></label>
                                    <div>
                                        <p>{{$order->shipping_courier}}</p>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label for=""><b>Biaya Ongkir</b></label>
                                    <div>
                                        <p>Rp {{ number_format($order->shipping_price,0,',','.') }}</p>
                                    </div>
                                </div>
                            </div>
                            @if (!empty($order->no_resi))
                            <div class="row mt-4">
                                <div class="col-lg-12">
                                    <label for=""><b>No Resi</b></label>
                                    <div>
                                        <p>{{$order->no_resi}}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if (!empty($order->nama_bank))
                            <div class="card mt-4">
                                <div class="card-header">
                                    <label for=""><b>Informasi Pembayaran</b></label>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label for=""><b>Nama Bank</b></label>
                                            <div>
                                                <p>{{$order->nama_bank}}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for=""><b>No Bank</b></label>
                                            <div>
                                                <p>{{$order->no_bank}}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for=""><b>Pemilik bank</b></label>
                                            <div>
                                                <p>{{$order->pemilik_bank}}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for=""><b>Tanggal Bayar</b></label>
                                            <div>
                                                <p>{{date('d-m-Y',strtotime($order->tanggal_bayar))}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="row mt-4">
                                <div class="col-lg-12">
                                    <div class="mb-1">
                                        <label for=""><b>Pesanan yang dibeli</b></label>
                                    </div>
                                    <div class="wrap-table-shopping-cart">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="table_head">
                                                    <th class="column-1">Nama Produk</th>
                                                    <th class="column-1">Variant</th>
                                                    <th class="column-1">Harga</th>
                                                    <th class="column-1">Jumlah</th>
                                                    <th class="column-1">Gambar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->order_produks as $key => $produk)
                                                    <tr>
                                                        <td class="column-1 py-4">{{$produk->produk_variants->produks->nama_produk}}</td>
                                                        <td class="column-1 py-4">{{$produk->produk_variants->nama_variant}}</td>
                                                        <td class="column-1 py-4">Rp. {{number_format($produk->produk_variants->price,0,',','.')}}</td>
                                                        <td class="column-1 py-4">{{$produk->qty}}</td>
                                                        <td class="column-1 py-4">
                                                            <img src="{{asset('upload/'.$produk->produk_variants->img)}}" width="100px" height="100px" alt="">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            @if ($order->status == 'menunggu_pembayaran' || $order->status == 'pending')
                            <div class="d-flex justify-content-end">
                                <div class="d-flex justify-content-end mt-4">
                                    <button class="btn btn-danger" type="submit" name="batal_pesanan" value="1">Batalkan</button>
                                </div>
                                @if ($order->status == 'menunggu_pembayaran')
                                <div class="d-flex justify-content-end mt-4 ml-2">
                                    <button type="button" class="btn btn-success text-light btn-bayar-midtrans" data-id="{{ $order->id }}">Bayar Sekarang</button>
                                </div>
                                @endif
                            </div>
                            @elseif ($order->status == 'pengiriman')
                                <div class="d-flex justify-content-end mt-4">
                                    <button type="button" class="btn btn-success text-light" data-bs-toggle="modal" data-bs-target="#sudahDiterima" >Sudah Diterima</button>
                                </div>
                            @elseif ($order->status == 'diterima')
                                @php
                                    $rated = false;
                                    foreach($order->order_produks as $order_produk) {
                                        if (!empty($order_produk->rating) && $order_produk->rating >= 0) {
                                            $rated = true;
                                        }
                                    }
                                @endphp
                                @if ($rated)
                                    <div class="d-flex justify-content-end mt-4 text-success">
                                        <p>Terimakasih sudah memberikan rating</p>
                                    </div>
                                @else
                                <div class="d-flex justify-content-end mt-4">
                                    <button type="button" class="btn btn-success text-light" data-bs-toggle="modal" data-bs-target="#beriRating">Beri Rating</button>
                                </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal Pembayaran-->
<div class="modal fade" id="bayarSekarang" tabindex="-1" aria-labelledby="bayarSekarangLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                @if ($order->status == 'menunggu_pembayaran')
                    Pembayaran
                @elseif($order->status == 'pengiriman')
                    Konfirmasi Pesanan
                @elseif ($order->status == 'diterima')
                    Rating Produk
                @endif
            </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('detailOrder.pembayaran',$order->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    @if ($order->status == 'menunggu_pembayaran')
                    <div class="row">
                        <div class="col-lg-4">
                            <label for=""><b>Invoice</b></label>
                            <div>
                                <p>{{$order->invoice}}</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for=""><b>Total</b></label>
                            <div>
                                <p>Rp {{ number_format($order->total,0,',','.') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-4">
                            <label for=""><b>Rekening Tujuan</b></label>
                            <div>
                                <p>123456789</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for=""><b>Atas Nama</b></label>
                            <div>
                                <p>Nories</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for=""><b>Bank</b></label>
                            <div>
                                <p>BCA</p>
                            </div>
                        </div>
                    </div>
                        <div class="row mt-3" style="padding: 15px">
                            <div class="card" style="width: 100%">
                                <div class="pt-2">
                                    <label for=""><b>Lengkapi Pembayaran <span class="text-danger">*</span> </b></label>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for=""><b>Nama Bank</b></label>
                                            <div>
                                                @php
                                                    $bank_indonesia = [
                                                    'BCA',
                                                    'BRI',
                                                    'BNI',
                                                    'Mandiri',
                                                    'Permata Bank',
                                                    'BTN',
                                                    'Cimb Niaga',
                                                    'Bank Syariah'
                                                    ]
                                                @endphp
                                                <select name="nama_bank" required id="" class="form form-control" style="border:1px solid #CED4DA !important" >
                                                    <option value="" selected disabled >Pilih Bank</option>
                                                    @foreach ($bank_indonesia as $bank)
                                                        <option value="{{ $bank }}">{{ $bank }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-lg-6">
                                            <label for=""><b>No Bank</b></label>
                                            <div>
                                                <input type="text" required name="no_bank" class="form form-control" >
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for=""><b>Atas Nama</b></label>
                                            <div>
                                                <input type="text" required name="pemilik_bank" class="form form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-lg-12">
                                            <label for=""><b>Bukti Pembayaran</b></label>
                                            <div>
                                                <input type="file" name="bukti_bayar" class="form form-control" placeholder="Masukkan nama bank">
                                            </div>
                                            <div>
                                                <i class="text-danger">sertakan bukti pembayaran : jpg,png,jpeg,pdf</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="text-right mt-4">
                            @if ($order->status == 'menunggu_pembayaran')
                                <button class="btn btn-success" type="submit"> Bayar </button>
                            @elseif($order->status == 'pengiriman')
                                <button class="btn btn-success" type="submit"> Yakin </button>
                            @elseif ($order->status == 'diterima')
                                <button class="btn btn-success" type="submit"> Rating </button>
                            @endif
                        </div>
                        <div class="text-right mt-4">
                            @if ($order->status == 'menunggu_pembayaran')
                                <button class="btn btn-success" type="submit"> Bayar </button>
                            @elseif($order->status == 'pengiriman')
                                <button class="btn btn-success" type="submit"> Yakin </button>
                            @elseif ($order->status == 'diterima')
                                <button class="btn btn-success" type="submit"> Rating </button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Sudah Diterima-->
<div class="modal fade" id="sudahDiterima" tabindex="-1" aria-labelledby="sudahDiterimaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                @if ($order->status == 'menunggu_pembayaran')
                    Pembayaran
                @elseif($order->status == 'pengiriman')
                    Konfirmasi Pesanan
                @elseif ($order->status == 'diterima')
                    Rating Produk
                @endif
            </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('detailOrder.pembayaran',$order->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row mt-3 justify-content-center" style="padding: 15px">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('assets/images/shipped.png') }}" alt="">
                        </div>
                        <div class="text-center">
                            <h4>Barang Yang Di Pesan Sudah Diterima dan Sesuai?</h4>
                        </div>
                    </div>
                    <div class="text-right mt-4">
                        @if ($order->status == 'menunggu_pembayaran')
                            <button class="btn btn-success" type="submit"> Bayar </button>
                        @elseif($order->status == 'pengiriman')
                            <button class="btn btn-success" type="submit"> Sudah </button>
                        @elseif ($order->status == 'diterima')
                            <button class="btn btn-success" type="submit"> Rating </button>
                        @endif
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pembayaran-->
<div class="modal fade" id="beriRating" tabindex="-1" aria-labelledby="beriRatingLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
                @if ($order->status == 'menunggu_pembayaran')
                    Pembayaran
                @elseif($order->status == 'pengiriman')
                    Konfirmasi Pesanan
                @elseif ($order->status == 'diterima')
                    Rating Produk
                @endif
            </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('detailOrder.pembayaran',$order->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                        @foreach ($order->order_produks as $key => $produk)
                        <div class="row mt-3" style="padding: 15px">
                            <div class="col-lg-6">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <div>
                                            <img src="{{ asset('upload/'.$produk->produk_variants->img) }}" width="200px" height="150px" alt="">
                                        </div>
                                        <p> <b>{{$produk->produk_variants->nama_variant}}</b>   - {{$produk->produk_variants->produks->nama_produk}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="">
                                    <input type="hidden" name="rating[]" id="rating-rate-{{$key}}" required value="">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star btn-rating fs-32 btn-rating-{{$key}}" data-key="{{$key}}" data-rate="{{$i}}"></i>
                                    @endfor
                                </div>
                                <div class="mt-3">
                                    <textarea name="review[]" id="" class="form form-control" rows="3" placeholder="Masukkan Komentar">{{$produk->review}}</textarea>
                                </div>
                                <div class="mt-3">
                                    <input type="file" class="form form-control" name="media[]" >
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="text-right mt-4">
                            @if ($order->status == 'menunggu_pembayaran')
                                <button class="btn btn-success" type="submit"> Bayar </button>
                            @elseif($order->status == 'pengiriman')
                                <button class="btn btn-success" type="submit"> Yakin </button>
                            @elseif ($order->status == 'diterima')
                                <button class="btn btn-success" type="submit"> Rating </button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-content')
  <script>
    $('.btn-rating').on('click', function () {
    console.log('asasa');
        var key_rate = $(this).data('key')
        var rate = $(this).data('rate')
        $('#rating-rate-'+key_rate).val(rate);
        $.each($('.btn-rating-'+key_rate), function (key, val) {
            if ($(val).hasClass('text-warning')) {
                $(val).removeClass('text-warning')
            }

            if ((key + 1) <= rate) {
                $(val).addClass('text-warning')
            }
        });
    });
    $('.btn-bayar-midtrans').on('click', function () {
        var id = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: "{{ route('midtrans.create') }}",
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id,
            },
            beforeSend: function () {
                Swal.showLoading();
            },
            success: function (data) {
                if (!data.error) {
                    Swal.close()
                    window.location.href = data.data.redirect_url
                }
            },
        });
    });
  </script>
@endsection
