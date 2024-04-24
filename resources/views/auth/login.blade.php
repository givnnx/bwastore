@extends('layouts.auth')

@section('titles')
    Store Login
@endsection

@section('content')
    <div class="page-content page-auth">
        <div class="section-store-auth" data-aos="fade-up">
            <div class="container">
                <div class="row align-items-center row-login">
                    <div class="col-lg-6 text-center">
                        <img src="/images/login-placeholder.png" class="w-50 mb-4 mb-lg-none" alt="">
                    </div>
                    <div class="col-lg-5">
                        <h2>
                            Belanja kebutuhan utama,<br>
                            menjadi lebih mudah
                        </h2>
                        <form method="POST" action="{{ route('login') }}" class="mt-3">
                            @csrf
                            <div class="form-group">
                                <label for="">Email Address</label>
                                <input id="email" class="form-control w-75" type="email" name="email"
                                    :value="old('email')" required autofocus autocomplete="username" />
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input id="password" class="form-control w-75" type="password" name="password" required
                                    autocomplete="current-password" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <button type="submit" class="btn btn-success btn-block w-75 mt-4">Sign In to My
                                Account</button>
                            <a href="{{ route('register') }}" class="btn btn-signup btn-block w-75 mt-2">Sign Up</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
