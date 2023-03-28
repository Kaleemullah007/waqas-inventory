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
                    @include('message')
                    <form method="POST" action="{{route('sale.update',$sale->id)}}" enctype="">
                        @method('patch')
                        @csrf
                            <div class="row mt-3">
                                @php
                                $counter = 1;
                            @endphp
                            <div class="setting">
                                <div class="setting-row row d-flex " id="setting-row{{ $counter }}">
                                    <span class='totalrecord-settings'></span>
                                    <div class="col-lg-4 col-md-6 col-12 pt-1">
                                        <label for="product_id" class="form-label fs-6">{{ __('en.Product') }}</label>
                                        <select class="form-select border-dark @error('product_id') is-invalid @enderror"
                                            name="products[{{ $counter }}][product_id]"
                                            id="{{ $counter }}-product_id" autocomplete="product_id" required
                                            onchange="getPrice()">
                                            <option>{{ __('en.Choose') }}</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('product_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12 pt-1">
                                        <label for="qty" class="form-label fs-6">{{ __('en.Quantity') }}</label>
                                        <input type="number" min="1"
                                            class="form-control calculation mb-2 border-dark @error('qty') is-invalid @enderror"
                                            id="{{ $counter }}-qty" name="products[{{ $counter }}][qty]"
                                            placeholder="20" value="{{ old('qty', 1) }}" autocomplete="qty" required
                                            autofocus onkeyup="calcualtePrice()" min="1">
                                        @error('qty')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-2 col-md-6 col-12 pt-1">
                                        <label for="sale_price" class="form-label fs-6">{{ __('en.Price') }}</label>
                                        <input type="number" min="1"
                                            class="form-control calculation mb-2 border-dark @error('sale_price') is-invalid @enderror"
                                            id="{{ $counter }}-sale_price"
                                            name="products[{{ $counter }}][sale_price]" placeholder="10"
                                            value="{{ old('sale_price') }}" autocomplete="sale_price" required autofocus
                                            onkeyup="calcualtePrice()" min="0">
                                        @error('sale_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-2 col-md-6 col-12 d-flex align-items-end mb-2"
                                        id="setting-row{{ $counter }}-btn">
                                        <a href="#" class="btn btn-success" id="setting-row{{ $counter }}-href"
                                            onclick="addSetting({{ $counter }})"><i class="bi bi-plus-lg"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="user_id" class="form-label fs-6">{{ __('en.Customer') }}</label>
                                <select class="form-select mb-2 border-dark @error('user_id') is-invalid @enderror" name="user_id" id="user_id" autocomplete="user_id" required>
                                    <option>{{__('en.Choose')}}</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{$customer->id}}" @selected($customer->id == $sale->user_id) >{{$customer->name}}</option>
                                    @endforeach

                                </select>
                                @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="discount" class="form-label fs-6">{{ __('en.Discount') }}</label>
                                <input type="number" min="0"
                                    class="form-control calculation bg-grey mb-2 border-dark @error('discount') is-invalid @enderror"
                                    id="discount" name="discount" value="{{ old('discount',$sale->discount) }}"
                                    autocomplete="discount" required autofocus onchange="calcualtePrice()">
                                @error('discount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="payment_status" class="form-label  fs-6">{{ __('en.Payment Status') }}</label>
                                <select
                                    class="form-select mb-2 border-dark @error('payment_status') is-invalid @enderror"
                                    name="payment_status" id="payment_status" autocomplete="payment_status" required>
                                    <option value="Pending">Pending</option>
                                    <option value="Paid">Paid</option>
                                    <option value="Partial">Partial</option>
                                </select>
                                @error('payment_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="payment_method" class="form-label  fs-6">{{ __('en.Payment Method') }}</label>
                                <select
                                    class="form-select mb-2 border-dark @error('payment_method') is-invalid @enderror"
                                    name="payment_method" id="payment_method" autocomplete="payment_method" required>
                                    <option value="Cash">Cash</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                    <option value="Mobile Account">Mobile Account</option>
                                    <option value="Other">Other</option>

                                </select>
                                @error('payment_method')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- <input type="number" min="1" name="sub_total" > --}}
                            <input type="hidden" name="total" >
                            <input type="hidden" name="remaining_amount" >

                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="paid_amount" class="form-label fs-6">{{ __('en.Paid') }}</label>
                                <input type="number" min="0"
                                    class="form-control calculation bg-grey mb-2 border-dark @error('paid_amount') is-invalid @enderror"
                                    id="paid_amount" name="paid_amount" value="{{ old('paid_amount',$sale->paid_amount) }}"
                                    autocomplete="paid_amount" required autofocus onchange="calcualtePrice()">
                                @error('paid_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-end mt-4">
                            <div class="col-lg-4 col-md-6 col-12">
                                <table class="table table-striped border table-sm border-secondary">
                                    <tbody>
                                        <tr>
                                            <th class="col-4">{{__('en.Sub-Total')}}</th>
                                            <td class="col-4 text-end" id="sub_total">{{$sale->total-$sale->discount}}</td>
                                        </tr>
                                        <tr>
                                            <th class="col-4">{{__('en.Discount')}}</th>
                                            <td class="col-4 text-end" id="show_discount">{{$sale->discount}}</td>
                                        </tr>
                                        <tr>
                                            <th class="col-4">{{__('en.Total')}}</th>
                                            <td class="col-4 text-end" id="show_total">{{$sale->total}}</td>
                                        </tr>
                                        <tr>
                                            <th class="col-4">{{__('en.Paid')}}</th>
                                            <td class="col-4 text-end" id="paid">{{$sale->paid_amount}}</td>
                                        </tr>
                                        <tr>
                                            <th class="col-4">{{__('en.Remaining')}}</th>
                                            <td class="col-4 text-end" id="remaining">{{$sale->remaining_amount}}</td>
                                        </tr>
                                    </tbody>
                                </table>
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
@section('script')

<script>
  $(document).ready(function() {
    calcualtePrice();
  })
</script>
@endsection

