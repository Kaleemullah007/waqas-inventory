@extends('layouts.master')

@section('title')
Module Listing
@endsection
@section('content')
    <div class="container">
        <div class="container">
            <div class="row pt-3">
                <div class="col-12">
                    <h4>{{__('en.Modules')}}</h4>
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
                    <button type="button" class="btn btn-sm me-2 btn-outline-primary" data-bs-toggle="offcanvas"
                        data-bs-target="#filters" aria-controls="filters"><i class="bi bi-funnel"></i> {{__('en.Filter')}}</button>
                    <button type="button" class="btn btn-sm me-2 btn-outline-success"><i class="bi bi-filetype-pdf"></i>
                        {{__('en.PDF')}}</button>
                    <button type="button" class="btn btn-sm me-2 btn-outline-danger"><i
                            class="bi bi-file-earmark-excel-fill"></i> {{__('en.EXCEL')}}</button>
                    <!-- modal trigger for create module -->
                    <a href="{{ route('create-module') }}" class="btn btn-sm me-2 btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>{{__('en.Create')}}</a>

                </div>
            </div>
            <div class="table-responsive">
                <table class="table border table-striped">
                    <thead>
                        <tr>
                            <th>{{__('en.Name')}}</th>
                            <th>{{__('en.Permissions')}}</th>
                            <th>{{__('en.Status')}}</th>
                            <th>{{__('en.Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Module 1</td>
                            <td>
                                <span class="badge text-bg-success fw-normal py-2">Create</span>
                                <span class="badge text-bg-primary fw-normal py-2">Edit</span>
                                <span class="badge text-bg-info fw-normal py-2 text-light">View</span>
                                <span class="badge text-bg-danger fw-normal py-2">Delete</span>
                            </td>
                            <td>
                                <input type="checkbox" checked data-size="sm" data-toggle="toggle" data-on="Active"
                                    data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                            </td>
                            <td>
                                <a href="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"
                                    class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary">
                                    <i class="bi bi-eye-fill"></i></a>
                                <a href="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"
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
        {{-- form for filter modules --}}
        <form method="POST" action="" enctype="">
            <div class="offcanvas-body">
                <label for="moduleName" class="form-label mt-3">{{__('en.Module Name')}}</label>
                <input type="text"
                    class="form-control bg-grey border-secondary @error('moduleName') is-invalid @enderror" id="moduleName"
                    name="moduleName" placeholder="{{__('en.Search by Name')}}" value="{{ old('moduleName') }}" autocomplete="moduleName">
                @error('moduleName')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label for="moduleStatus" class="form-label mt-3">{{__('en.Status')}}</label><br>
                    <input type="checkbox" checked data-size="sm" data-toggle="toggle" data-on="Active"
                    data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                @error('moduleStatus')
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
        {{-- end form filter modules --}}
    </div>

@endsection
