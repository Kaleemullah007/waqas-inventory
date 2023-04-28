@extends('layouts.master')

@section('title')
    Create Customer
@endsection

@section('content')
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4>{{ __('en.Create Customer') }}</h4>
                </div>
            </div>
            <hr>
            <div class="row p-3">
                <div class="shadow-css">
                    @include('message')
                    <form method="POST" action="{{ route('customer.store') }}" enctype="">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="first_name" class="form-label fs-6">{{ __('en.First Name') }}</label>
                                <input type="text"
                                    class="form-control mb-2 border-dark @error('first_name') is-invalid @enderror"
                                    id="first_name" name="first_name" placeholder="First Name"
                                    value="{{ old('first_name') }}" autocomplete="first_name" required autofocus>
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="last_name" class="form-label fs-6">{{ __('en.Last Name') }}</label>
                                <input type="text"
                                    class="form-control mb-2 border-dark @error('last_name') is-invalid @enderror"
                                    id="last_name" name="last_name" placeholder="Last Name"
                                    value="{{ old('last_name') }}" autocomplete="last_name" required autofocus>
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="phone" class="form-label fs-6">{{ __('en.Phone') }}</label>
                                <input type="phone"
                                    class="form-control mb-2 border-dark @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" placeholder="03001234567"
                                    value="{{ old('phone') }}" autocomplete="phone" required autofocus>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="email" class="form-label fs-6">{{ __('en.Email') }}</label>
                                <input type="email"
                                    class="form-control mb-2 border-dark @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="abc123@example.com"
                                    value="{{ old('email') }}" autocomplete="email" required autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- save button row included below -->
                        @include('pages.table-footer', ['link' => 'customer.index'])
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
