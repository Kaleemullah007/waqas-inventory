@extends('layouts.master')
@section('title')
Group Listing
@endsection

@section('content')
    <div class="container-fluid">
        <div class="container">
            <div class="row pt-3">
                <div class="12">
                    <h4>{{__('en.Groups')}}</h4>
                </div>
            </div>
            <hr>
            <div class="row my-4">
                <div class="col-lg-4 col-md-6 col-8 d-flex">
                    <label for="search" class="form-label mt-1"><i class="bi bi-search fs-4"></i></label>
                    <input type="text" class="form-control bg-grey form-control-css border-secondary ms-3 rounded"
                        placeholder="{{__('en.Search this table...')}}" id="search">
                </div>
                <div class="col-lg-8 col-md-6 col-4 text-end">
                    <a href="{{ route('create-group') }}" class="btn btn-sm me-2 btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>{{__('en.Create')}}</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table border table-striped">
                    <thead>
                        <tr>
                            <th>{{__('en.Name')}}</th>
                            <th>{{__('en.Description')}}</th>
                            <th>{{__('en.Users')}}</th>
                            <th>{{__('en.Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Owner</td>
                            <td>This is a Description.</td>
                            <td>2</td>
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
                        <tr>
                            <td>Admin</td>
                            <td>This is a Description.</td>
                            <td>5</td>
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
@endsection
