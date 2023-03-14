@extends('layouts.master')

@section('title')
    Create Sale
@endsection

@section('content')
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4>{{ __('en.Create Sale') }}</h4>
                </div>
            </div>
            <hr>
            <div class="row p-3">
                <div class="shadow-css">
                    <form method="POST" action="{{route('sale-form')}}" enctype="">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="customer_id" class="form-label fs-6">{{ __('en.Customer') }}</label>
                                <div class="input-group input-group-md ">                                    
                                    <select class="form-select bg-grey mb-2 border-dark @error('customer_id') is-invalid @enderror" name="customer_id" id="customer_id" autocomplete="customer_id" required>
                                        <option>{{__('en.Choose')}}</option>
                                        <option value="1" @if(old('customer_id') == 1) 'selected' @endif >{{__('en.Customer')}} 1</option>
                                        <option value="2" @if(old('customer_id') == 2) 'selected' @endif >{{__('en.Customer')}} 2</option>
                                    </select>
                                    @error('customer_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <!-- Button trigger for add customer -->                        
                                    <span class="input-group-text bg-grey mb-2 border-dark"  data-bs-toggle="modal" data-bs-target="#add_customer"><i class="bi fs-6 bi-person-plus-fill"></i></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="product_id" class="form-label fs-6">{{ __('en.Product') }}</label>
                                <select class="form-select bg-grey mb-2 border-dark @error('product_id') is-invalid @enderror" name="product_id" id="product_id" autocomplete="product_id" required>
                                    <option>{{__('en.Choose')}}</option>
                                    <option value="1" @if(old('product_id') == 1) 'selected' @endif >{{__('en.Product')}} 1</option>
                                    <option value="2" @if(old('product_id') == 2) 'selected' @endif >{{__('en.Product')}} 2</option>
                                </select>
                                @error('product_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="qty" class="form-label fs-6">{{ __('en.Quantity') }}</label>
                                <input type="number"
                                    class="form-control bg-grey mb-2 border-dark @error('qty') is-invalid @enderror"
                                    id="qty" name="qty" placeholder="20" value="{{ old('qty') }}"
                                    autocomplete="qty" required autofocus>
                                @error('qty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="sale_price" class="form-label fs-6">{{ __('en.Price') }}</label>
                                <input type="number"
                                    class="form-control bg-grey mb-2 border-dark @error('sale_price') is-invalid @enderror"
                                    id="sale_price" name="sale_price" placeholder="10" value="{{ old('sale_price') }}"
                                    autocomplete="sale_price" required autofocus>
                                @error('sale_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                  
                        @include('pages.table-footer')
                    </form>
                          <!-- Modal itself for add customer -->
                          <div class="modal fade" id="add_customer" tabindex="-1" aria-labelledby="add_customerLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="add_customerLabel">Add Customer</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <label for="first_name" class="form-label fs-6">{{__('en.First Name')}}</label>
                                    <input type="text" class="form-control bg-grey mb-2 border-dark @error('first_name') is-invalid @enderror" id="first_name" name="first_name"
                                        placeholder="First Name" value="{{ old('first_name') }}" autocomplete="first_name" required autofocus>
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label for="last_name" class="form-label fs-6">{{__('en.Last Name')}}</label>
                                    <input type="text" class="form-control bg-grey mb-2 border-dark @error('last_name') is-invalid @enderror" id="last_name" name="last_name"
                                        placeholder="Last Name" value="{{ old('last_name') }}" autocomplete="last_name" required autofocus>
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label for="phone" class="form-label fs-6">{{__('en.Phone')}}</label>
                                    <input type="phone" class="form-control bg-grey mb-2 border-dark @error('phone') is-invalid @enderror" id="phone" name="phone"
                                        placeholder="03001234567" value="{{ old('phone') }}" autocomplete="phone" required autofocus>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label for="email" class="form-label fs-6">{{__('en.Email')}}</label>
                                    <input type="email" class="form-control bg-grey mb-2 border-dark @error('email') is-invalid @enderror" id="email" name="email"
                                        placeholder="03001234567" value="{{ old('email') }}" autocomplete="email" required autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label for="email" class="form-label fs-6">{{__('en.Email')}}</label>
                                    <input type="email" class="form-control bg-grey mb-2 border-dark @error('email') is-invalid @enderror" id="email" name="email"
                                        placeholder="03001234567" value="{{ old('email') }}" autocomplete="email" required autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label for="type" class="form-label fs-6">{{__('en.Type')}}</label>
                                    <select class="form-select bg-grey mb-2 border-dark @error('type') is-invalid @enderror" name="type" id="type" autocomplete="type" required>
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
                            </div>
                            </div>
                        </div>

                        <!-- save button row included below -->
                </div>
            </div>
        </div>
    </div>
@endsection
