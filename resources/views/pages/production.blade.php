@extends('layouts.master')

@section('title')
    Production Listing
@endsection
@section('content')
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4>{{ __('en.Productions') }}</h4>
                </div>
            </div>
            <hr>
            <div class="row my-4">
                <div class="col-lg-3 col-md-6 col-12 mt-2 d-flex">
                    <label for="search" class="form-label mt-1"><i class="bi bi-search fs-4"></i></label>
                    <input type="text" class="form-control bg-grey form-control-css border-secondary ms-3 rounded"
                        placeholder="{{ __('en.Search this table...') }}" id="search">
                </div>
                <div class="col-lg-9 col-md-6 col-12 mt-2 text-end">
                    <button type="button" class="btn btn-sm me-2 btn-outline-danger"><i
                            class="bi bi-file-earmark-excel-fill"></i> {{ __('en.EXCEL') }}</button>
                    <!-- modal trigger for create production -->
                    <a href="{{ route('production.create') }}" class="btn btn-sm me-2 btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>{{ __('en.Create') }}</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table border table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('en.Id') }}</th>
                            <th>{{ __('en.Raw Material') }}</th>
                            <th>{{ __('en.Product') }}</th>
                            <th>{{ __('en.Quantity') }}</th>
                            <th>{{ __('en.Waste') }}</th>
                            <th>{{ __('en.Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productions as $production)
                            <tr>
                                <th>{{ $production->id }}</th>
                                <td>{{ $production->RawMaterial->name }}</td>
                                <td>{{ $production->Product->name }}</td>
                                <td>{{ $production->qty }}</td>
                                <td>{{ $production->wastage_qty }}</td>
                                <td>
                                    <a href="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"
                                        class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary me-2">
                                        <i class="bi bi-eye-fill"></i></a>
                                    <a href="{{ route('production.edit', $production->id) }}" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="Edit"
                                        class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary me-2">
                                        <i class="bi bi-pencil"></i></a>
                                    <a href="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"
                                        class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary me-2">
                                        <i class="bi bi-trash-fill"></i></a>
                                    {{-- <a href="{{ route('production.create') }}" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="Production"
                                        class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary me-2">
                                        <i class="bi bi-repeat"></i></a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- row per page and pagination file below --}}
            @include('pages.pagination', ['paginate' => $productions])

        </div>
    </div>
@endsection
