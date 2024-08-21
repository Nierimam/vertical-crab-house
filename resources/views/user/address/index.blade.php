@extends('user.layouts.app')

@section('content')
	<!-- Shoping Cart -->
	<form class="bg0 p-t-75 p-b-85">
		<div class="container" style="max-width: 1500px!important;">
            <div class="d-flex justify-content-end my-4">
                <div>
                    <a href="{{ route('detail-cart') }}" class="btn btn-secondary">Kembali</a>
                    <a href="{{ route('address.user.create') }}" class="btn btn-primary">Tambah</a>
                </div>
            </div>
			<div class="row">
				<div class="col-lg-12 col-xl-12 m-lr-auto m-b-50">
					<div class="m-l-25 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table class="table table-striped">
                                <thead>
                                    <tr class="table_head">
                                        <th class="column-1">Nama Alamat</th>
                                        <th class="column-1">Alamat</th>
                                        <th class="column-1">Lot</th>
                                        <th class="column-1">Lang</th>
                                        <th class="column-1">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($addresss) > 0)
                                        @foreach ($addresss as $address)
                                            <tr>
                                                <td class="column-1 py-4">{{ $address->nama_alamat }}</td>
                                                <td class="column-1 py-4" >{{ strlen($address->alamat) > 10 ? substr($address->alamat, 0 , 10).' ...' : $address->alamat }}</td>
                                                <td class="column-1 py-4" >{{ $address->lat }}</td>
                                                <td class="column-1 py-4" >{{ $address->long }}</td>
                                                <td class="column-1 py-4" >
                                                    {{-- <a href="{{ route('address.user.edit',$address->id) }}" class="btn btn-sm btn-success">Ubah</a> --}}
                                                    <button class="btn btn-sm btn-danger delete-address" data-id="{{ $address->id }}" data-redirect="{{ route('address.user.destroy',$address->id) }}" data-token="{{ csrf_token() }}">Hapus</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="column-1 py-4 text-center" colspan="5">Tidak ada data alamat</td>
                                        </tr>
                                    @endif
                                </tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
@endsection

@section('js-content')
    <script>
        $(document).ready(function () {
            $('.delete-address').click(function (e) {
                e.preventDefault();
                var id = $(this).data("id");
                var token = $(this).data("token");
                var redirect = $(this).data("redirect");
                Swal.fire({
                    title: 'Yakin?',
                    text: "Data akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0275d8',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "delete",
                            url: redirect,
                            data: {
                                "id": id,
                                "_method": 'DELETE',
                                "_token": token,
                            },
                            success: function (response) {
                                Swal.fire(
                                    'Berhasil!',
                                    response.message,
                                    'success'
                                )
                                .then((result) => {
                                    location.reload();
                                });
                            }
                        });
                    }
                })
            });
        });

    </script>
@endsection

