@extends('layouts.master')

@section('title')
Product Listing
@endsection
@section('content')
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4>{{__('en.Products')}}</h4>
                </div>
            </div>
            <hr>
            <div class="row my-4">
                <div class="col-lg-3 col-md-6 col-12 mt-2 d-flex">
                    <label for="search" class="form-label mt-1"><i class="bi bi-search fs-4"></i></label>
                    <input type="text" onkeyup="getProducts()" class="form-control form-control-css border-secondary ms-3 rounded"
                        placeholder="{{__('en.Search this table...')}}" id="search">
                </div>

                <div class="col-lg-9 col-md-6 col-12 mt-2 text-end">
                    <!-- offcanvas trigger for filter -->
                    {{-- <button type="button" class="btn btn-sm me-2 btn-outline-primary" data-bs-toggle="offcanvas"
                        data-bs-target="#filters" aria-controls="filters"><i class="bi bi-funnel"></i> {{__('en.Filter')}}</button>
                    <button type="button" class="btn btn-sm me-2 btn-outline-success"><i class="bi bi-filetype-pdf"></i>
                        {{__('en.PDF')}}</button> --}}
                    {{-- <button type="button" class="btn btn-sm me-2 export-csv-product btn-outline-danger"><i
                            class="bi bi-file-earmark-excel-fill"></i> {{__('en.EXCEL')}}</button> --}}
                    <!-- modal trigger for create product -->
                    <a href="{{ route('product.create') }}" class="btn btn-sm me-2 btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>{{__('en.Create')}}</a>

                </div>
            </div>
            <div class="table-responsive" id="searchable">
                @include('pages.ajax-product',['products'=>$products])
            </div>

            {{-- row per page and pagination file below --}}
            @include('pages.pagination',['paginate'=>$products])


        </div>
    </div>

@endsection
@section('script')

@endsection

