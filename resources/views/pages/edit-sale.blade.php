@extends('layouts.master')

@section('title')
    Edit Sale
@endsection

@section('content')
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4>{{ __('en.Edit Sale') }}</h4>
                </div>
            </div>
            <hr>
            <div class="row p-3">
                <div class="shadow-css">
                    <form method="POST" action="{{route('sale.update',1)}}" enctype="">
                        @method('patch')
                        @csrf
                        <div class="row mt-3">
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="user_id" class="form-label fs-6">{{ __('en.Customer') }}</label>
                                <select class="form-select bg-grey mb-2 border-dark @error('user_id') is-invalid @enderror" name="user_id" id="user_id" autocomplete="user_id" required>
                                    <option>{{__('en.Choose')}}</option>
                                    <option value="1" @if(old('user_id') == 1) 'selected' @endif selected>{{__('en.Customer')}} 1</option>
                                    <option value="2" @if(old('user_id') == 2) 'selected' @endif >{{__('en.Customer')}} 2</option>
                                </select>
                                @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="product_id" class="form-label fs-6">{{ __('en.Product') }}</label>
                                <select class="form-select bg-grey mb-2 border-dark @error('product_id') is-invalid @enderror" name="product_id" id="product_id" autocomplete="product_id" required>
                                    <option>{{__('en.Choose')}}</option>
                                    <option value="1" @if(old('product_id') == 1) 'selected' @endif >{{__('en.Product')}} 1</option>
                                    <option value="2" @if(old('product_id') == 2) 'selected' @endif selected>{{__('en.Product')}} 2</option>
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
                                    id="qty" name="qty" value="20" value="{{ old('qty') }}"
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
                                    id="sale_price" name="sale_price" value="10" value="{{ old('sale_price') }}"
                                    autocomplete="sale_price" required autofocus>
                                @error('sale_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- save button row included below -->
                        @include('pages.table-footer',['link'=>'sale.index'])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
