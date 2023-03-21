@extends('layouts.master')

@section('datefilter')
@include('pages.list-filter')
@endsection


@section('title')
Dashboard
@endsection

@section('content')
        <div class="sm-chart-sec mt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 my-2">
                        <div class="revinue revinue-one_hybrid">
                            <div class="revinue-hedding">
                                <div class="w-title">
                                    <div class="w-icon">
                                        <i class="bi bi-people-fill"></i>
                                    </div>
                                    <div class="sm-chart-text">
                                        <p class="w-value">{{$result['total_sales']}}</p>
                                        <h5>{{__('en.Sales')}}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="revinue-content">
                                <div id="hybrid-followers"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 my-2">
                        <div class="revinue page-one_hybrid">
                            <div class="revinue-hedding">
                                <div class="w-title">
                                    <div class="w-icon">
                                        <i class="bi bi-people-fill"></i>
                                    </div>
                                    <div class="sm-chart-text">
                                        <p class="w-value">{{$result['total_purchases']}}</p>
                                        <h5>{{__('en.Purchases')}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 my-2">
                        <div class="revinue bounce-one_hybrid">
                            <div class="revinue-hedding">
                                <div class="w-title">
                                    <div class="w-icon">
                                        <i class="bi bi-people-fill"></i>
                                    </div>
                                    <div class="sm-chart-text">
                                        <p class="w-value">{{$result['expenses']}}</p>
                                        <h5>{{__('en.Expenses')}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 my-2">
                        <div class="revinue rv-status-one_hybrid">
                            <div class="revinue-hedding">
                                <div class="w-title">
                                    <div class="w-icon">
                                        <i class="bi bi-people-fill"></i>
                                    </div>
                                    <div class="sm-chart-text">
                                        <p class="w-value">{{$result['net_profits']}}</p>
                                        <h5>{{__('en.Net Profit')}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Admin and order status table -->
        <div class="all-admin">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12 pt-4">
                        <div class="admin-list">
                            <p class="admin-ac-title ">{{__('en.Products')}}</p>
                            <div class="table-responsive">
                                <table class="table border table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{__('en.Id')}}</th>
                                            <th>{{__('en.Name')}}</th>
                                            {{-- <th>{{__('en.Price')}}</th> --}}
                                            {{-- <th>{{__('en.Selling price')}}</th> --}}
                                            {{-- <th>{{__('en.Purchasing Price')}}</th> --}}
                                            <th>{{__('en.Stock')}}</th>
                                            <th>{{__('en.Stock alert')}}</th>
                                            {{-- <th>{{__('en.Action')}}</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($products as $product )
                                            <tr  @if($product->stock <= $product->stock_alert) class=" text-white bg-danger" @endif>
                                                <th>{{$product->id}}</th>
                                                <td>{{$product->name}}</td>
                                                <td>{{$product->sale_price}}</td>
                                                <td>{{$product->stock}}</td>
                                                <td>{{$product->stock_alert}}</td>
                                                <td>
                                                    <a href="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"
                                                        class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary">
                                                        <i class="bi bi-eye-fill"></i></a>
                                                    <a href="{{route('product.edit',$product->id)}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"
                                                        class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary mx-2">
                                                        <i class="bi bi-pencil"></i></a>
                                                    <a href="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"
                                                        class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary">
                                                        <i class="bi bi-trash-fill"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 pt-4">
                        <div class="admin-list">
                            <p class="admin-ac-title ">{{__('en.Purchases')}}</p>
                            <div class="table-responsive">
                                <table class="table border table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('en.Id') }}</th>
                                            <th>{{ __('en.Vendor') }}</th>
                                            {{-- <th>{{ __('en.Selling price') }}</th> --}}
                                            {{-- <th>{{ __('en.Price') }}</th> --}}
                                            <th>{{ __('en.Quantity') }}</th>
                                            {{-- <th>{{ __('en.Action') }}</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($purchases as $purchase)
                                            <tr>
                                                <th>{{ $purchase->id }}</th>
                                                <td>{{ $purchase->user_id }}</td>
                                                <td>{{ $purchase->sale_price }}</td>
                                                <td>{{ $purchase->price }}</td>
                                                <td>{{ $purchase->qty }}</td>
                                                <td>
                                                    <a href="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"
                                                        class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary me-2">
                                                        <i class="bi bi-eye-fill"></i></a>
                                                    <a href="{{ route('purchase.edit', $purchase->id) }}" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" title="Edit"
                                                        class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary me-2">
                                                        <i class="bi bi-pencil"></i></a>
                                                    <a href="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"
                                                        class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary me-2">
                                                        <i class="bi bi-trash-fill"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 pt-4">
                        <div class="admin-list">
                            <p class="admin-ac-title">{{__('en.Sales')}}</p>
                            <div class="table-responsive">
                                <table class="table border table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{__('en.Id')}}</th>
                                            <th>{{__('en.Customer')}}</th>
                                            <th>{{__('en.Product')}}</th>
                                            {{-- <th>{{__('en.Price')}}</th> --}}
                                            <th>{{__('en.Quantity')}}</th>
                                            {{-- <th>{{__('en.Action')}}</th> --}}
                                        </tr>

                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($sales as $sale )
                                        <tr>
                                            <th>{{$sale->id}}</th>
                                            <td>{{$sale->user_id}}</td>
                                            <td>{{$sale->product_id}}</td>
                                            <td>{{$sale->sale_price}}</td>
                                            <td>{{$sale->qty}}</td>
                                            <td>
                                                <a href="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"
                                                    class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary">
                                                    <i class="bi bi-eye-fill"></i></a>
                                                <a href="{{route('sale.edit',$sale->id)}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"
                                                    class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary mx-2">
                                                    <i class="bi bi-pencil"></i></a>
                                                <a href="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"
                                                    class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary">
                                                    <i class="bi bi-trash-fill"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 pt-4">
                        <div class="admin-list">
                            <p class="admin-ac-title">{{__('en.Expenses')}}</p>
                            <div class="table-responsive">
                                <table class="table border table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{__('en.Id')}}</th>
                                            <th>{{__('en.Name')}}</th>
                                            <th>{{__('en.Amount')}}</th>
                                            <th>{{__('en.Date')}}</th>
                                            {{-- <th>{{__('en.Action')}}</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($expenses as $expense )
                                            <tr>
                                                <th>{{$expense->id}}</th>
                                                <td>{{$expense->name}}</td>
                                                <td>{{$expense->amount}}</td>
                                                <td>{{$expense->date}}</td>
                                                <td>
                                                    <a href="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"
                                                        class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary">
                                                        <i class="bi bi-eye-fill"></i></a>
                                                    <a href="{{route('expense.edit',$expense->id)}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"
                                                        class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary mx-2">
                                                        <i class="bi bi-pencil"></i></a>
                                                    <a href="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"
                                                        class="box border border-1 border-secondary rounded-pill px-2 py-0 fs-6 link-secondary">
                                                        <i class="bi bi-trash-fill"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
@endsection
