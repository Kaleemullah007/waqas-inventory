@extends('layouts.master')

@section('title')
    Edit Purchase
@endsection

@section('content')
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4>{{ __('en.Edit Purchase') }}</h4>
                </div>
            </div>
            <hr>
            {{-- @dd($errors->all()) --}}
            <div class="row p-3">
                <div class="shadow-css">
                    @include('message')
                    <form method="POST" action="{{route('purchase.update',$purchase->id)}}" enctype="">
                        @method('patch')
                        @csrf
                        <div class="row mt-3">
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="user_id" class="form-label fs-6">{{ __('en.Vendor') }}</label>
                                <select class="form-select mb-2 border-dark @error('user_id') is-invalid @enderror" name="user_id" id="user_id" autocomplete="user_id" required>
                                    <option>{{__('en.Choose')}}</option>
                                    @foreach ($vendors as $vendor)
                                        <option value="{{$vendor->id}}" @selected($vendor->id == $purchase->user_id) >{{$vendor->name}}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                           
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="raw_id" class="form-label  fs-6">{{ __('en.Raw Material Name') }}</label>
                                <div class="input-group input-group-md d-flex">
                                    <select class="form-select mb-2 border-dark select2 @error('raw_id') is-invalid @enderror" name="raw_id" id="raw_id" autocomplete="raw_id" required>
                                        <option>{{__('en.Choose')}}</option>
                                        @foreach ($raw as $ra)
                                            <option value="{{$ra->id}}" @selected($ra->name == $purchase->name) {{ $count == 1 ?'selected':''}} >{{$ra->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('raw_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-4 col-md-6 col-12 pt-1 " id="add_new_name" style="{{ $count > 1?'display:none':'' }}">
                                <label for="Name" class="form-label fs-6">{{ __('en.Name') }}</label>
                                <input type="text"
                                    class="form-control mb-2 border-dark @error('Name') is-invalid @enderror"
                                    id="Name" name="name" value="{{ old('Name',$purchase->name) }}"
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
                                    id="qty" name="qty"  value="{{ old('qty',$purchase->qty) }}"
                                    autocomplete="qty" required autofocus>
                                @error('qty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="price" class="form-label fs-6">{{ __('en.Price') }}</label>
                                <input type="text" min="1"
                                    class="form-control mb-2 border-dark @error('price') is-invalid @enderror"
                                    id="price" name="price"  value="{{ old('price',$purchase->price) }}"
                                    autocomplete="price" required autofocus>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 pt-1">
                                <label for="sale_price" class="form-label fs-6">{{ __('en.Sale Price') }}</label>
                                <input type="text" min="1"
                                    class="form-control mb-2 border-dark @error('sale_price') is-invalid @enderror"
                                    id="sale_price" name="sale_price"  value="{{ old('sale_price',$purchase->sale_price) }}"
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
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        
        function showName() {
            let selectedValue = $("#raw_id").val();
            if (selectedValue == "1") {
                console.log('show');
                $("#add_new_name").show()
            } else {
                $("#add_new_name").hide();
            }
        }
        $("#raw_id").change(function () {            
        showName();
        });
        showName();
    });
</script>
@endsection