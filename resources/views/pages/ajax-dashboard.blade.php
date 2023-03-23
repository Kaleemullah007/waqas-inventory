<div class="sm-chart-sec mt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 my-2">
                <a href="{{ route('sale.index') }}" class="w-100">
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
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 my-2">
                <a href="{{ route('purchase.index') }}" class="w-100">
                    <div class="revinue page-one_hybrid">
                        <div class="revinue-hedding">
                            <div class="w-title">
                                <div class="w-icon">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                <div class="sm-chart-text">
                                    <p class="w-value">{{$result['purchases_history']}}</p>
                                    <h5>{{__('en.Purchases')}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 my-2">
                <a href="{{ route('expense.index') }}" class="w-100">
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
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 my-2">
                {{-- <a href="{{ route('sale.index') }}" class="w-100"> --}}
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
                {{-- </a> --}}
            </div>
        </div>
    </div>
</div>
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
                                    <th>{{__('en.Stock')}}</th>
                                    <th>{{__('en.Stock alert')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result['latest_products'] as $product )
                                    <tr  @if($product->stock <= $product->stock_alert) class=" text-white bg-danger" @endif>
                                        <th>{{$product->id}}</th>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->stock}}</td>
                                        <td>{{$product->stock_alert}}</td>
                                    </tr>
                                @endforeach
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
                                    <th>{{ __('en.Quantity') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result['latest_purchases'] as $purchase)
                                    <tr>
                                        <th>{{ $purchase->id }}</th>
                                        <td>{{ $purchase->user_id }}</td>
                                        <td>{{ $purchase->qty }}</td>
                                    </tr>
                                @endforeach
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
                                    <th>{{__('en.Quantity')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result['latest_sales'] as $sale )
                                <tr>
                                    <th>{{$sale->id}}</th>
                                    <td>{{$sale->user_id}}</td>
                                    <td>{{$sale->product_id}}</td>
                                    <td>{{$sale->qty}}</td>
                                </tr>
                                @endforeach
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result['latest_expenses'] as $expense )
                                    <tr>
                                        <th>{{$expense->id}}</th>
                                        <td>{{$expense->name}}</td>
                                        <td>{{$expense->amount}}</td>
                                        <td>{{$expense->date}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>