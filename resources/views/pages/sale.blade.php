@extends('layouts.master')

@section('title')
Sales Listing
@endsection
@section('content')
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4>{{__('en.Sales')}}</h4>
                </div>
            </div>
            <hr>
            <div class="row my-4">
                <div class="col-lg-3 col-md-6 col-12 mt-2 d-flex">
                    <label for="search" class="form-label mt-1"><i class="bi bi-search fs-4"></i></label>
                    <input type="text" class="form-control bg-grey form-control-css border-secondary ms-3 rounded"
                        placeholder="{{__('en.Search this table...')}}" id="search">
                </div>
                <div class="col-lg-9 col-md-6 col-12 mt-2 text-end">
                    <!-- offcanvas trigger for filter -->
                    {{-- <button type="button" class="btn btn-sm me-2 btn-outline-primary" data-bs-toggle="offcanvas"
                        data-bs-target="#filters" aria-controls="filters"><i class="bi bi-funnel"></i> {{__('en.Filter')}}</button>
                    <button type="button" class="btn btn-sm me-2 btn-outline-success"><i class="bi bi-filetype-pdf"></i>
                        {{__('en.PDF')}}</button> --}}
                    <button type="button" class="btn btn-sm me-2 btn-outline-danger"><i
                            class="bi bi-file-earmark-excel-fill"></i> {{__('en.EXCEL')}}</button>
                    <!-- modal trigger for create sale -->
                    <a href="{{ route('create-sale') }}" class="btn btn-sm me-2 btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>{{__('en.Create')}}</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table border table-striped">
                    <thead>
                        <tr>
                            <th>{{__('en.Id')}}</th>
                            <th>{{__('en.Customer')}}</th>
                            <th>{{__('en.Product')}}</th>
                            <th>{{__('en.Name')}}</th>
                            <th>{{__('en.Price')}}</th>
                            <th>{{__('en.Quantity')}}</th>
                            <th>{{__('en.Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>001</th>
                            <td>Customer 1</td>
                            <td>Product 1</td>
                            <td>name 1</td>
                            <td>10</td>
                            <td>20</td>
                            <td>
                                <a href="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"
                                    class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary">
                                    <i class="bi bi-eye-fill"></i></a>
                                <a href="{{ route('edit-sale') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"
                                    class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary mx-2">
                                    <i class="bi bi-pencil"></i></a>
                                <a href="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"
                                    class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary">
                                    <i class="bi bi-trash-fill"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- row per page and pagination file below --}}
            @include('pages.pagination')


        </div>
    </div>

    <!-- offcanvas itself for filter -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="filters" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            <h5 class="offcanvas-title me-5" id="offcanvasExampleLabel">{{__('en.Filters')}}</h5>
        </div>
        {{-- form for filter sales --}}
        <form method="POST" action="" enctype="">
            <div class="offcanvas-body">
                <label for="saleName" class="form-label mt-3">{{__('en.sale Name')}}</label>
                <input type="text"
                    class="form-control bg-grey border-secondary @error('saleName') is-invalid @enderror" id="saleName"
                    name="saleName" placeholder="{{__('en.Search by Name')}}" value="{{ old('saleName') }}" autocomplete="saleName">
                @error('saleName')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label for="saleStatus" class="form-label mt-3">{{__('en.Status')}}</label><br>
                    <input type="checkbox" checked data-size="sm" data-toggle="toggle" data-on="Active"
                    data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                @error('saleStatus')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="row py-4">
                    <div class="col-6">
                        <button class="btn btn-primary rounded btn-sm w-100" type="button"><i class="bi bi-funnel"></i>
                            {{__('en.Filter')}}</button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-danger rounded btn-sm w-100" type="button"><i class="bi bi-x-circle"></i>
                            {{__('en.Reset')}}</button>
                    </div>
                </div>
            </div>
        </form>
        {{-- end form filter sales --}}
    </div>

@endsection
