<div class="sm-chart-sec mt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 my-2">
                <a href="{{ route('sale.index') }}" class="w-100">
                    <div class="revinue revinue-one_hybrid">
                        <div class="revinue-hedding">
                            <div class="w-title">
                                <div class="w-icon">
                                    <i class="bi bi-cart4"></i>
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
                                    <i class="bi bi-receipt-cutoff"></i>
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
                                    <i class="bi bi-wallet2"></i>
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
                                    <i class="bi bi-cash-stack"></i>
                                </div>
                                <div class="sm-chart-text">
                                    <p class="w-value">{{$result['net_worth']}}</p>
                                    <h5>{{__('en.Net Worth')}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- </a> --}}
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 my-2">
                {{-- <a href="{{ route('sale.index') }}" class="w-100"> --}}
                    <div class="revinue py-1 revinue-one_hybrid">
                        <div class="revinue-hedding">
                            <div class="w-title mt-1">
                                <div class="w-icon">
                                    <i class="bi bi-cash-stack"></i>
                                </div>
                                <div class="sm-chart-text">
                                    <p class="w-value">{{__('en.Cash')}} : {{$result['cash_in_hand']}}
                                    {{-- <h5>{{__('en.Cash')}}</h5> --}}
                                        <br>
                                    <span class="w-value">{{__('en.Other')}}: {{$result['other_in_hand']}}</span>
                                    {{-- <h5>{{__('en.Other')}}</h5> --}}
                                    <br>
                                    <span class="w-value">{{__('en.Total')}}  :{{$result['other_in_hand'] + $result['cash_in_hand']}}</span>
                                </p>


                                    
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- </a> --}}
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 my-2">
                {{-- <a href="{{ route('sale.index') }}" class="w-100"> --}}
                    <div class="revinue page-one_hybrid">
                        <div class="revinue-hedding">
                            <div class="w-title">
                                <div class="w-icon">
                                    <i class="bi bi-cash-stack"></i>
                                </div>
                                <div class="sm-chart-text">
                                    <p class="w-value">{{$result['remaining_amount']}}</p>
                                    <h5>{{__('en.Remaining')}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- </a> --}}
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 my-2">
                {{-- <a href="{{ route('sale.index') }}" class="w-100"> --}}
                    <div class="revinue bounce-one_hybrid">
                        <div class="revinue-hedding">
                            <div class="w-title">
                                <div class="w-icon">
                                    <i class="bi bi-cash-stack"></i>
                                </div>
                                <div class="sm-chart-text">
                                    <p class="w-value">{{$result['discount']}}</p>
                                    <h5>{{__('en.Discount')}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- </a> --}}
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 my-2">
                {{-- <a href="{{ route('sale.index') }}" class="w-100"> --}}
                    <div class="revinue rv-status-one_hybrid">
                        <div class="revinue-hedding">
                            <div class="w-title">
                                <div class="w-icon">
                                    <i class="bi bi-cash-stack"></i>
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
                    <a href="{{route('purchase.index')}}">
                        <p class="admin-ac-title ">{{__('en.Purchases')}}</p>
                    </a>
                    <div class="table-responsive">
                        <table class="table border table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('en.Id') }}</th>
                                    <th>{{ __('en.Name') }}</th>
                                    <th>{{ __('en.Quantity') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result['latest_purchases'] as $purchase)
                                    <tr>
                                        <th>{{ $purchase->id }}</th>
                                        <td>{{ $purchase->name }}</td>
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
                    <a href="{{route('sale.index')}}">
                        <p class="admin-ac-title">{{__('en.Sales')}}</p>
                    </a>
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
                                    <td>{{$sale->Customer->name}}</td>
                                    <td>{{$sale->Products->pluck('product_name')->join(',')}}</td>
                                    <td>{{$sale->total_qty}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12 pt-4">
                <div class="admin-list">
                    <a href="{{route('expense.index')}}">
                        <p class="admin-ac-title">{{__('en.Expenses')}}</p>
                    </a>
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