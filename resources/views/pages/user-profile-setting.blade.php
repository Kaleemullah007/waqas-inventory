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
            <form method="POST" action="" enctype="">
                <div class="row d-flex justify-content-around mt-3">
                    <div class="col-lg-9 col-12">
                        <div class="row d-flex">
                            <div class="col-lg-6 col-md-6 col-12 pt-2">
                                <label for="firstName" class="form-label pt-1 fs-6">{{ __('en.First Name') }}</label>
                                <input type="text"
                                    class="form-control bg-grey border-1px-css  @error('firstName') is-invalid @enderror"
                                    value="First name" id="firstName" name="firstName" value="{{ old('firstName') }}"
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
                                    class="form-control bg-grey border-1px-css  @error('lastName') is-invalid @enderror"
                                    value="last name" id="lastName" name="lastName" value="{{ old('lastName') }}"
                                    autocomplete="lastName" required autofocus>
                                @error('lastName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 pt-2">
                                <label for="dob" class="form-label pt-1 fs-6">{{ __('en.Date of Birth') }}</label>
                                <input type="date" class="form-control bg-grey  @error('dob') is-invalid @enderror"
                                    value="Admin" id="dob" name="dob" value="{{ old('dob') }}"
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
                                <input type="password" class="form-control bg-grey  @error('password') is-invalid @enderror"
                                    minlength="8" value="Pass1234" id="password" name="password"
                                    value="{{ old('password') }}" autocomplete="password" required autofocus>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 pt-2">
                                <label for="conPassword"
                                    class="form-label pt-1 fs-6">{{ __('en.Confirm Password') }}</label>
                                <input type="password"
                                    class="form-control bg-grey  @error('conPassword') is-invalid @enderror" minlength="8"
                                    value="Pass1234" id="conPassword" name="conPassword" value="{{ old('conPassword') }}"
                                    autocomplete="conPassword" required autofocus>
                                @error('conPassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 pt-2">
                                <label for="secQuestionOne"
                                    class="form-label pt-1 fs-6">{{ __('en.What was the City you born in?') }}</label>
                                <input type="text"
                                    class="form-control bg-grey  @error('secQuestionOne') is-invalid @enderror"
                                    value="Lahore" id="secQuestionOne" name="secQuestionOne"
                                    value="{{ old('secQuestionOne') }}" autocomplete="secQuestionOne" required autofocus>
                                @error('secQuestionOne')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 pt-2">
                                <label for="secQuestionTwo"
                                    class="form-label pt-1 fs-6">{{ __('en.What is the City you are living in?') }}</label>
                                <input type="text"
                                    class="form-control bg-grey  @error('secQuestionTwo') is-invalid @enderror"
                                    value="Islamabad" id="secQuestionTwo" name="secQuestionTwo"
                                    value="{{ old('secQuestionTwo') }}" autocomplete="secQuestionTwo" required autofocus>
                                @error('secQuestionTwo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 ">
                        <img class="img img-thumbnail mt-4 mb-2 d-block mx-auto" src="/assets/images/user1.png"
                            alt="">
                        <div class="d-flex justify-content-center">
                            <input type="file"
                                class="w-75 mt-4 form-control bg-grey float-center  @error('profileImg') is-invalid @enderror"
                                id="profileImg" name="profileImg" value="{{ old('profileImg') }}"
                                autocomplete="profileImg" required>
                        </div>
                    </div>
                </div>
                <!-- save button row included below -->
                @include('pages.table-footer')
            </form>
        </div>
    </div>
@endsection
