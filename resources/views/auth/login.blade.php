@extends('admin.layouts.app')

@section('content')
  <!--start wrapper-->
  <div class="wrapper">
    <div class="container">
      <div class="row">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto" style="margin-top: 10rem">
            <div class="d-flex justify-content-center">
                <img src="{{ asset('img/logo.png') }}" width="200px" height="200px" alt="">
            </div>
          <div class="card radius-10 mt-4">
            <div class="card-body p-4">
              <div class="text-center mt-4">
                <h4>VERTICAL CRAB HOUSE</h4>
                <p>Login Untuk Melanjutkan Ke Sistem</p>
              </div>
              <form class="form-body row g-3" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="col-12">
                  <label for="inputEmail" class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" id="inputEmail">
                </div>
                <div class="col-12">
                  <label for="inputPassword" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" id="inputPassword">
                </div>
                <div class="col-12 col-lg-12">
                  <div class="d-grid">
                    <button type="submit" class="btn text-white" style="background-color: #cc2514">Login</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--end wrapper-->
@endsection
