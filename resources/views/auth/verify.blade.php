@extends('layouts.app')

@section('content')

<div class="log-in d-flex justify-content-center" style="background-image: url(/auth/log-in.jpg);">

    <div class="sign-in-css bg-light my-4">
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf

            @include('auth.logo')
            <div class="row offset-1 col-10">
                @if (session('resent'))
                <div class="alert alert-success text-center" role="alert">
                    {{ __('en.A fresh verification link has been sent to your email address.') }}
                </div>
                @endif
            </div>

            <div class="card border-white">
                <div class="card-body">
                  <h5 class="card-title">{{ __('en.Send Activation Link') }} </h5>
                  <p class="card-text text-center"> {{ __('en.Before proceeding, please check your email for a verification link.') }}
                    {{ __('en.If you did not receive the email') }}.</p>
                </div>
              </div>

            <div class="row mt-4 justify-content-center h5 mb-4 ">
                <div class="col-6 text-cneter">
                    <p class="text-center">
                        <button type="submit" class="btn btn-success rounded-pill w-100 ">{{ __('en.click here to request another') }}</button>
                    </p>
                </div>
            </div>

        </form>
    </div>
</div>

@endsection

