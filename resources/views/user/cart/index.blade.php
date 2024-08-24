@extends('user.layouts.app')

@section('content')
	<style>

	.wrap-table-shopping-cart {
	overflow: auto;
	border-left: 1px solid #e6e6e6;
	border-right: 1px solid #e6e6e6;
	}

	.table-shopping-cart {
	border-collapse: collapse;
	width: 100%;
	min-width: 680px;
	}

	.table-shopping-cart tr {
	border-top: 1px solid #e6e6e6;
	border-bottom: 1px solid #e6e6e6;
	}

	.table-shopping-cart .column-1 {
	width: 133px;
	padding-left: 50px;
	}

	.table-shopping-cart .column-2 {
	width: 220px;
	font-size: 15px;
	}

	.table-shopping-cart .column-3 {
	width: 120px;
	font-size: 16px;
	}

	.table-shopping-cart .column-4 {
	width: 145px;
	text-align: right;
	}

	.table-shopping-cart .column-5 {
	width: 172px;
	padding-right: 50px;
	text-align: right;
	font-size: 16px;
	}

	.table-shopping-cart .table_row {
	height: 185px;
	}

	.table-shopping-cart .table_row td {
	padding-bottom: 20px;
	}

	.table-shopping-cart .table_row td.column-1 {
	padding-bottom: 30px;
	}

	.table-shopping-cart .table_head th {
	font-family: Poppins-Bold;
	font-size: 13px;
	color: #555;
	text-transform: uppercase;
	line-height: 1.6;
	padding-top: 15px;
	padding-bottom: 15px;
	}

	.table-shopping-cart td {
	font-family: Poppins-Regular;
	color: #555;
	line-height: 1.6;
	}
	</style>
	<div class="row my-3">
		<div class="col-lg-12 d-flex justify-content-center">
			<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url({{ asset('user/images/bannerprofile.jpg') }});">
				<h2 class="ltext-105 cl0 txt-center">
					Detail Pesanan
				</h2>
			</section>
		</div>
	</div>
	<div class="row my-5">
		<div class="col-lg-12 d-flex justify-content-center">
			<!-- Shoping Cart -->
			<form class="bg0 p-t-75 p-b-85" action="{{ route('checkout') }}" method="POST">
				@csrf()
				<div class="container" style="max-width: 1500px!important;">
					<div class="row">
						<div class="col-lg-10 col-xl-8 m-lr-auto m-b-50">
							<div class="m-l-25 m-r--38 m-lr-0-xl">
								<div class="wrap-table-shopping-cart">
									<table class="table-shopping-cart">
										<thead>
											<tr class="table_head">
												<th class="column-1 text-center">Nama produk</th>
												<th class="column-2"></th>
												<th class="column-3">Harga</th>
												<th class="column-4 text-center">Jumlah</th>
												<th class="column-5 text-center">Total</th>
												<th class="column-5"></th>
											</tr>
										</thead>
										<tbody id="data-produk">

										</tbody>

									</table>
								</div>

								<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm mt-2">
									<div class="flex-w flex-m m-r-20 m-tb-5">
										<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5 form-control" type="text" name="coupon" id="nama_kupon" placeholder="Masukkan kode kupon">

										<div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5 btn btn-primary mt-2" id="gunakan-kupon">
											Gunakan Kupon
										</div>
									</div><br>
									<a href="{{ route('address.user') }}" class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10 btn btn-secondary" style="text-decoration: none">
										Tambah Alamat
									</a>
								</div>
							</div>
						</div>

						<div class="col-sm-10 col-lg-7 col-xl-4 m-lr-auto m-b-50">
							<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
								<h4 class="mtext-109 cl2 p-b-30">
									Total keranjang
								</h4>

								<div class="flex-w flex-t bor12 p-b-13">
									<div class="size-208">
										<br>
										<b class="stext-110 cl2">
											Subtotal:
										</b>
									</div>

									<div class="size-209">
										<span class="mtext-110 cl2" id="sub-total">
											0
										</span>
										<input type="hidden" name="sub_total" id="sub-total-input">
									</div>
								</div>

								<div class="flex-w flex-t bor12 p-t-15 p-b-30">
									<div class="size-208 w-full-ssm">
										<br>
										<b class="stext-110 cl2">
											Alamat
										</b>
									</div>

									<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
										<p class="stext-111 cl6 p-t-2">
											Pilih alamat tujuan pengiriman anda
										</p>

										<div class="p-t-15">

											<div class="rs1-select2 rs2-select2 bg0 m-b-12 m-t-9" style="border: 1px #efefef solid;">
												<select class="form form-control" name="alamat" id="alamat" required>
													<option selected disabled value="">Pilih alamat</option>
													@foreach ($addresss as $address)
														<option value="{{ $address->id }}">{{ $address->nama_alamat }}</option>
													@endforeach
												</select>
											</div>

										</div>
									</div>
								</div>

								<div class="flex-w flex-t bor12 p-t-15 p-b-30">
									<div class="size-208 w-full-ssm">
										<br>
										<b class="stext-110 cl2">
											Jasa Pengiriman
										</b>
									</div>

									<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
										<p class="stext-111 cl6 p-t-2">
											Pilih Jasa Pengiriman Yang Ingin Anda Gunakan
										</p>

										<div class="p-t-15">

											<div class="rs1-select2 rs2-select2 bg0 m-b-12 m-t-9" style="border: 1px #efefef solid;">
												<select class="form form-control" name="pengiriman" id="select-jasa-pengiriman" required>
													<option selected disabled value="">Pilih Jasa</option>
													<option value="jne">JNE</option>
													<option value="pos">POS</option>
													<option value="TIKI">TIKI</option>
												</select>
											</div>
										</div>
									</div>
									<div class="size-209 p-r-18 p-r-0-sm w-full-ssm d-none" id="div-jenis-pengiriman">
										<p class="stext-111 cl6 p-t-2">
											Pilih Jenis Pengiriman dari <span id="origin_text"></span> ke <span id="desti_text"></span>
										</p>

										<div class="p-t-15">

											<div class="rs1-select2 rs2-select2 bg0 m-b-12 m-t-9" style="border: 1px #efefef solid;">
												<select class="form form-control" name="jenis_pengiriman" id="select-jenis-pengiriman" required>
													
												</select>
											</div>
											<input type="hidden" name="harga_pengiriman" value="" id="input_harga_pengiriman">
										</div>
									</div>
								</div>
								<input type="hidden" id="used_voucher" name="used_voucher_id" value="">
								<input type="hidden" id="used_voucher_persentase" name="used_voucher_persentase" value="">
								<input type="hidden" id="used_voucher_nominal" name="used_voucher_nominal" value="">
								<div class="flex-w flex-t bor12 p-t-15 p-b-30 d-none" id="div-voucher">
									<div class="size-208 w-full-ssm">
										<br>
										<b class="stext-110 cl2">
											Kupon
										</b>
									</div>

									<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
										<p class="stext-111 cl6 p-t-2" id="nama_voucher">
											Nama Kupon
										</p>

										<div class="p-t-15">

											<span class="mtext-110 cl2" id="total-voucher">
												0
											</span>
											<input type="hidden" name="total_voucher" id="total-voucher-input">
										</div>
									</div>
								</div>

								<div class="flex-w flex-t p-t-27 p-b-33">
									<div class="size-208">
										<br>
										<b class="mtext-101 cl2">
											Total:
										</b>
									</div>

									<div class="size-209 p-t-1">
										<span class="mtext-110 cl2" id="total-all">
											0
										</span>
										<input type="hidden" name="total_all" id="total-all-input">
									</div>
								</div>
								<br>
								<button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer btn btn-primary" type="submit">
									Bayar sekarang
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection

@section('js-content')
    <script>
        $(document).ready(function(){
            getDetailCart();
			$('#gunakan-kupon').on('click', function () {
				var nama_kupon = $('#nama_kupon').val();
				if (nama_kupon != '') {
					$.ajax({
						type: "get",
						url: "{{ route('get-voucher') }}?nama="+nama_kupon,
						success: function (response) {
							console.log(response);
							if (response.data != null) {
								if (response.data.jumlah > 0) {
									$('#used_voucher').val(response.data.id)
									$('#used_voucher_persentase').val(response.data.persentase)
									$('#used_voucher_nominal').val(response.data.nominal)
									$('#div-voucher').removeClass('d-none')
									$('#nama_voucher').html(response.data.nama)
									getDetailCart();
								} else {
									Swal.fire(
										'Perhatian!',
										'Kupon sudah habis',
										'warning'
									);
								}
							} else {
								$('#nama_kupon').val('');
							}
						}
					});
				}
			});

			$('#select-jenis-pengiriman').on('change', function (e) {
				if (e.target.value != '') {
					$('#div-jenis-pengiriman').removeClass('d-none')
				}
			});
        })

        function getDetailCart() {
            $.ajax({
                type: "get",
                url: "{{ route('get-cart') }}",
                data: {},
                success: function (response) {
                    displayDetailCart(response.data);
                }
            });

            function displayDetailCart(carts){
                var row = '';
                var total = '';
				var sub_total = 0
                var total_produk = 0;
                carts.map((data) => {
                    row += `
                    <tr class="table_row">
                        <td class="column-1">
                            <div class="how-itemcart1">
                                <img src="upload/${data.produk_variant.img}" alt="IMG">
                            </div>
                        </td>
                        <td class="column-2">${data.produk_variant.produk.nama_produk}</td>
                        <td class="column-3">Rp. ${formatRupiah(data.produk_variant.price)}</td>
                        <td class="column-4">
                            <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m" data-id="${data.id}" data-type="minus">
                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                </div>

                                <input class="mtext-104 cl3 txt-center num-product" type="number" id="num-product${data.id}" value="${data.qty}" data-id="${data.id}" data-qty="${data.produk_variant.stok}">

                                <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m" data-id="${data.id}" data-type="plus">
                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                </div>
                            </div>
                        </td>
                        <td class="column-5">Rp. ${formatRupiah(data.total)}</td>
                        <td class="colmun-5">
                            <button type="button" class="btn btn-danger btn-sm delete-data" data-redirect="{{ route('delete-cart') }}" data-id="${data.id}" data-token="{{ csrf_token() }}"> <i class="fa fa-trash mr-1"></i> Hapus </button>
                        </td>
                    </tr>
                    `;
					sub_total += parseFloat(data.total);
                });

				$('#sub-total-input').val(sub_total)
				$('#sub-total').html('Rp. ' + formatRupiah(sub_total))
                if ($('#select-jenis-pengiriman').val() != '' && $('#select-jenis-pengiriman').val() != null) {
                    var value_pengiriman = $('#select-jenis-pengiriman').val();
                    var harga_pengiriman = $(`#select-jenis-pengiriman option[value="${value_pengiriman}"]`).data('harga')
                    $('#input_harga_pengiriman').val(harga_pengiriman);
                    sub_total += parseFloat(harga_pengiriman);
                }

                $('#data-produk').html(row);
				$('#total-all').html('Rp. ' + formatRupiah(sub_total))
				$('#total-all-input').val(sub_total)

				if ($('#used_voucher').val() != '' && $('#used_voucher').val() != 0) {
					var persentase = $('#used_voucher_persentase').val()
					var nominal = $('#used_voucher_nominal').val();

					if (persentase != '' && persentase != 0) {
						var total = sub_total - (sub_total * (parseFloat(persentase)/100));
						$('#total-all').html('Rp. ' + formatRupiah(total));
						$('#total-all-input').val(total)
						$('#total-voucher').html('Rp. ' + formatRupiah(sub_total * (parseFloat(persentase)/100)));
						$('#total-voucher-input').val(sub_total * (parseFloat(persentase)/100));
					} else {
						var total = sub_total - parseFloat(nominal);
						$('#total-all').html('Rp. ' + formatRupiah(total));
						$('#total-all-input').val(total)
						$('#total-voucher').html('Rp. ' + formatRupiah(parseFloat(nominal)));
						$('#total-voucher-input').val(parseFloat(nominal));
					}
				}



				$('.delete-data').click(function (e) {
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
									);
									getDetailCart();
								}
							});
						}
					})
				});

				$('.btn-num-product-down, .btn-num-product-up').on('click', function () {
					var id = $(this).data('id');
					var type = $(this).data('type');
					var value = parseInt($('#num-product'+id).val());
					var max_qty = parseInt($('#num-product'+id).data('qty'));

					if (type == 'minus') {
						if (value - 1 <= 0) {
							Swal.fire(
								'Perhatian!',
								'Minimal Jumlah yang diinputkan adalah 1',
								'warning'
							);
							return false;
						}

						$('#num-product'+id).val(value - 1);
						updateCart(id, value - 1)
					} else {
						if (value + 1 > max_qty) {
							Swal.fire(
								'Perhatian!',
								'Maximal varian ini adalah ' + max_qty,
								'warning'
							);
							return false;
						}

						$('#num-product'+id).val(value + 1);
						updateCart(id, value + 1)
					}
				});

                $('#select-jasa-pengiriman').on('change', function () {
                    $.ajax({
						type: "GET",
						url: "{{ route('ongkir-cart') }}?alamat="+$('#alamat').val()+"&type="+$('#select-jasa-pengiriman').val(),
						success: function (response) {
							console.log(JSON.parse(response));
							var data = JSON.parse(response);
							$('#origin_text').html(data.origin_details.type + ' ' + data.origin_details.city_name + ', ' + data.origin_details.province)
							$('#desti_text').html(data.destination_details.type + ' ' + data.destination_details.city_name + ', ' + data.destination_details.province)
							$('#div-jenis-pengiriman').removeClass('d-none');
							var text = '<option value="">Pilih Jenis Pengiriman</option>';
							$.each(data.results[0].costs, function (key, value) {
								text += '<option value="'+value.service+'" data-harga="'+value.cost[0].value+'">'+value.description+' ('+value.service+') - '+value.cost[0].etd+' hari - Rp. '+formatRupiah(value.cost[0].value)+'</option>';
							})
							$('#select-jenis-pengiriman').html(text)
							$('#select-jenis-pengiriman').on('change', function () {
								getDetailCart();
							})
						}
					});
                });

				$('.num-product').on('change', function () {
					var value = parseInt($(this).val());
					var id = $(this).data('id');
					var max_qty = parseInt($(this).data('qty'));
					if (value - 1 <= 0) {
						Swal.fire(
							'Perhatian!',
							'Minimal Jumlah yang diinputkan adalah 1',
							'warning'
						);
						getDetailCart();
						return false;
					} else if (value + 1 > max_qty) {
						Swal.fire(
							'Perhatian!',
							'Maximal varian ini adalah ' + max_qty,
							'warning'
						);
						getDetailCart();
						return false;
					} else {
						updateCart(id, $(this).val())
					}
				});
            }
        }

		function updateCart(id, qty) {
			$.ajax({
				type: 'POST',
				url: "{{ route('update-cart') }}",
				headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
				data: {
					"_token": "{{ csrf_token() }}",
					"id": id,
					"qty": qty,
				},
				beforeSend: function () {
                    Swal.showLoading();
                },
				success: function (data) {
					if (!data.error) {
						Swal.close()
						getDetailCart();
					}
				},
			});
		}

        function formatRupiah(str) {
            return str.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    </script>
@endsection
