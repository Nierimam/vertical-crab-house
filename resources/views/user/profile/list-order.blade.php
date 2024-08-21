@extends('user.layouts.app')

@section('content')

    <!-- Content page -->
    <section class="bg0 p-t-104 p-b-116" style="margin-top: 2rem;margin-bottom:2rem">
        <div class="container">
            <div class="flex-w flex-tr justify-content-center">
                <div class="size-219 bor10 p-lr-30 p-t-55 p-b-70 p-lr-15-lg w-full">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="text-center">
                            <h3>Daftar Pembelian</h3>
                        </div>
                        {{-- Dashboard --}}
                            <div class="m-lr-0-xl">
                                <div class="wrap-table-shopping-cart">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr class="table_head">
                                                <th class="column-1">Invoice</th>
                                                <th class="column-1">Alamat</th>
                                                <th class="column-1">Total</th>
                                                <th class="column-1">Status</th>
                                                <th class="column-1">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($orders) > 0)
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <td class="column-1 py-4">{{ $order->invoice }}</td>
                                                        <td class="column-1 py-4" >{{ strlen($order->alamat) > 10 ? substr($order->alamat, 0 , 10).' ...' : $order->alamat }}</td>
                                                        <td class="column-1 py-4" >Rp {{ number_format($order->total,0,',','.') }}</td>
                                                        <td class="column-1 py-4" >
                                                            @if ($order->status == 'pending')
                                                                <span class="badge bg-primary p-2">Pending</span>
                                                            @elseif($order->status == 'menunggu_pembayaran')
                                                                <span class="badge bg-primary p-2">Lakukan Pembayaran</span>
                                                            @elseif($order->status == 'menunggu_persetujuan')
                                                                <span class="badge bg-primary p-2">Menunggu Persetujuan</span>
                                                            @elseif($order->status == 'terbayar')
                                                                <span class="badge bg-success p-2">Sudah terbayar</span>
                                                            @elseif($order->status == 'pengiriman')
                                                                <span class="badge bg-info p-2">Sedang Pengiriman</span>
                                                            @elseif($order->status == 'diterima')
                                                                <span class="badge bg-success p-2">Sudah Diterima</span>
                                                            @elseif($order->status == 'dibatalkan')
                                                                <span class="badge bg-danger p-2">Dibatalkan</span>
                                                            @elseif($order->status == 'ditolak')
                                                                <span class="badge bg-danger p-2">Ditolak</span>
                                                            @endif
                                                        </td>
                                                        <td class="column-1 py-4" >
                                                            <a href="{{ route('detailOrder.edit',$order->id) }}" class="btn btn-sm btn-success">Detail</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                <td class="column-1 py-4 text-center" colspan="5">Tidak Memiliki Data Pesanan</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        {{-- Dashboard --}}
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
