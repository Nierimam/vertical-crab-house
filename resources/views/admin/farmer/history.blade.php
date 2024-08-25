@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0">History Farmer</h5>
                <form class="ms-auto position-relative">
                    <div class="position-absolute top-50 translate-middle-y search-icon px-3"><ion-icon
                            name="search-sharp"></ion-icon></div>
                    <input class="form-control ps-5" type="text" placeholder="search">
                </form>
            </div>
            <div class="table-responsive mt-3">
                <table class="table align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>Datetime</th>
                            <th>Dissolved Oxygen</th>
                            <th>Nitrite</th>
                            <th>PH</th>
                            <th>Salinity</th>
                            <th>Temperature</th>
                            <th>Total Ammonia Nitrogen</th>
                            <th>Unionized Ammonia</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataHistorys as $dataHistory)
                            <tr>
                                <td>{{ date('d M Y',strtotime($dataHistory['Date'])) }} {{ $dataHistory['Time'] }}</td>
                                <td>{{ $dataHistory['dissolved_oxygen'] }}</td>
                                <td>{{ $dataHistory['nitrite'] }}</td>
                                <td>{{ $dataHistory['ph'] }}</td>
                                <td>{{ $dataHistory['salinity'] }}</td>
                                <td>{{ $dataHistory['temperature'] }}</td>
                                <td>{{ $dataHistory['total_ammonia_nitrogen'] }}</td>
                                <td>{{ $dataHistory['unionized_ammonia'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
