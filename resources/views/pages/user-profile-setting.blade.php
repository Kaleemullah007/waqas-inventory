@extends('layouts.master')

@section('title')
    Profile Setting
@endsection
@section('content')
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4>{{ __('en.Profile Setting') }}</h4>
                </div>
            </div>
            <hr>
            @include('message')
            <form method="POST" action="{{route('profile-update')}}" enctype="multipart/form-data">
                @csrf
                <div class="row d-flex justify-content-around mt-3">
                    <div class="col-lg-9 col-12">
                        <div class="row d-flex">
                            <div class="col-lg-6 col-md-6 col-12 pt-2">
                                <label for="firstName" class="form-label pt-1 fs-6">{{ __('en.First Name') }}</label>
                                <input type="text"
                                    class="form-control border-dark  @error('firstName') is-invalid @enderror"
                                     id="firstName" name="firstName" value="{{ old('firstName',auth()->user()->name) }}"
                                    autocomplete="firstName" required autofocus>
                                @error('firstName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 pt-2">
                                <label for="lastName" class="form-label pt-1 fs-6">{{ __('en.Last Name') }}</label>
                                <input type="text"
                                    class="form-control border-dark  @error('lastName') is-invalid @enderror"
                                    value="last name" id="lastName" name="lastName" value="{{ old('lastName',auth()->user()->name) }}"
                                    autocomplete="lastName" required autofocus>
                                @error('lastName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 pt-2">
                                <label for="dob" class="form-label pt-1 fs-6">{{ __('en.Date of Birth') }}</label>
                                <input type="date" class="form-control  @error('dob') is-invalid @enderror"
                                    id="dob" name="dob" value="{{ old('dob',date('Y-m-d')) }}"
                                    autocomplete="dob" required autofocus>
                                @error('dob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 pt-2">
                                <label for="status" class="form-label pt-1 fs-6">{{ __('en.Status') }}</label>
                                <div class="fw-bold">
                                    <input type="checkbox" class="" data-toggle="toggle" data-onstyle="success"
                                        data-offstyle="danger" checked data-size="sm" data-on="Active" data-off="Inactive">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 pt-2">
                                <label for="password" class="form-label pt-1 fs-6">{{ __('en.Password') }}</label>
                                <input type="password" class="form-control  @error('password') is-invalid @enderror"
                                    minlength="8" value="" id="password" name="password"
                                    value="{{ old('password') }}" autocomplete="password" >
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 pt-2">
                                <label for="conPassword"
                                    class="form-label pt-1 fs-6">{{ __('en.Confirm Password') }}</label>
                                <input type="password" class="form-control  @error('conPassword') is-invalid @enderror"
                                    minlength="8" value="" id="conPassword" name="conPassword"
                                    value="{{ old('conPassword') }}" autocomplete="conPassword" >
                                @error('conPassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- <div class="col-lg-6 col-md-6 col-12 pt-2">
                                <label for="secQuestionOne"
                                    class="form-label pt-1 fs-6">{{ __('en.What was the City you born in?') }}</label>
                                <input type="text" class="form-control  @error('secQuestionOne') is-invalid @enderror"
                                    id="secQuestionOne" name="secQuestionOne"
                                    value="{{ old('secQuestionOne',auth()->user()->address) }}" autocomplete="secQuestionOne" required autofocus>
                                @error('secQuestionOne')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}
                            {{-- <div class="col-lg-6 col-md-6 col-12 pt-2">
                                <label for="secQuestionTwo"
                                    class="form-label pt-1 fs-6">{{ __('en.What is the City you are living in?') }}</label>
                                <input type="text" class="form-control  @error('secQuestionTwo') is-invalid @enderror"
                                    value="Islamabad" id="secQuestionTwo" name="secQuestionTwo"
                                    value="{{ old('secQuestionTwo') }}" autocomplete="secQuestionTwo" required autofocus>
                                @error('secQuestionTwo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 ">
                        <img class="img img-thumbnail mt-4 mb-2 d-block mx-auto" src="/assets/images/user1.png"
                            alt="">
                        <div class="d-flex justify-content-center">
                            <input type="file"
                                class="w-75 mt-4 form-control float-center  @error('profileImg') is-invalid @enderror"
                                id="profileImg" name="profileImg" value="{{ old('profileImg') }}"
                                autocomplete="profileImg" required>
                        </div>
                    </div>
                </div>
                <div class="row p-2 mt-4">
                    <div class="col-lg-12 col-12 shadow-css">
                        <div class="row bg-grey py-3">
                            <h5>{{ __('en.General Setting') }}</h5>
                        </div>
                        <div class="row py-2 pb-4">
                            <div class="col-lg-4 col-md-6 col-12 mt-2">
                                <label for="currency" class="form-label  fs-6">{{ __('en.Currency') }}</label>
                                <select class="form-select mb-2 border-dark @error('currency') is-invalid @enderror"
                                    name="currency" id="currency" autocomplete="currency" required>
                                    <option value="1" @if (old('currency') == 1) 'selected' @endif>US Dollar
                                    </option>
                                    <option value="2" @if (old('currency') == 2) 'selected' @endif>PKR
                                    </option>
                                </select>
                                @error('currency')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mt-2">
                                <label for="date_format" class="form-label  fs-6">{{ __('en.Date Format') }}</label>
                                <select class="form-select mb-2 border-dark @error('date_format') is-invalid @enderror"
                                    name="date_format" id="date_format" autocomplete="date_format" required>

                                    <option value="1" @if (old('date_format') == 1) 'selected' @endif>dd-mm-yyyy
                                    </option>
                                    <option value="2" @if (old('date_format') == 2) 'selected' @endif>mm-dd-yyyy
                                    </option>
                                </select>
                                @error('date_format')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mt-2">
                                <label for="logo" class="form-label  fs-6">{{ __('en.Logo') }}</label>
                                <input type="file"
                                    class="form-control border-dark  @error('logo') is-invalid @enderror"
                                    id="logo" name="logo" value="{{ old('logo') }}"
                                    autocomplete="logo" required autofocus>
                                @error('logo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mt-2">
                                <label for="current_template" class="form-label  fs-6">{{ __('en.Current Template') }}</label>
                                <select class="form-select mb-2 border-dark @error('current_template') is-invalid @enderror"
                                    name="current_template" id="current_template" autocomplete="current_template" required>

                                    <option value="view-sale" @if (old('current_template') == 1) 'selected' @endif>Template 1
                                    </option>
                                    <option value="view-sale1" @if (old('current_template') == 2) 'selected' @endif>Template 2
                                    </option>
                                </select>
                                @error('current_template')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mt-2">
                                <label for="business_phone" class="form-label  fs-6">{{ __('en.Business Phone') }}</label>
                                <input type="text"
                                    class="form-control border-dark  @error('business_phone') is-invalid @enderror"
                                    id="business_phone" name="business_phone" placeholder="+923001234567" value="{{ old('business_phone',auth()->user()->business_phone) }}"
                                    autocomplete="business_phone" required autofocus>
                                @error('business_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mt-2">
                                <label for="business_email" class="form-label  fs-6">{{ __('en.Business Email') }}</label>
                                <input type="email"
                                    class="form-control border-dark  @error('business_email') is-invalid @enderror"
                                    id="business_email" name="business_email" placeholder="abc123@example.com" value="{{ old('business_email',auth()->user()->business_email) }}"
                                    autocomplete="business_email" required autofocus>
                                @error('business_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-8 col-12 mt-2">
                                <label for="address" class="form-label  fs-6">{{ __('en.Address') }}</label>
                                <input type="text"
                                    class="form-control border-dark  @error('address') is-invalid @enderror"
                                    id="address" name="address" placeholder="236, chemin Hortense Berger" value="{{ old('address',auth()->user()->address) }}"
                                    autocomplete="address" required autofocus>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>
                <!-- save button row included below -->
                @include('pages.table-footer', ['link' => 'user-profile-setting'])
            </form>
        </div>
    </div>
@endsection
