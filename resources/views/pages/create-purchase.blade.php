@extends('layouts.master')

@section('title')
    Create Purchase
@endsection

@section('content')
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4>{{ __('en.Create Purchase') }}</h4>
                </div>
            </div>
            <hr>
            <div class="row p-3">
                <div class="shadow-css">
                    <form method="POST" action="{{route('purchase.store')}}" enctype="">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="user_id" class="form-label  fs-6">{{ __('en.Vendor') }}</label>
                                <div class="input-group input-group-md d-flex">
                                    <select class="form-select mb-2 border-dark select2 @error('user_id') is-invalid @enderror" name="user_id" id="user_id" autocomplete="user_id" required>
                                        <option>{{__('en.Choose')}}</option>
                                        @foreach ($vendors as $vendor)
                                            <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <!-- Button trigger for add vendor -->
                                    <span class=" mb-2 ps-2"  data-bs-toggle="modal" data-bs-target="#add_vendor"><i class="bi fs-4 bi-person-plus-fill"></i></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="name" class="form-label fs-6">{{ __('en.Name') }}</label>
                                <input type="text"
                                    class="form-control mb-2 border-dark @error('Name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Name" value="{{ old('name') }}"
                                    autocomplete="Name" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="qty" class="form-label fs-6">{{ __('en.Quantity') }}</label>
                                <input type="number" min="1"
                                    class="form-control mb-2 border-dark @error('qty') is-invalid @enderror"
                                    id="qty" name="qty" placeholder="20" value="{{ old('qty') }}"
                                    autocomplete="qty" required autofocus>
                                @error('qty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="price" class="form-label fs-6">{{ __('en.Price') }}</label>
                                <input type="number" min="1"
                                    class="form-control mb-2 border-dark @error('price') is-invalid @enderror"
                                    id="price" name="price" placeholder="8" value="{{ old('price') }}"
                                    autocomplete="price" required autofocus>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="sale_price" class="form-label fs-6">{{ __('en.Sale Price') }}</label>
                                <input type="number" min="1"
                                    class="form-control mb-2 border-dark @error('sale_price') is-invalid @enderror"
                                    id="sale_price" name="sale_price" placeholder="10" value="{{ old('sale_price') }}"
                                    autocomplete="sale_price" required autofocus>
                                @error('sale_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- save button row included below -->
                        @include('pages.table-footer',['link'=>'purchase.index'])
                    </form>

                    
                          <!-- Modal itself for add Vendor -->
                          <div class="modal fade" id="add_vendor" tabindex="-1" aria-labelledby="add_vendorLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form method="POST" action="" enctype="">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="add_vendorLabel">Add Vendor</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label for="first_name" class="form-label fs-6">{{__('en.First Name')}}</label>
                                        <input type="text" class="form-control mb-2 border-dark @error('first_name') is-invalid @enderror" id="first_name" name="first_name"
                                            placeholder="First Name" value="{{ old('first_name') }}" autocomplete="first_name" required autofocus>
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <label for="last_name" class="form-label fs-6">{{__('en.Last Name')}}</label>
                                        <input type="text" class="form-control mb-2 border-dark @error('last_name') is-invalid @enderror" id="last_name" name="last_name"
                                            placeholder="Last Name" value="{{ old('last_name') }}" autocomplete="last_name" required autofocus>
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <label for="phone" class="form-label fs-6">{{__('en.Phone')}}</label>
                                        <input type="phone" class="form-control mb-2 border-dark @error('phone') is-invalid @enderror" id="phone" name="phone"
                                            placeholder="03001234567" value="{{ old('phone') }}" autocomplete="phone" required autofocus>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <label for="email" class="form-label fs-6">{{__('en.Email')}}</label>
                                        <input type="email" class="form-control mb-2 border-dark @error('email') is-invalid @enderror" id="email" name="email"
                                            placeholder="abc123@example.com" value="{{ old('email') }}" autocomplete="email" required autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <label for="type" class="form-label fs-6">{{__('en.Type')}}</label>
                                        <select class="form-select mb-2 border-dark @error('type') is-invalid @enderror" name="type" id="type" autocomplete="type" required>
                                            <option value="1" @if(old('type') == 1) 'selected' @endif selected>{{__('en.Customer')}}</option>
                                            <option value="2" @if(old('type') == 2) 'selected' @endif >{{__('en.Vendor')}}</option>
                                        </select>
                                        @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="modal-footer">
                                        <!-- save button row included below -->
                                        @include('pages.modal-footer')
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
