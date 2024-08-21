@extends('user.layouts.app')

@section('content')
	<!-- Shoping Cart -->
	<form class="bg0 p-t-75 p-b-85" action="{{ route('address.user.update',$address->id) }}" method="POST" autocomplete="off">
        @method('PUT')
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
                                <h4>Ubah data alamat</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="" class="form-control-label">Nama Alamat</label>
                                        <input type="text" name="nama_alamat" required class="form form-control mb-3" placeholder="Masukkan nama alamat" value="{{ $address->nama_alamat }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="" class="form-control-label">Alamat</label>
                                        <input type="text" name="alamat" required class="form form-control mb-3" placeholder="Masukkan nama alamat" value="{{ $address->alamat }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="" class="form-control-label">Lat</label>
                                        <input type="text" name="lat" id="latitude" required class="form form-control mb-3" placeholder="Masukkan nama alamat" value="{{ $address->lat }}" readonly>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="" class="form-control-label">Long</label>
                                        <input type="text" name="long" id="longitude" required class="form form-control mb-3" placeholder="Masukkan nama alamat" value="{{ $address->long }}" readonly>
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

    var lat = '{{ $address->lat }}';
    var long = '{{ $address->long }}';

    let map = new L.map('map' , mapOptions);

    let layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
    map.addLayer(layer);

    let marker = L.marker([parseFloat(lat) , parseFloat(long)]).addTo(map);


    map.on('click', (event)=> {

        if(marker !== null){
            map.removeLayer(marker);
        }

        marker = L.marker([event.latlng.lat , event.latlng.lng]).addTo(map);

        document.getElementById('latitude').value = event.latlng.lat;
        document.getElementById('longitude').value = event.latlng.lng;
        
    })
    </script>
@endsection