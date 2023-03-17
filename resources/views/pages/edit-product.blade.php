@extends('layouts.master')

@section('title')
    Edit Product
@endsection

@section('content')
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4>{{ __('en.Edit Product') }}</h4>
                </div>
            </div>
            <hr>
            <div class="row p-3">
                <div class="shadow-css">
                    <form method="POST" action="{{route('product.update',$product->id)}}" enctype="">
                        @method('patch')
                        @csrf
                        <div class="row mt-3">
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="name" class="form-label fs-6">{{ __('en.Name') }}</label>
                                <input type="text"
                                    class="form-control bg-grey mb-2 border-dark @error('name') is-invalid @enderror"
                                    id="name" name="name"  value="{{ old('name',$product->name) }}"
                                    autocomplete="name" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="price" class="form-label fs-6">{{ __('en.Price') }}</label>
                                <input type="number"
                                    class="form-control bg-grey mb-2 border-dark @error('price') is-invalid @enderror"
                                    id="price" name="price"  value="{{ old('price',$product->price) }}"
                                    autocomplete="price" required autofocus>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="sale_price" class="form-label fs-6">{{ __('en.Sale Price') }}</label>
                                <input type="number"
                                    class="form-control bg-grey mb-2 border-dark @error('sale_price') is-invalid @enderror"
                                    id="sale_price" name="sale_price" value="{{ old('sale_price',$product->sale_price) }}"
                                    autocomplete="sale_price" required autofocus>
                                @error('sale_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="stock" class="form-label fs-6">{{ __('en.Stock') }}</label>
                                <input type="number"
                                    class="form-control bg-grey mb-2 border-dark @error('stock') is-invalid @enderror"
                                    id="stock" name="stock" value="{{ old('stock') }}"
                                    autocomplete="stock" required autofocus>
                                @error('stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="stock_alert" class="form-label fs-6">{{ __('en.Stock Alert') }}</label>
                                <input type="number"
                                    class="form-control bg-grey mb-2 border-dark @error('stock_alert') is-invalid @enderror"
                                    id="stock_alert" name="stock_alert" value="{{ old('stock_alert',$product->stock_alert) }}"
                                    autocomplete="stock_alert" required autofocus>
                                @error('stock_alert')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- save button row included below -->
                        @include('pages.table-footer',['link'=>'product.index'])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
