@extends('layouts.master')

@section('title')
    Edit Expense
@endsection

@section('content')
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4>{{ __('en.Edit Expense') }}</h4>
                </div>
            </div>
            <hr>
            <div class="row p-3">
                <div class="shadow-css">
                    <form method="POST" action="{{route('expense.update',$expense->id)}}" enctype="">
                        @method('patch')
                        @csrf
                        <div class="row mt-3">
                            {{-- <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="customer_id" class="form-label fs-6">{{ __('en.Customer') }}</label>
                                <select class="form-select mb-2 border-dark @error('customer_id') is-invalid @enderror" name="customer_id" id="customer_id" autocomplete="customer_id" required>
                                    <option>{{__('en.Choose')}}</option>
                                    <option value="1" @if(old('customer_id') == 1) 'selected' @endif >{{__('en.Customer')}} 1</option>
                                    <option value="2" @if(old('customer_id') == 2) 'selected' @endif >{{__('en.Customer')}} 2</option>
                                </select>
                                @error('customer_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}
                            {{-- <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="product_id" class="form-label fs-6">{{ __('en.Product') }}</label>
                                <select class="form-select mb-2 border-dark @error('product_id') is-invalid @enderror" name="product_id" id="product_id" autocomplete="product_id" required>
                                    <option>{{__('en.Choose')}}</option>
                                    <option value="1" @if(old('product_id') == 1) 'selected' @endif >{{__('en.Product')}} 1</option>
                                    <option value="2" @if(old('product_id') == 2) 'selected' @endif >{{__('en.Product')}} 2</option>
                                </select>
                                @error('product_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="name" class="form-label fs-6">{{ __('en.Name') }}</label>
                                <input type="text"
                                    class="form-control mb-2 border-dark @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name',$expense->name) }}"
                                    autocomplete="name" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="amount" class="form-label fs-6">{{ __('en.Amount') }}</label>
                                <input type="number" min="1"
                                    class="form-control mb-2 border-dark @error('amount') is-invalid @enderror"
                                    id="amount" name="amount" value="{{ old('amount',$expense->amount) }}"
                                    autocomplete="amount" required autofocus>
                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="date" class="form-label fs-6">{{ __('en.Date') }}</label>
                                <input type="date"
                                    class="form-control mb-2 border-dark @error('date') is-invalid @enderror"
                                    id="date" name="date" value="{{ old('date',$expense->date) }}"
                                    autocomplete="date" required autofocus>
                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- save button row included below -->
                        @include('pages.table-footer',['link'=>'expense.index'])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
