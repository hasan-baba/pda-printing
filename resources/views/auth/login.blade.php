@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 login">
            <div class="row">
                <div class="col-md-6 left pb-5 pt-5">
                    <div class="text-center">
                        <img class="" src="{{ asset('/assets/img/invoice-bg.png') }}">
                        <div>
                            <h2 class="text-center description">Turn your ideas into reality</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 right d-flex align-items-center justify-content-center pb-5 pt-5">
                    <div class="">
                        <div class="">
                            <h2> {{ __('Login') }}</h2>
                        </div>

                        <div class="">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="email" class="col-md-12 col-form-label">{{ __('Email Address') }}</label>

                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="col-md-12 col-form-label">{{ __('Password') }}</label>

                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary submit-login">
                                            {{ __('Login') }}
                                        </button>

{{--                                        @if (Route::has('password.request'))--}}
{{--                                            <a class="btn btn-link p-0" href="{{ route('password.request') }}">--}}
{{--                                                {{ __('Forgot Your Password?') }}--}}
{{--                                            </a>--}}
{{--                                        @endif--}}
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
