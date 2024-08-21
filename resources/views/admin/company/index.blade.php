@extends('admin.layouts.app')

@section('title')
    Setting Company
@endsection

@section('content')
<div class="col-span-12 my-6">
  <div class="flex justify-content-between justify-between">
      <h2 class="text-lg font-medium truncate">Data List Setting Company</h2>
  </div>
  {{-- <div class="intro-y col-span-12 flex justify-between flex-wrap sm:flex-no-wrap items-center mt-2">
      <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
          <div class="w-56 relative text-gray-700">
              <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
              <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
          </div>
      </div>
    <a href="{{route('company.create')}}" class="button w-36 mb-2 mr-2 mt-2 flex items-center justify-center bg-theme-1 text-white"> <i data-feather="plus" class="w-4 h-4 mr-2"></i> Tambah Data </a>
  </div> --}}
</div>
<!-- BEGIN: Data List -->
<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
  <table class="table table-report -mt-2">
      <thead>
          <tr>
              <th class="whitespace-no-wrap">No</th>
              <th class="whitespace-no-wrap">Nama</th>
              <th class="whitespace-no-wrap">Telp</th>
              <th class="whitespace-no-wrap">Alamat</th>
              <th class="whitespace-no-wrap">Logo</th>
              <th class="text-center whitespace-no-wrap">Aksi</th>
          </tr>
      </thead>
      @php
         $index = 0
      @endphp
      <tbody>
          @if(count($company) > 0)
          @foreach ($company as $data)
          <tr class="intro-x">
              <td class="w-10">{{ ++$index }}</td>
              <td class="w-20">{{ ucfirst($data->nama) }}</td>
              <td class="w-20">+{{ $data->telp }}</td>
              <td class="w-20">{{ $data->alamat }}</td>
              <td class="w-20">
                <a class="fancybox" id="basic-addon2" data-caption="{{ucfirst($data->nama)}}" href="{{asset('upload/'.$data->logo)}}">
                    <img src="{{asset('upload/'.$data->logo)}}" style="width: 50px; height:50px; border-radius:7px; margin: 0 3px; " alt="">
                  </a>
              </td>
              <td class="table-report__action w-10">
                  <div class="flex justify-center items-center">
                    <a class="flex items-center mr-3" href="{{ route('company.edit', $data->id) }}"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                    <a class="flex items-center mr-3 text-theme-3" href="{{ route('company.show',$data->id) }}"> <i data-feather="alert-circle" class="w-4 h-4 mr-1"></i> Detail </a>
                    {{-- <button type="button" class="flex items-center text-theme-6 delete-data" data-redirect="{{route('company.destroy',$data->id)}}" data-id="{{ $data->id }}" data-token="{{ csrf_token() }}"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Hapus </button --}}
                  </div>
              </td>
          </tr>
          @endforeach
          @else
            <tr>
                <td class="intro-x text-center" colspan="6">Tidak terdapat data Company Setting</td>
            </tr>
            @endif
      </tbody>
  </table>
</div>
<!-- END: Data List -->
@endsection
