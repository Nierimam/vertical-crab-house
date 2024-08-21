@extends('user.layouts.app')

@section('content')

    <!-- Ec login page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-title">Log In</h2>
                        <p class="sub-title mb-3">Login untuk dapat melakukan pembelian</p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="ec-login-wrapper">
                        <div class="ec-login-container">
                            <div class="ec-login-form">
                                <form action="{{ route('login') }}" method="post">
                                @csrf
                                    <span class="ec-login-wrap">
                                        <label>Email Address*</label>
                                        <input type="email" class="form-control" name="email" placeholder="Enter your email add..." required />
                                        @error('email')
                                            <div style="margin-top: -10px">
                                                <span class="text-danger" style="font-size: 11px">{{ $message }}</span> <br>
                                            </div>
                                        @enderror
                                    </span><br><br>
                                    <span class="ec-login-wrap">
                                        <label>Password*</label>
                                        <input type="password" class="form-control" name="password" placeholder="Enter your password" required />
                                    </span><br><br>
                                    <span class="ec-login-wrap ec-login-btn">
                                        <button class="btn btn-primary" type="submit">Login</button>
                                        <a href="{{ route('form.register.user') }}" class="btn btn-secondary">Register</a>
                                    </span>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


