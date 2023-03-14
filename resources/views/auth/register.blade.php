@extends('layouts.app')

@section('content')


<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="log-in d-flex justify-content-center" style="background-image: url(/auth/log-in.jpg);">
        <div class="sign-in-css bg-light my-4">

            @include('auth.logo')

            <div class="row text-center">
                <h3>{{__('en.Sign Up')}} </h3>
            </div>
            <div class="row m-2 ">
                <div class="col-12">
                    <label for="username" class="form-label fs-6">{{__('en.Username')}}</label>
                </div>
                <div class="col-12">
                    <input id="username" type="text" placeholder="Imran Khan" class="form-control @error('username') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="username" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
            </div>
            <div class="row m-2 ">
                <div class="col-12">
                    <label for="email-address" class="form-label fs-6">{{__('en.Email Address')}}</label>
                </div>
                <div class="col-12">
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Abc123@example.com" aria-label="email-address">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
            </div>
            <div class="row m-2 ">
                <div class="col-12">
                    <label for="password" class="form-label fs-6">{{__('en.Password')}}</label>
                </div>
                <div class="col-12">
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus placeholder="******" aria-label="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
            </div>
            <div class="row m-2 mb-3">
                <div class="col-12">
                    <label for="re-enter-password" class="form-label fs-6">{{__('en.Re-Enter Password')}}</label>
                </div>
                <div class="col-12">
                    <input id="password-confirm" type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="password_confirmation" required value="{{ old('confirm_password') }}" autocomplete="new-password" autofocus placeholder="******" aria-label="new-password">

                    @error('confirm_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror


                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-8">
                    <button type="submit" class="btn btn-success rounded-pill w-100">
                        {{ __('en.Register Now') }}
                    </button>
                </div>
            </div>
            <div class="row my-2 text-center">
                <p class="anchor-css">{{ __('en.Already have an account?') }}</p>
            </div>
            <div class="row mb-4 justify-content-center">
                <div class="col-8">
                    <a href="{{route('login')}}" class="btn btn-danger rounded-pill w-100">{{ __('en.Sign In') }}</a>
                </div>
            </div>
        </div>
    </div>

</form>
@endsection
