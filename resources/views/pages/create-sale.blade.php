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

                    <form method="POST" action="{{ route('sale.store') }}" enctype="">
                        @csrf

                        <div class="row mt-3">
                            @php
                                 $counter=1;
                            @endphp
                            <div class="row d-flex">
                                <div class="col-lg-4 col-md-6 col-12 pt-1">
                                    <label for="product_id" class="form-label fs-6">{{ __('en.Product') }}</label>
                                    <select
                                        class="form-select border-dark @error('product_id') is-invalid @enderror"
                                        name="products[{{$counter}}]['product_id']" id="{{$counter}}-product_id" autocomplete="product_id" required  onchange="getPrice()">
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
                                        id="{{$counter}}-qty" name="products[{{$counter}}]['qty']" placeholder="20" value="{{ old('qty',1) }}"
                                        autocomplete="qty" required autofocus  onkeyup="calcualtePrice()" min="1">
                                    @error('qty')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-3 col-md-6 col-12 pt-1">
                                    <label for="sale_price" class="form-label fs-6">{{ __('en.Price') }}</label>
                                        <input type="number" min="1"
                                            class="form-control calculation mb-2 border-dark @error('sale_price') is-invalid @enderror"
                                            id="{{$counter}}-sale_price" name="products[{{$counter}}]['sale_price']" placeholder="10" value="{{ old('sale_price') }}"
                                            autocomplete="sale_price" required autofocus  onkeyup="calcualtePrice()" min="0">
                                        @error('sale_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="col pt-4 mt-2">
                                    <button type="btn" class="btn btn-success"><i class="bi bi-plus-lg"></i></button>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="user_id" class="form-label  fs-6">{{ __('en.Customer') }}</label>
                                <div class="input-group input-group-md">
                                    <select
                                        class="form-select mb-2 border-dark select2 @error('user_id') is-invalid @enderror"
                                        name="user_id" id="user_id" autocomplete="user_id" required>
                                        <option>{{ __('en.Choose') }}</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <!-- Button trigger for add customer -->
                                    <span class=" mb-2 ps-2" data-bs-toggle="modal" data-bs-target="#add_customer"><i
                                            class="bi fs-4 bi-person-plus-fill"></i></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="discount" class="form-label fs-6">{{ __('en.Discount') }}</label>
                                <input type="number" min="0"
                                    class="form-control mb-2 calculation border-dark @error('discount') is-invalid @enderror"
                                    id="discount" name="discount" placeholder="10" value="{{ old('discount',0) }}" min="0"  onkeyup="calcualtePrice()"
                                    autocomplete="discount" required autofocus>
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
                                    <option>Pending</option>
                                    <option value="1">Paid</option>
                                    <option value="2">Partial</option>
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
                                    <option>Cash</option>
                                    <option value="1">Bank Transfer</option>
                                    <option value="2">Mobile Account</option>
                                    <option value="3">Other</option>

                                </select>
                                @error('payment_method')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- <input type="number" min="1" name="sub_total" > --}}
                            <input type="hidden" name="total" id="total">
                            <input type="hidden" name="remaining_amount" id="remaining_amount">

                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="paid_amount" class="form-label fs-6">{{ __('en.Paid') }}</label>
                                <input type="number" min="0"
                                    class="form-control calculation mb-2 border-dark @error('paid_amount') is-invalid @enderror"
                                    id="paid_amount" name="paid_amount" placeholder="70" min="0"
                                    value="{{ old('paid_amount',0) }}" autocomplete="paid_amount" required autofocus onkeyup="calcualtePrice()">
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
                                            <th class="col-4">{{ __('en.Sub-Total') }}</th>
                                            <td class="col-4 text-end" id="sub_total">0</td>
                                        </tr>
                                        <tr>
                                            <th class="col-4">{{ __('en.Discount') }}</th>
                                            <td class="col-4 text-end" id="show_discount">Rs. 0</td>
                                        </tr>
                                        <tr>
                                            <th class="col-4">{{ __('en.Total') }}</th>
                                            <td class="col-4 text-end" id="show_total">Rs. 0</td>
                                        </tr>
                                        <tr>
                                            <th class="col-4">{{ __('en.Paid') }}</th>
                                            <td class="col-4 text-end" id="paid">Rs. 0</td>
                                        </tr>
                                        <tr>
                                            <th class="col-4">{{ __('en.Remaining') }}</th>
                                            <td class="col-4 text-end" id="remaining">Rs. 0</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- save button row included below -->
                        @include('pages.table-footer', ['link' => 'sale.index'])
                    </form>


                    <!-- Modal itself for add customer -->
                    <div class="modal fade" id="add_customer" tabindex="-1" aria-labelledby="add_customerLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form method="POST" action="" enctype="">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="add_customerLabel">Add Customer</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
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
                                        <label for="type" class="form-label fs-6">{{ __('en.Type') }}</label>
                                        <select
                                            class="form-select mb-2 border-dark @error('type') is-invalid @enderror"
                                            name="type" id="type" autocomplete="type" required>
                                            <option value="1" @if (old('type') == 1) 'selected' @endif
                                                selected>{{ __('en.Customer') }}</option>
                                            <option value="2" @if (old('type') == 2) 'selected' @endif>
                                                {{ __('en.Vendor') }}</option>
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
@section('script')

<script>


</script>
@endsection
