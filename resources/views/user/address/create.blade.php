@extends('user.layouts.app')

@section('content')
	<!-- Shoping Cart -->
	<form class="bg0 p-t-75 p-b-85" action="{{ route('address.user.store') }}" method="POST" autocomplete="off">
        @csrf
		<div class="container" style="max-width: 1500px!important;">
            <div class="d-flex justify-content-end my-4">
                <a href="{{ route('address.user') }}" class="btn btn-secondary">Kembali</a>
            </div>
			<div class="row">
				<div class="col-lg-12 col-xl-12 m-lr-auto m-b-50">
					<div class="m-l-25 m-lr-0-xl">
						<div class="card">
                            <div class="card-header bg-white" style="border-bottom: 0;">
                                <h4>Tambah data alamat</h4>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-lg-12">
                                        <label class="form-control-label">Provinsi</label>
                                        <select name="provinsi_id" id="provinsi_id" class="form-control border">
                                            <option value="" selected disabled >Pilih Provinsi</option>
                                            @foreach ($provinsi as $prov)
                                                <option value="{{ $prov['province_id'] }}" {{ $provinsi_id == $prov['province_id'] ? 'selected' : '' }}>{{ $prov['province'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-12">
                                        <label class="form-control-label">Kota</label>
                                        <select name="kota_id" id="kota_id" class="form-control border">
                                            @if (empty($provinsi_id))
                                                <option value="" selected disabled >Pilih Provinsi Terlebih Dahulu</option>
                                            @else
                                                @foreach ($kota as $k)
                                                    <option value="{{ $k['city_id'] }}">{{ $k['type'] }} {{ $k['city_name'] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <i>Pilih Provinsi dan Kota Terlebih Dahulu <span class="text-danger" >*</span></i>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="" class="form-control-label">Nama Alamat</label>
                                        <input type="text" name="nama_alamat" required class="form form-control mb-3" placeholder="Masukkan nama alamat">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="" class="form-control-label">Alamat</label>
                                        <input type="text" name="alamat" required class="form form-control mb-3" placeholder="Masukkan nama alamat">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="" class="form-control-label">Lat</label>
                                        <input type="text" name="lat" id="latitude" required class="form form-control mb-3" placeholder="Masukkan nama alamat" readonly>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="" class="form-control-label">Long</label>
                                        <input type="text" name="long" id="longitude" required class="form form-control mb-3" placeholder="Masukkan nama alamat" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-5">
                                        <div id="map" style="width: 100%;height: 500px;border-radius: 10px;"></div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</form>
@endsection

@section('js-content')
    <script>

    let mapOptions = {
        center:[-8.6644936, 115.1533424],
        zoom:10
    }

    let map = new L.map('map' , mapOptions);

    let layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
    map.addLayer(layer);


    let marker = null;
    map.on('click', (event)=> {

        if(marker !== null){
            map.removeLayer(marker);
        }

        marker = L.marker([event.latlng.lat , event.latlng.lng]).addTo(map);

        document.getElementById('latitude').value = event.latlng.lat;
        document.getElementById('longitude').value = event.latlng.lng;

    })

    $(document).ready(function () {
            $('#provinsi_id').on('change', function(e) {
                window.location.href = "{{ route('address.user.create') }}?provinsi_id=" + e.target.value;
            })
        })
    </script>
@endsection
