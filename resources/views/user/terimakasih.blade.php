@extends('user.layouts.app')

@section('content')
    <div class="text-center" style="margin-top: 5rem;margin-bottom: 5rem">
        <div>
            <img src="{{ asset('img/check.png') }}" width="300px" alt="">
        </div>
        <div class="mt-4">
            <h1>Terimkasih Sudah Berbelanja</h1>
        </div>
        <div class="mt-4">
            <a href="{{ route('listorder.user') }}" class="btn btn-primary">Kembali</a>
        </div>
    </div>
@endsection
